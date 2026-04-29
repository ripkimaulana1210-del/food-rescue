@extends('layouts.app')

@section('title', 'Pesanan Saya - Food Rescue')

@section('css')
<link rel="stylesheet" href="{{ secure_asset('css/orders.css') }}">
@endsection

@section('meta')
<meta name="user-id" content="{{ auth()->id() }}">
<meta name="order-type" content="buyer">
@endsection

@section('content')
<section class="orders-wrapper">
    <div class="orders-container">
        <div class="orders-header">
            <h1 class="orders-title">Pesanan Saya</h1>
        </div>

        @forelse ($orders as $order)
            <article class="order-card"
                data-order-id="{{ $order->id }}"
                onclick='showDetail(@js($order->food->food_name), @js($order->food->store_name), @js((string) $order->qty), @js(number_format($order->total_price)), @js($order->order_code), @js((string) $order->id), @js($order->status), @js($order->payment_method))'>

                <div class="order-left">
                    @if ($order->food->image)
                        <img src="{{ secure_asset('storage/' . $order->food->image) }}" alt="{{ $order->food->food_name }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&auto=format&fit=crop" alt="{{ $order->food->food_name }}">
                    @endif
                </div>

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
                    <div class="order-box">
                        <p>Metode Bayar</p>
                        <strong>{{ strtoupper($order->payment_method ?? '-') }}</strong>
                    </div>
                </div>

                <div class="order-right">
                    @if ($order->status == 'paid')
                        <span class="status paid">Paid</span>
                    @elseif($order->status == 'process')
                        <span class="status process">Diproses</span>
                    @elseif($order->status == 'done')
                        <span class="status done">Selesai</span>
                    @else
                        <span class="status pending">Pending</span>
                    @endif

                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ $order->order_code }}" alt="QR pesanan">
                </div>
            </article>
        @empty
            <div class="empty-box">
                <span class="empty-code">0</span>
                <h3>Belum ada pesanan</h3>
                <p>Jelajahi marketplace dan pesan makanan surplus pertama kamu.</p>
                <a href="{{ route('foods.index') }}" class="btn btn-primary">Jelajahi Marketplace</a>
            </div>
        @endforelse
    </div>
</section>

<div id="order-modal" class="modal">
    <div class="modal-content">
        <button class="close" onclick="closeModal()" type="button">&times;</button>
        <h3>Detail Pesanan</h3>
        <div id="modal-body"></div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ secure_asset('js/orders.js') }}"></script>
<script src="{{ secure_asset('js/realtime.js') }}"></script>
@endsection
