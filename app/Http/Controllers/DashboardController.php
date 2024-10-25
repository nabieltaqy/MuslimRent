<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(){
        if(Auth::user()->role == 'Admin'){
            $borrows = Borrow::paginate(5);
        }else{
            $borrows = Borrow::where('user_id', Auth::user()->id);
        }
        $units = Unit::all();
        $users = User::all();
        if(Auth::user()->role == 'Admin'){
            $totalPenalty = Borrow::where('status', 'Returned')->sum('penalty');
        }else{
            $totalPenalty = Borrow::where('status', 'Returned')
            ->orWhere('user_id', Auth::user()->id)
            ->sum('penalty');
        }
        if(Auth::user()->role == 'Admin'){
            $borrowsWaiting = Borrow::where('status', 'Waiting')->count();
        }else{
            $borrowsWaiting = Borrow::where('status', 'Waiting')
            ->orWhere('user_id', Auth::user()->id)
            ->count();
        }
        $borrowsUser = Borrow::where('user_id', Auth::user()->id)
        ->where('status', '!=', 'Returned')
        ->count();
        return view('dashboard', compact(['borrows', 'units', 'users', 'totalPenalty', 'borrowsWaiting', 'borrowsUser']));
    }
}
