@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="auth-wrapper">
    <div class="auth-box">

        <div class="auth-header">
            <h2>Buat Akun Baru</h2>
            <p>Gabung dan mulai selamatkan makanan</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <input type="text" name="name" required>
                <label>Nama</label>
            </div>

            <div class="input-group">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <div class="input-group">
                <select name="role" required>
                    <option value="" disabled selected hidden></option>
                    <option value="user">User</option>
                    <option value="store">Store</option>
                </select>
                <label>Pilih Role</label>
            </div>

            <button type="submit" class="btn-auth">Daftar</button>
        </form>

        <p class="auth-switch">
            Sudah punya akun? <a href="{{ route('login') }}">Login</a>
        </p>

    </div>
</div>
@endsection