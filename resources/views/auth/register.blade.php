@extends('layouts.app')

@section('title', 'Daftar - FoodRescue')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-page">
    <div class="auth-card auth-card-wide">
        <div class="auth-header">
            <div class="auth-brandmark">FR</div>
            <h2>Buat Akun Baru</h2>
            <p>Gabung sebagai pembeli atau mitra toko untuk mulai menyelamatkan makanan.</p>
        </div>

        @if(session('error'))
            <div class="auth-alert error">
                <span>!</span> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="auth-form" id="registerForm">
            @csrf

            <div class="form-group">
                <label class="form-label" for="name">Nama Lengkap</label>
                <input type="text" name="name" class="form-input" id="name" placeholder="Nama kamu" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" class="form-input" id="email" placeholder="nama@email.com" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" class="form-input" id="password" placeholder="Minimal 8 karakter" required>
                    <button type="button" class="password-toggle" data-target="password">Lihat</button>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="role">Role</label>
                <select name="role" class="form-input" id="role" required>
                    <option value="" disabled selected>Pilih role</option>
                    <option value="user">User (Pembeli)</option>
                    <option value="store">Store (Penjual)</option>
                </select>
            </div>

            <button type="submit" class="btn-auth" id="btnRegister">
                <span class="btn-text">Daftar Sekarang</span>
                <span class="btn-loader" style="display: none;">Memproses...</span>
            </button>
        </form>

        <div class="auth-highlights">
            <span>Harga transparan</span>
            <span>Stok real-time</span>
            <span>Ambil di lokasi</span>
        </div>

        <p class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </p>
    </div>
</div>
@endsection

@section('js')
<script>
document.querySelectorAll('.password-toggle').forEach(button => {
    button.addEventListener('click', () => {
        const target = document.getElementById(button.dataset.target);
        const visible = target.type === 'text';

        target.type = visible ? 'password' : 'text';
        button.textContent = visible ? 'Lihat' : 'Tutup';
    });
});

document.getElementById('registerForm').addEventListener('submit', function() {
    const btn = document.getElementById('btnRegister');

    btn.disabled = true;
    btn.querySelector('.btn-text').style.display = 'none';
    btn.querySelector('.btn-loader').style.display = 'inline-block';
});
</script>
@endsection
