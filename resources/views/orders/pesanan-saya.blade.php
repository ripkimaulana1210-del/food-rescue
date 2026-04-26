@extends('layouts.app')

@section('title', 'Pesanan Saya - Food Rescue')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection

@section('meta')
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="order-type" content="buyer">
@endsection

@section('content')

<div class="orders-wrapper">
    <div class="orders-container">

        <div class="orders-header">
            <h2 class="orders-title">📦 Pesanan Saya</h2>
        </div>

        @forelse ($orders as $order)

        <div class="order-card" data-order-id="{{ $order->id }}" onclick="showDetail('{{ $order->food->food_name }}', '{{ $order->food->store_name }}', '{{ $order->qty }}', '{{ number_format($order->total_price) }}', '{{ $order->order_code }}', '{{ $order->id }}', '{{ $order->status }}')">

            <!-- LEFT -->
            <div class="order-left">
                <img src="{{ asset('storage/' . $order->food->image) }}" alt="{{ $order->food->food_name }}">
            </div>

            <!-- INFO -->
            <div class="order-info">
                <div class="order-box">
                    <p>Makanan</p>
                    <strong>{{ $order->food->food_name }}</strong>
                </div>
                <div class="order-box">
                    <p>Jumlah</p>
                    <strong>{{ $order->qty }}</strong>
                </div>
                <div class="order-box">
                    <p>Total</p>
                    <strong>Rp {{ number_format($order->total_price) }}</strong>
                </div>
                <div class="order-box">
                    <p>Kode Pesanan</p>
                    <strong>{{ $order->order_code ?? '-' }}</strong>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="order-right">
                @if ($order->status == 'paid')
                    <span class="status paid">✔ Paid</span>
                @elseif($order->status == 'process')
                    <span class="status process">⏳ Diproses</span>
                @elseif($order->status == 'done')
                    <span class="status done">✅ Selesai</span>
                @else
                    <span class="status pending">⌛ Pending</span>
                @endif

                <div>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ $order->order_code }}" alt="QR">
                </div>
            </div>

        </div>

        @empty

        <div class="empty-box">
            <div class="empty-icon">😢</div>
            <h3>Belum ada pesanan</h3>
            <p>Yuk jelajahi marketplace dan pesan makanan favoritmu!</p>
            <a href="{{ route('foods.index') }}" class="btn btn-primary" style="margin-top: var(--space-4);">Jelajahi Marketplace</a>
        </div>

        @endforelse

    </div>
</div>

<!-- MODAL -->
<div id="order-modal" class="modal">
    <div class="modal-content">
        <button class="close" onclick="closeModal()">&times;</button>
        <h3>📦 Detail Pesanan</h3>
        <div id="modal-body"></div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('js/orders.js') }}"></script>
    <script src="{{ asset('js/realtime.js') }}"></script>
@endsection

