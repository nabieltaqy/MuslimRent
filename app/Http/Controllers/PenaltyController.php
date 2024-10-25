<?php

namespace App\Http\Controllers;


use App\Models\Penalty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class PenaltyController extends Controller
{
    public function index(Request $request){

        $keyword = $request->get('keyword');
        $penalties = Penalty::where('penalty_name', 'like', '%' . $keyword . '%')->paginate(10);

        return view('penalty.index', compact(['penalties', 'keyword']));
    }

    public function create(){
        return view('penalty.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'penalty_name' => 'required',
            'amount' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput(); // mengembalikan input
        }

        Penalty::create($request->all());

        return redirect()->route('penalty.index');
    }

    public function edit($id){
        $penalty = Penalty::findOrFail($id);
        return view('penalty.update', compact('penalty'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'penalty_name' => 'required',
            'amount' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput(); // mengembalikan input
        }

        $penalty = Penalty::findOrFail($id);

        $penalty->update([
            'penalty_name' => $request->penalty_name,
            'amount' => $request->amount,
        ]);

        return redirect()->route('penalty.index');
    }

    public function destroy($id){
        Penalty::destroy($id);
        return redirect()->route('penalty.index')->with('success', 'Penalty berhasil dihapus');
    }
}
