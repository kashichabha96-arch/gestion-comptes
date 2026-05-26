<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/dashboard';
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /*public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } 

        return back()->with('error', 'Email ou mot de passe incorrect');
    }*/
 public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        return redirect('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email ou mot de passe incorrect'
    ]);
}
}
