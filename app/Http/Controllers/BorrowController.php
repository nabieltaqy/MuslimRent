<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Borrow;
use App\Models\Penalty;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BorrowController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $borrows = Borrow::with(['borrower', 'unit']);

        if (Auth::user()->role == 'Anggota') {
            $borrows->where('user_id', Auth::user()->id);
        }

        if ($keyword) {
            $borrows->where(function ($query) use ($keyword) {
                $query->whereHas('borrower', function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', "%$keyword%");
                })
                ->orWhereHas('unit', function ($q) use ($keyword) {
                    $q->where('kode_unit', 'LIKE', "%$keyword%");
                });
            });
        }

        $borrows = $borrows->orderBy('created_at', 'desc')->paginate(10);
            return view('borrow.index', compact(['borrows', 'keyword']));
    }

    public function create($id)
    {
        $user = Auth::user();
        $unit = Unit::find($id);
        return view('borrow.create', compact(['user', 'unit']));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'unit_id' => 'required|exists:units,id',
            'qty' => 'required|integer|min:1',
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:borrow_date',
        ]);

        $borrow_days = Carbon::parse($request->borrow_date);
        $return_days = Carbon::parse($request->return_date);
        $countDays = $borrow_days ->diffInDays($return_days);

        if ($countDays > 5){
            return redirect()->back()->with('error', 'Maksimal Pinjaman 5 Hari');
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // mengembalikan input
        }

        $user = $request->user_id;
        $userBorrow = Borrow::where('user_id', $user)
            ->orWhere('status', 'Waiting')
            ->orWhere('status', 'Approved')
            ->orWhere('status', 'On Going')
            ->count();
        if ($userBorrow == 2)
            return redirect(route('borrow.index'))->with('error', 'Gagal Mengajukan Pinjaman! Terdapat 2 Pinjaman Aktif');
        else
        $create = Borrow::create([
            'user_id'=> $request->user_id,
            'unit_id' => $request->unit_id,
            'qty' => $request->qty,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'Waiting',
        ]);

        // mengurangai qty unit
        $unit = Unit::find($request->unit_id);
        if($create) {
            $unit->qty -= $request->qty;
            $unit->save();
        }

        return redirect(route('borrow.index'))->with('success', 'Berhasil Mengajukan Pinjaman!');
    }

    public function edit($id)
    {
        $borrow = Borrow::findOrFail($id);
        
        return view('borrow.update', compact(['borrow']));
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "status" => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // mengembalikan input
        }

        $borrow = Borrow::findOrFail($id);

        $borrow->update([
            'status' => $request->status,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect(route('borrow.index'))->with('success', 'Pengajuan Pinjaman Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $borrow = Borrow::findOrFail($id);
        // $deleteBorrow = Borrow::destroy($id);

        if(Borrow::destroy($id)) {
            $unit = Unit::find($borrow->unit_id);
            $unit->qty += $borrow->qty;
            $unit->save();
        }
        return redirect()->route('borrow.index')->with('success', 'Pengajuan Pinjaman Berhasil Dihapus!');
    }

    public function return($id){
        $borrow = Borrow::findOrFail($id);
        $penalty = Penalty::where('penalty_name', 'returnLate')->first();
        return view('borrow.return', compact(['borrow', 'penalty']));
    }

    public function saveReturn(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'actual_return_date' => 'required|date',
            // 'penalty' => 'integer|required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // mengembalikan input
        }

        //mengambil nilai penalti untuk returnLate
        $Penalty = Penalty::where('penalty_name', 'returnLate')->first()->amount;

        $borrow = Borrow::findOrFail($id);
        $return_date = Carbon::parse($borrow->return_date);
        $actual_return_date = Carbon::parse($request->actual_return_date);
        $countDays = $return_date ->diffInDays($actual_return_date, false);

        //hitung penalty
        if($countDays > 0){
            $countPenalty = $countDays * $Penalty;
        }
        else{
            $countPenalty = 0;
        }

        
            $return = $borrow->update([
                'status' => 'Returned',
                'updated_by' => Auth::user()->id,
                'actual_return_date' => $request->actual_return_date,
                'penalty' => $countPenalty,
            ]);
    
            if($return){
                $unit = Unit::find($borrow->unit_id);
                $unit->qty += $borrow->qty;
                $unit->save();
            }
            else{
                return redirect(route('borrow.index'))->with('error', 'Gagal Mengembalikan Alat Solat!');
            }
        return redirect(route('borrow.index'))->with('success', 'Alat Solat Berhasil Dikembalikan!');
    }

    public function generatePDF()
    {
    	$borrows = Borrow::all();
 
    	$pdf = PDF::loadView('template.pdf',compact('borrows'));
    	return $pdf->download('laporan-peminjaman.pdf');
    }
}
