<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        $provinces = Province::all();
        $cities = City::all();

        return view('profile.edit', [
            'user' => $request->user(),
            'provinces' => $provinces,
            'cities' => $cities
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $user = $request->user();

        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'required|exists:cities,id',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
            ->withErrors($validatedData)
            ->withInput(); // mengembalikan input
        };

        // $request->user()->fill($request->validated());
        $user->name = $request->name; // Memperbarui nama
        $user->email = $request->email; // Memperbarui email
        $user->phone = $request->phone; // Memperbarui nomor telepon
        $user->city_id = $request->city; // Memperbarui kota

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->save();
        // $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
