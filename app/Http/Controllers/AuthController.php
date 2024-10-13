<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Lengkapi Email terlebih dahulu',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Lengkapi Password terlebih dahulu',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak teregistrasi',
            ]);
        }
        if ($user->status !== 'active') {
            return back()->withErrors([
                'email' => 'Akun anda tidak aktif. Silahkan kontak admin!',
            ]);
        }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    // Show register form
    // public function showRegisterForm()
    // {
    //     return view('auth.register');
    // }

    // // Handle registration logic
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     try {
    //         $user = User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //             'role' => 'admin', // Default role
    //         ]);
    //         Auth::login($user);

    //         return redirect('/login');
    //     } catch (\Exception $e) {
    //         return back()->withErrors(['error' => 'Registration failed. Please try again.']);
    //     }
    // }

    // Show login form
    public function profile()
    {
        return 'Profil' . Auth::user()->role;
    }


    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
