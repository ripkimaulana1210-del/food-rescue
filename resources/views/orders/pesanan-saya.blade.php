@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection

@section('content')

<div class="orders-wrapper">
    <div class="orders-container">

        <h2 class="orders-title">📦 Pesanan Saya</h2>

        @forelse ($orders as $order)

        <div class="order-card"
            onclick="showDetail(
                '{{ $order->food->food_name }}',
                '{{ $order->food->store_name }}',
                '{{ $order->qty }}',
                '{{ number_format($order->total_price) }}',
                '{{ $order->order_code }}',
                '{{ $order->id }}',
                '{{ $order->status }}'
            )"
            style="cursor:pointer;">

            <!-- LEFT -->
            <div class="order-left">
                <img src="{{ asset('storage/' . $order->food->image) }}" alt="{{ $order->food->food_name }}">
            </div>

            <!-- INFO (tengah) -->
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

                <div style="margin-top:10px;">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $order->order_code }}"
                        alt="QR">
                </div>

            </div>

        </div>

        @empty

        <div class="empty-box">
            <p>😢 Belum ada pesanan</p>
        </div>

        @endforelse

    </div>
</div>

<!-- MODAL -->
<div id="order-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>📦 Detail Pesanan</h3>
        <div id="modal-body"></div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('js/orders.js') }}"></script>
@endsection

