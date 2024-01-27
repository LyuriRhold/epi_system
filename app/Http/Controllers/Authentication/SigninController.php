<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use App\Models\LoginSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\SigninRequest as AuthenticationSigninRequest;
use Illuminate\Notifications\Notifiable;

class SigninController extends Controller
{
    use Notifiable;

    public function showLoginForm()
    {
        return view('sign-in');
    }
    public function index()
    {
        try {
            DB::table('users')->first();
            $connected = 'sqlsrv is installed';
        } catch (\Exception $e) {
            $connected = $e->getMessage();
        }
        return view('contents.auth.sign-in');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('employee_id', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->Status === 3) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Invalid credentials');
            }

            $status = "Active";
            $today = now()->format('Y-m-d');
            $time_now = now()->format('H:i:s');
            $fullname = $user->first_name . ' ' . $user->last_name;

            $session = LoginSession::create([
                "user_id" => $user->id,
                "user_fullname" => $fullname,
                "user_type" => $user->userType, // Make sure to adjust this based on your user model
                "date_today" => $today,
                "login_time" => $time_now,
                "last_activity_time" => $time_now,
                "status" => $status,
            ]);

            session(['login_session_id' => $session->id]);

            if ($user->Status === 2) {
                return redirect()->route('change-password')->with('success', 'Login Successfully');
            } elseif ($user->userType === 'TREASURY') {
                return redirect()->route('batch.index')->with('success', 'Login Successfully');
            } else {
                // Update Status using property assignment
                $user->Status = 1;

                return redirect()->route('dashboard')->with('success', 'Login Successfully');
            }
        }

        return redirect()->route('login')->with('error', 'Invalid employee ID or password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showSignInForm()
    {
        try {
            DB::table('users')->first();
            $connected = 'sqlsrv is installed';
        } catch (\Exception $e) {
            $connected = $e->getMessage();
        }

        return view('contents.auth.sign-in');
    }

    public function signIn(AuthenticationSigninRequest $request)
    {
        try {
            $user = auth()->user();

            if ($user->Status === 3) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('sign-in.index')->with('error', 'Invalid credentials');
            }

            $status = "Active";
            $today = now()->format('Y-m-d');
            $time_now = now()->format('H:i:s');
            $fullname = $user->full_name;

            $session = LoginSession::create([
                "user_id" => $user->id,
                "user_fullname" => $fullname,
                "user_type" => $user->userType,
                "date_today" => $today,
                "login_time" => $time_now,
                "last_activity_time" => $time_now,
                "status" => $status,
            ]);

            session(['login_session_id' => $session->id]);

            if ($user->Status === 2) {
                return redirect()->route('change-password')->with('success', 'Login Successfully');
            } elseif ($user->userType === 'TREASURY') {
                return redirect()->route('batch.index')->with('success', 'Login Successfully');
            } else {
                // Update Status using property assignment
                $user->Status = 1;

                return redirect()->route('dashboard')->with('success', 'Login Successfully');
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
