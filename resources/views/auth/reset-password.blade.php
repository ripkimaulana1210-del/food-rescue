@extends('layouts.app')

@section('title', 'Reset Password - Food Rescue')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-page">
    <div class="auth-card">

        <div class="auth-header">
            <div class="auth-icon">🔑</div>
            <h2>Buat Password Baru</h2>
            <p>Masukkan password baru untuk akun Anda</p>
        </div>

        @if(session('error'))
            <div class="auth-alert error">
                <span>✕</span> {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="auth-alert error">
                <span>✕</span> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.reset.post') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label class="form-label">Password Baru</label>
                <div class="password-wrapper">
                    <input type="password" name="password" class="form-input" id="passwordInput" placeholder="Minimal 6 karakter" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('passwordInput', this)">👁️</button>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password Baru</label>
                <div class="password-wrapper">
                    <input type="password" name="password_confirmation" class="form-input" id="confirmInput" placeholder="Ulangi password baru" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('confirmInput', this)">👁️</button>
                </div>
            </div>

            <button type="submit" class="btn-auth">Simpan Password Baru</button>
        </form>

        <p class="auth-footer">
            <a href="{{ route('login') }}">Kembali ke Login</a>
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

