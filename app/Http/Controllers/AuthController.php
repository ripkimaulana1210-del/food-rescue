<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\PasswordResetCode;
use Laravel\Socialite\Facades\Socialite;

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

    /* ===================== GOOGLE LOGIN ===================== */

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if ($user) {
                // Update google_id jika belum ada
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                }
            } else {
                // Buat user baru
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => null,
                    'role' => 'user', // Default role untuk Google login
                ]);
            }
            
            Auth::login($user);
            
            if ($user->role == 'store') {
                return redirect('/pesanan');
            } else {
                return redirect('/my-orders');
            }
            
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }
    }

    /* ===================== FORGOT PASSWORD ===================== */

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak ditemukan dalam sistem kami.',
        ]);

        $email = $request->email;
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Simpan atau update token di password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $code,
                'created_at' => now(),
            ]
        );

        // Kirim email
        Mail::to($email)->send(new PasswordResetCode($code, $email));

        // Simpan email di session untuk step selanjutnya
        session(['reset_email' => $email]);

        return redirect()->route('password.verify-code')->with('status', 'Kode verifikasi telah dikirim ke email Anda.');
    }

    public function showVerifyCodeForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-code');
    }

    public function verifyCode(Request $request)
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $email = session('reset_email');
        $code = $request->code;

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $code)
            ->first();

        if (!$record) {
            return back()->with('error', 'Kode verifikasi salah. Silakan coba lagi.');
        }

        // Cek expired (60 menit)
        if (now()->diffInMinutes($record->created_at) > 60) {
            return back()->with('error', 'Kode verifikasi sudah expired. Silakan minta kode baru.');
        }

        session(['code_verified' => true]);

        return redirect()->route('password.reset');
    }

    public function showResetPasswordForm()
    {
        if (!session('reset_email') || !session('code_verified')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        if (!session('reset_email') || !session('code_verified')) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'password' => 'required|min:6|confirmed',
        ], [
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $email = session('reset_email');

        $user = User::where('email', $email)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus token
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Hapus session
        session()->forget(['reset_email', 'code_verified']);

        return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru Anda.');
    }
}

