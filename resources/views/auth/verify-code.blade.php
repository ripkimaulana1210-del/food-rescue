@extends('layouts.app')

@section('title', 'Verifikasi Kode - FoodRescue')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-brandmark">FR</div>
            <h2>Verifikasi Kode</h2>
            <p>Masukkan kode 6 digit yang dikirim ke email kamu.</p>
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

        @if ($errors->any())
            <div class="auth-alert error">
                <span>!</span> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.verify-code.post') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label class="form-label" for="code">Kode Verifikasi</label>
                <input type="text" name="code" class="form-input code-field" id="code" placeholder="000000" maxlength="6" required autofocus>
                <p class="form-help">Kode berlaku 60 menit.</p>
            </div>

            <button type="submit" class="btn-auth">Verifikasi Kode</button>
        </form>

        <p class="auth-footer">
            Tidak menerima kode? <a href="{{ route('password.request') }}">Kirim ulang</a>
        </p>
    </div>
</div>
@endsection
