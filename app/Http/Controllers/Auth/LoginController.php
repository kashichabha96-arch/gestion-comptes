<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 🔥 Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // 🔥 DEBUG LOG 1
        Log::info('LOGIN ATTEMPT', [
            'email' => $request->email,
        ]);

        // 🔥 AUTH ATTEMPT
        if (Auth::attempt($credentials)) {

            // 🔥 CRITICAL FIX (session persistence)
            $request->session()->regenerate();

            // 🔥 DEBUG LOG 2
            Log::info('LOGIN SUCCESS', [
                'user_id' => Auth::id(),
                'email' => Auth::user()->email ?? null,
            ]);

            // 🔥 optional debug session
            Log::info('SESSION DATA AFTER LOGIN', session()->all());

            return redirect()->intended('/dashboard');
        }

        // 🔥 DEBUG LOG 3 (fail case)
        Log::warning('LOGIN FAILED', [
            'email' => $request->email,
        ]);

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
