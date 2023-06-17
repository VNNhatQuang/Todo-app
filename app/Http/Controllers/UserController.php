<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['showRegistrationForm', 'register', 'showLoginForm', 'login']);
    }

    public function showRegistrationForm()
    {
        return view('account.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255|unique:users',
            'full_name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'image|max:2048',
        ]);

        $avatarPath = $request->file('avatar')->store('avatars', 'public');

        User::create([
            'user_name' => $request->user_name,
            'full_name' => $request->full_name,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please log in.');
    }

    public function showLoginForm()
    {
        return view('account.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = User::where('user_name', $request->input('user_name'))->first();
            $request->session()->put('user', $user);
            return redirect()->intended('/all');
        }
        return back()->withErrors([
            'user_name' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
