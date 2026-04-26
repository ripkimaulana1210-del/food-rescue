@extends('layouts.app')

@section('title', 'Login - Food Rescue')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-page">
    <div class="auth-card">

        <div class="auth-header">
            <div class="auth-icon">🍔</div>
            <h2>Selamat Datang Kembali</h2>
            <p>Login untuk melanjutkan ke Food Rescue</p>
        </div>

        @if(session('status'))
            <div class="auth-alert success">
                <span>✓</span> {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="auth-alert error">
                <span>✕</span> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" placeholder="nama@email.com" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" class="form-input" id="passwordInput" placeholder="••••••••" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('passwordInput', this)">👁️</button>
                </div>
            </div>

            <div class="auth-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span>Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="forgot-link">Lupa Password?</a>
            </div>

            <button type="submit" class="btn-auth">Masuk</button>
        </form>

        <div class="auth-divider">atau</div>

        <a href="{{ route('google.login') }}" class="btn-google">
            <svg width="20" height="20" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            Login dengan Google
        </a>

        <p class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>

    </div>
</div>

<script>
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
        btn.textContent = '🙈';
    } else {
        input.type = 'password';
        btn.textContent = '👁️';
    }
}
</script>
@endsection

