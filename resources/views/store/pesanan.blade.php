@extends('layouts.app')

@section('title', 'Pesanan Masuk - Food Rescue')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection

@section('meta')
    <meta name="user-id" content="{{ auth()->id() }}">
    <meta name="order-type" content="seller">
@endsection

@section('content')
    <div class="orders-wrapper">
        <div class="orders-container">

            <div class="orders-header">
                <h2 class="orders-title">📦 Pesanan Masuk</h2>
                <a href="{{ route('orders.scan') }}" class="btn-scan">📷 Scan QR</a>
            </div>

            <!-- FILTER TABS -->
            <div class="filter-tabs">
                <a href="{{ route('store.orders') }}" class="filter-tab {{ !$status ? 'active' : '' }}">Semua</a>
                <a href="{{ route('store.orders', ['status' => 'pending']) }}" class="filter-tab {{ $status == 'pending' ? 'active' : '' }}">⏳ Pending</a>
                <a href="{{ route('store.orders', ['status' => 'paid']) }}" class="filter-tab {{ $status == 'paid' ? 'active' : '' }}">✔ Paid</a>
                <a href="{{ route('store.orders', ['status' => 'done']) }}" class="filter-tab {{ $status == 'done' ? 'active' : '' }}">✅ Selesai</a>
            </div>

            @forelse ($orders as $order)
                <div class="order-card" data-order-id="{{ $order->id }}" onclick="showDetail('{{ $order->food->food_name }}', '{{ $order->user->name }}', '{{ $order->qty }}', '{{ number_format($order->total_price) }}', '{{ $order->order_code }}', '{{ $order->id }}', '{{ $order->status }}')">

                    <!-- LEFT -->
                    <div class="order-left">
                        <h3>{{ $order->food->food_name }}</h3>
                        <p class="buyer">👤 {{ $order->user->name }}</p>
                        <p class="order-code">Kode: <b>{{ $order->order_code }}</b></p>
                        <p class="order-id">ID: #{{ $order->id }}</p>
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

                @if ($order->status == 'pending')
                <div class="confirm-form">
                    <form action="{{ route('orders.confirm', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-confirm">✔ Konfirmasi Pembayaran</button>
                    </form>
                </div>
                @endif

            @empty
                <div class="empty-box">
                    <div class="empty-icon">😢</div>
                    <h3>Belum ada pesanan masuk</h3>
                    <p>Pesanan dari pelanggan akan muncul di sini</p>
                </div>
            @endforelse

        </div>

    <div id="order-modal" class="modal">
        <div class="modal-content">
            <button class="close" onclick="closeModal()">&times;</button>
            <h3>📦 Detail Pesanan</h3>
            <div id="modal-body"></div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/orders.js') }}"></script>
    <script src="{{ asset('js/realtime.js') }}"></script>
    @if (session('highlight_order'))
        @php
            $highlightOrder = $orders->firstWhere('id', session('highlight_order'));
        @endphp
        @if ($highlightOrder)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    showDetail(
                        '{{ $highlightOrder->food->food_name }}',
                        '{{ $highlightOrder->user->name }}',
                        '{{ $highlightOrder->qty }}',
                        '{{ number_format($highlightOrder->total_price) }}',
                        '{{ $highlightOrder->order_code }}',
                        '{{ $highlightOrder->id }}',
                        '{{ $highlightOrder->status }}'
                    );
                    const card = document.querySelector('[data-order-id="{{ $highlightOrder->id }}"]');
                    if (card) {
                        card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        card.style.boxShadow = '0 0 0 3px var(--primary)';
                        setTimeout(() => { card.style.boxShadow = ''; }, 2000);
                    }
                }, 500);
            });
        </script>
        @endif
    @endif
@endsection
