<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\LoginSession;
use Illuminate\Support\Facades\DB;


class SignoutController extends Controller
{
    public function signOut(Request $request)
    {
        $user = auth()->user();

        if ($user->Status != 2) {
            // Directly update the Status in the database
            DB::table('your_users_table')
                ->where('id', $user->id)
                ->update(['Status' => 0]);
        }

        $login_time = LoginSession::select('login_time')->where('id', session('login_session_id'))->first();
        $time_now_unformatted = now()->format('H:i:s');

        if ($login_time) {
            // Convert the times to Carbon objects
            $login_time = Carbon::createFromFormat('H:i:s', $login_time->login_time);
            $time_now = Carbon::createFromFormat('H:i:s', $time_now_unformatted);

            // Calculate the difference
            $diff = $login_time->diff($time_now);

            // Get the difference in hours, minutes, and seconds
            $hours = $diff->h;
            $minutes = $diff->i;
            $seconds = $diff->s;

            if ($hours == 0) {
                $hours = "00";
            } elseif ($hours > 0 && $hours < 10) {
                $hours = "0" . $hours;
            }

            if ($minutes == 0) {
                $minutes = "00";
            } elseif ($minutes > 0 && $minutes < 10) {
                $minutes = "0" . $minutes;
            }

            if ($seconds == 0) {
                $seconds = "00";
            } elseif ($seconds > 0 && $seconds < 10) {
                $seconds = "0" . $seconds;
            }

            $duration = "$hours:$minutes:$seconds";

            // Using the update method to update the login session
            LoginSession::where("id", session('login_session_id'))
                ->update([
                    "last_activity_time" => $time_now_unformatted,
                    "status" => "Inactive",
                    "duration" => $duration,
                ]);
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('sign-in.index')->with('success', 'Account logged out');
    }
}
