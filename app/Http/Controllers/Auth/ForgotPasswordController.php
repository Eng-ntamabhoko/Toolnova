<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(64);

            DB::table('password_resets')->updateOrInsert(
                ['email' => $user->email],
                [
                    'token' => hash('sha256', $token),
                    'created_at' => Carbon::now(),
                ]
            );

            // Minimal: show reset link on screen instead of email to keep things simple.
            return back()->with('status', 'Password reset link generated. Use: ' . route('password.reset', $token) . '?email=' . urlencode($user->email));
        }

        return back()->with('status', 'If your email is registered, a reset URL has been generated.');
    }
}
