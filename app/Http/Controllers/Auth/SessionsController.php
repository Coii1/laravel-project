<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SessionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("auth.login");
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', Password::default()]
        ]);

        //dd($validated);

        if(Auth::attempt($validated)) {
            $request->session()->regenerate();  // ensure every time you sign in, you get a new session id to prevent session fixation attacks
            return redirect('/ideas');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            // 'password' => 'The provided password is incorrect. [for testing purposes only, should not specify which one is incorrect for security]'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect('/ideas');
    }
}
