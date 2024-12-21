<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if ($user->role == 'user') {
                return redirect()->route('users.dashboard');
            }
        }

        return back()->withErrors([
            'username' => 'Username salah',
            'password' => 'Password salah'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function index()
    {
        return view('admin.Dashboard.page');
    }
}
