<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Login berhasil!'
                    ]);
                }
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Email atau password salah!'
                ], 401);
            }

            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return back()->withErrors(['error' => 'Terjadi kesalahan']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Logout berhasil!'
            ]);
        }
    }
}
