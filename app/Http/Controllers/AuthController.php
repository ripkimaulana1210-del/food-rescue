<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {

                if (auth()->user()->role == 'store') {
                    return redirect('/pesanan'); // store
                } else {
                    return redirect('/my-orders'); // user
                }
            }
        }

        return back()->with('error', 'Login gagal');
    }

    public function register(Request $request)
    {

        User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role

        ]);
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
