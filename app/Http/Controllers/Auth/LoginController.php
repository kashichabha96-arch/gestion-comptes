public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    // 🔥 DEBUG 1 : check input
    logger()->info('LOGIN ATTEMPT', $credentials);

    if (Auth::attempt($credentials)) {

        // 🔥 DEBUG 2 : auth OK
        logger()->info('AUTH SUCCESS', [
            'user' => Auth::user(),
            'id' => Auth::id(),
        ]);

        $request->session()->regenerate();

        // 🔥 DEBUG 3 : session data
        logger()->info('SESSION AFTER LOGIN', session()->all());

        return redirect()->intended('/dashboard');
    }

    // 🔥 DEBUG 4 : auth failed
    logger()->warning('AUTH FAILED', [
        'email' => $request->email,
    ]);

    return back()->withErrors([
        'email' => 'Email ou mot de passe incorrect'
    ]);
}
