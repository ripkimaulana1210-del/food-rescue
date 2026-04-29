@extends('layouts.app')

@section('title', 'Checkout - Food Rescue')

@section('css')
<link rel="stylesheet" href="{{ secure_asset('css/checkout.css') }}">
@endsection

@section('content')

<div class="checkout-wrapper">

    <div class="checkout-header">
        <h2>🛒 Checkout</h2>
        <p>Selesaikan pesananmu dalam beberapa langkah mudah</p>
    </div>

    <div class="checkout-container">

        <!-- ORDER SUMMARY -->
        <div class="checkout-card order-summary">

            <h4>📋 Ringkasan Pesanan</h4>

            <div class="food-info">
                <div class="food-detail">
                    <h3>{{ $food->food_name }}</h3>
                    <p class="store-name">🏪 {{ $food->store_name }}</p>
                </div>
            </div>

            <div class="order-detail">
                <div class="order-row">
                    <span>Harga per porsi</span>
                    <span>Rp {{ number_format($food->rescue_price) }}</span>
                </div>

                <div class="order-row">
                    <span>Jumlah porsi</span>
                    <span>{{ $qty }} porsi</span>
                </div>

                <div class="order-divider"></div>

                <div class="order-row total">
                    <span>Total Pembayaran</span>
                    <span class="total-price">Rp {{ number_format($food->rescue_price * $qty) }}</span>
                </div>
            </div>

        </div>

        <!-- PAYMENT -->
        <div class="checkout-card payment-card">

            <h4>💳 Metode Pembayaran</h4>

            <form action="{{ route('orders.store', $food->id) }}" method="POST">
                @csrf

                <input type="hidden" name="qty" value="{{ $qty }}">

                <div class="payment-options">

                    <!-- QRIS -->
                    <label class="payment-option">
                        <input type="radio" name="payment" value="qris" required>
                        <div class="payment-label">
                            <span class="payment-icon">📱</span>
                            <div>
                                <p class="payment-name">QRIS</p>
                                <p class="payment-desc">Scan & bayar langsung</p>
                            </div>
                        </div>
                    </label>

                    <!-- TRANSFER -->
                    <label class="payment-option">
                        <input type="radio" name="payment" value="transfer">
                        <div class="payment-label">
                            <span class="payment-icon">🏦</span>
                            <div>
                                <p class="payment-name">Transfer Bank</p>
                                <p class="payment-desc">BCA, Mandiri, BNI, BRI</p>
                            </div>
                        </div>
                    </label>

                    <!-- CASH -->
                    <label class="payment-option">
                        <input type="radio" name="payment" value="cash">
                        <div class="payment-label">
                            <span class="payment-icon">💵</span>
                            <div>
                                <p class="payment-name">Cash on Pickup</p>
                                <p class="payment-desc">Bayar saat ambil pesanan</p>
                            </div>
                        </div>
                    </label>

                </div>

                <button type="submit" class="btn-pay">Bayar Sekarang</button>

            </form>

        </div>

    </div>

</div>

@endsection
