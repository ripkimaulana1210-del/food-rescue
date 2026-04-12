@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endsection

@section('content')
    <div class="checkout-wrapper">
        <div class="checkout-card success-card">
            
            <div class="success-icon">
                <svg viewBox="0 0 24 24" width="72" height="72" stroke="var(--green, #4CAF50)" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>

            <h2 class="success-title">Pembayaran Berhasil!</h2>
            <p class="success-subtitle">Yeay! Makanan kamu berhasil dipesan dan sudah masuk ke sistem.</p>

            <div class="success-details">
                <div class="order-row">
                    <span>Metode Pembayaran</span>
                    <strong>{{ strtoupper($payment) }}</strong>
                </div>
                <div class="order-divider"></div>
                <div class="order-row">
                    <span>Status</span>
                    <strong style="color: var(--green, #4CAF50);">Lunas</strong>
                </div>
            </div>

            <div class="success-alert">
                <p>📍 <strong>Penting:</strong> Silakan ambil makanan langsung di lokasi toko sesuai pesananmu ya.</p>
            </div>

            <a href="/foods" class="btn-action">
                Kembali ke Marketplace
            </a>

        </div>
    </div>
@endsection