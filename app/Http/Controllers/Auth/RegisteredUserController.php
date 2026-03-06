<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use \App\Models\User;
use \Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        // Handle registration logic here
        // For example, validate and create a new user
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', Password::default()],
        ]);
        $validated['password'] = Hash::make($validated['password']);
        //dd($validated);
        // Create the user (this assumes you have a User model)
        $user = User::create($validated);

        //login the user after registration 
        Auth::login($user);

        // Redirect to login or dashboard after registration
        return redirect('/ideas');
    }
}
