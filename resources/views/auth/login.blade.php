@extends('layouts.app')

@section('title', 'Login - FoodRescue')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-brandmark">FR</div>
            <h2>Selamat Datang Kembali</h2>
            <p>Masuk untuk melanjutkan pesanan atau mengelola produk.</p>
        </div>

        @if(session('status'))
            <div class="auth-alert success">
                <span>OK</span> {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="auth-alert error">
                <span>!</span> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" class="form-input" id="email" placeholder="nama@email.com" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label" for="passwordInput">Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" class="form-input" id="passwordInput" placeholder="Password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('passwordInput', this)">Lihat</button>
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

        <p class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </div>
</div>
@endsection

@section('js')
<script>
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const visible = input.type === 'text';

    input.type = visible ? 'password' : 'text';
    btn.textContent = visible ? 'Lihat' : 'Tutup';
}
</script>
@endsection
