@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection

@section('content')

<h2 class="orders-title">📦 Pesanan Masuk</h2>

<div class="orders-container">

    @forelse ($orders as $order)
    <div class="order-card">

        <!-- LEFT -->
        <div class="order-left">
            <h3>{{ $order->food->food_name }}</h3>
            <p class="buyer">👤 {{ $order->user->name }}</p>
        </div>

        <!-- INFO -->
        <div class="order-info">

            <div class="order-box">
                <p>Jumlah</p>
                <strong>{{ $order->qty }}</strong>
            </div>

            <div class="order-box">
                <p>Total</p>
                <strong>Rp {{ number_format($order->total_price) }}</strong>
            </div>

        </div>

        <!-- STATUS -->
        <div class="order-right">
            <span class="status paid">✔ Paid</span>
        </div>

    </div>
    @empty
    <div class="empty-box">
        <p>😢 Belum ada pesanan masuk</p>
    </div>
    @endforelse

</div>

@endsection