@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="auth-wrapper">
    <div class="auth-box">

        <div class="auth-header">
            <h2>Selamat Datang</h2>
            <p>Login untuk lanjut ke Food Rescue</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>

            <button type="submit" class="btn-auth">Masuk</button>
        </form>

        <p class="auth-switch">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar</a>
        </p>

    </div>
</div>
@endsection