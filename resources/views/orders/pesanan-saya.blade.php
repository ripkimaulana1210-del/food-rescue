@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')

<div class="orders-wrapper">
    <div class="orders-container">

        <h2 class="section-title">Pesanan Saya</h2>

        @forelse ($orders as $order)

        <div class="order-card">

            <!-- LEFT -->
            <div class="order-left">

                <img src="{{ asset('storage/' . $order->food->image) }}" alt="food">

            </div>

            <!-- CENTER -->
            <div class="order-center">

                <h3>{{ $order->food->food_name }}</h3>
                <p class="store-name">🏪 {{ $order->food->store_name }}</p>

                <p>Jumlah: <b>{{ $order->qty }}</b> porsi</p>
                <p>Total: <b>Rp {{ number_format($order->total_price) }}</b></p>

                <p class="date">
                    {{ $order->created_at->format('d M Y H:i') }}
                </p>

                <!-- 🔥 ORDER CODE -->
                <div class="order-code">
                    Kode Pesanan:
                    <b>{{ $order->order_code ?? '-' }}</b>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="order-right">

                <span class="status paid">✔ Paid</span>

            </div>

        </div>

        @empty

        <div class="empty-box">
            <p>😢 Belum ada pesanan</p>
        </div>

        @endforelse

    </div>
</div>

@endsection