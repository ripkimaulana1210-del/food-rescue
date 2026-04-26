@extends('layouts.app')

@section('title', 'Lupa Password - Food Rescue')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-page">
    <div class="auth-card">

        <div class="auth-header">
            <div class="auth-icon">🔐</div>
            <h2>Lupa Password?</h2>
            <p>Masukkan email Anda, kami akan kirimkan kode verifikasi</p>
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

        @if ($errors->any())
            <div class="auth-alert error">
                <span>✕</span> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
            </div>

            <button type="submit" class="btn-auth">Kirim Kode Verifikasi</button>
        </form>

        <p class="auth-footer">
            Ingat password? <a href="{{ route('login') }}">Login</a>
        </p>

    </div>
</div>
@endsection

