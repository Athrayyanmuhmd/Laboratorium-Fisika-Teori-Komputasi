<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            
            // Debug logging
            \Log::info('Login successful', [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'is_admin_result' => $user->isAdmin(),
                'is_super_admin' => $user->isSuperAdmin()
            ]);

            // Route based on user role
            if ($user->isSuperAdmin()) {
                \Log::info('Redirecting to super admin dashboard');
                return redirect()->route('super-admin.dashboard')->with('success', 'Selamat datang kembali, Super Admin ' . $user->name . '!');
            } elseif ($user->isAdmin()) {
                \Log::info('Redirecting to regular admin dashboard');
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, ' . $user->name . '!');
            } else {
                // For non-admin users, redirect to home page
                \Log::info('Redirecting non-admin user to home page');
                return redirect()->route('home')->with('success', 'Selamat datang, ' . $user->name . '!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
