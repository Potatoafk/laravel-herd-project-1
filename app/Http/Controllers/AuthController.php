<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup_page() {
        return view('signup');
    }

    public function signup(Request $request) {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        // Create the user
        $user = User::create([
            // 'first_name' => $request->firstname,
            // 'last_name' => $request->lastname,
            'name' => $request->firstname . ' ' . $request->lastname,
            'email' => $request->email,
            'email_verified_at' => now(),
            'remember_token' => '',
            'created_at' => now(),
            'updated_at' => now(),
            'password' => bcrypt($request->password),
        ]);

        // Log the user in
        auth()->login($user);

        return redirect()->route('homepage')->with('success', 'Account created successfully!');
    }
}
