<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function index() {
        if(auth()->user()->ActiveStatus == 2) {
            return view('contents.auth.change-password');
        } else {
            return redirect()->back();
        }
    }

    public function changePassword(User $user_information, Request $request) {
        try {
            $request->validate([
                'password' => ['required', 'min:8', 'confirmed'],
            ]);

            User::find($user_information->id)->update(['password' => bcrypt($request->password)]);

            return redirect()->back()->with('success', 'Password changed successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Invalid password.');
        }
    }

    public function firstTimeLogin(Request $request) {
        try {
            $request->validate([
                'password' => ['required', 'min:8', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()],
            ]);

            User::find(auth()->user()->id)->update([
                'password' => bcrypt($request->password),
                'ActiveStatus' => 1,
            ]);

            return redirect()->route('dashboard')->with('success', 'Password changed successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Invalid password.');
        }
    }
}
