<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Borrow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BorrowController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $borrows = Borrow::with(['user', 'unit'])
            ->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');})
            ->orWhereHas('unit', function ($query) use ($keyword) {
                $query->where('nama_unit', 'like', '%' . $keyword . '%');})
            // ->where('user_id', 'like', '%' . $keyword . '%')
            // ->orWhere('unit_id', 'like', '%' . $keyword . '%')
            ->orWhere('borrow_date', 'like', '%' . $keyword . '%')
            ->orWhere('return_date', 'like', '%' . $keyword . '%')
            ->paginate(5);
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
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'unit_id' => 'required|exists:units,id',
            'qty' => 'required|integer|min:1',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after:borrow_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // mengembalikan input
        }

        Borrow::create($request->all([
            'user_id'=> $request->user_id,
            'unit_id' => $request->unit_id,
            'qty' => $request->qty,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'Waiting',
        ]));
        return redirect('unit.index')->with('success', 'Berhasil Mengajukan Pinjaman!');
    }
}
