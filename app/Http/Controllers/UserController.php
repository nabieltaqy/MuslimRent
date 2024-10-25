<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //index 
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $users = User::where('name', 'like', '%' . $keyword . '%')
        ->orWhere('email', 'like', '%' . $keyword . '%')
        ->orWhere('role', 'like', '%' . $keyword . '%')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('user.index', compact(['users', 'keyword']));
    }

    //user create
    public function create()
    {

        return view('user.create');
    }

    //user store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'name' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // mengembalikan input
        }


            $firstname = $request->firstname;
            $lastname = $request->lastname;

            User::create([
                'name' => $firstname . ' ' . $lastname,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);
            return redirect()->route('users.index')->with('success', 'User added successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'password' => 'required|min:8',
            'confirm-password' => 'required|min:8|same:password',
            'role' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput(); // mengembalikan input
        };

        $user = User::findORFail($id);

            $user -> update([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'confirm-password' => 'required|min:8|same:password',
                'role' => $request->role,
            ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
