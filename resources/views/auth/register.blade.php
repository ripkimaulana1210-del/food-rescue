@extends('layouts.app')

@section('title', 'Daftar - Food Rescue')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')

<!-- LEFT SIDE -->
<div class="auth-left">
    <div class="auth-left-overlay"></div>
    <div class="auth-left-content">
        <h1>Bergabung dengan<br>Food Rescue</h1>
        <p>Jadilah bagian dari gerakan penyelamatan makanan terbesar di Indonesia.</p>
        <div class="auth-left-dots">
            <span class="active"></span>
            <span></span>
            <span></span>
        </div>
</div>

<!-- RIGHT SIDE -->
<div class="auth-right">

    <div class="auth-box">

        <div class="auth-header">
            <h2>Buat Akun Baru</h2>
            <p>Gabung dan mulai selamatkan makanan</p>
        </div>

        @if(session('error'))
            <div class="auth-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="input-group">
                <input type="text" name="name" required placeholder=" " id="name">
                <label for="name">Nama Lengkap</label>
                <i class="input-icon">👤</i>
            </div>

            <div class="input-group">
                <input type="email" name="email" required placeholder=" " id="email">
                <label for="email">Email</label>
                <i class="input-icon">✉️</i>
            </div>

            <div class="input-group">
                <input type="password" name="password" required placeholder=" " id="password">
                <label for="password">Password</label>
                <i class="input-icon toggle-password" data-target="password">👁️</i>
            </div>

            <div class="input-group">
                <select name="role" required id="role">
                    <option value="" disabled selected></option>
                    <option value="user">User (Pembeli)</option>
                    <option value="store">Store (Penjual)</option>
                </select>
                <label for="role">Pilih Role</label>
                <i class="input-icon">🏷️</i>
            </div>

            <button type="submit" class="btn-auth" id="btnRegister">
                <span class="btn-text">Daftar Sekarang</span>
                <span class="btn-loader" style="display: none;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                        <path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round">
                            <animateTransform attributeName="transform" type="rotate" from="0 12 12" to="360 12 12" dur="1s" repeatCount="indefinite"/>
                        </path>
                    </svg>
                </span>
            </button>
        </form>

        <div class="auth-divider">
            <span>atau daftar dengan</span>
        </div>

        <a href="{{ route('google.login') }}" class="btn-google">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google">
            Lanjutkan dengan Google
        </a>

        <p class="auth-switch">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk</a>
        </p>

    </div>

<script>
    /* Password Toggle */
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', () => {
            const target = document.getElementById(icon.dataset.target);
            if (target.type === 'password') {
                target.type = 'text';
                icon.textContent = '🙈';
            } else {
                target.type = 'password';
                icon.textContent = '👁️';
            }
        });
    });

    /* Loading State */
    document.getElementById('registerForm').addEventListener('submit', function() {
        const btn = document.getElementById('btnRegister');
        btn.disabled = true;
        btn.querySelector('.btn-text').style.display = 'none';
        btn.querySelector('.btn-loader').style.display = 'inline-block';
    });
</script>

@endsection
