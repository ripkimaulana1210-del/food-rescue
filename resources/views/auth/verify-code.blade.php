@extends('layouts.app')

@section('title', 'Verifikasi Kode - Food Rescue')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-page">
    <div class="auth-card">

        <div class="auth-header">
            <div class="auth-icon">🔢</div>
            <h2>Verifikasi Kode</h2>
            <p>Masukkan kode 6 digit yang dikirim ke email Anda</p>
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

        <form method="POST" action="{{ route('password.verify-code.post') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label class="form-label">Kode Verifikasi</label>
                <input type="text" name="code" class="form-input" placeholder="000000" maxlength="6" required autofocus style="text-align: center; letter-spacing: 8px; font-size: 1.5rem; font-weight: 700;">
                <p style="text-align: center; font-size: 0.8rem; color: var(--gray-400); margin-top: var(--space-2);">Kode berlaku 60 menit</p>
            </div>

            <button type="submit" class="btn-auth">Verifikasi Kode</button>
        </form>

        <p class="auth-footer">
            Tidak menerima kode? <a href="{{ route('password.request') }}">Kirim ulang</a>
        </p>

    </div>
</div>
@endsection

