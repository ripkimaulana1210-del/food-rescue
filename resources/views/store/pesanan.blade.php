@extends('layouts.app')

@section('title', 'Pesanan Masuk')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection

@section('content')
    <div class="orders-page-header">
        <h2 class="orders-title">Pesanan Masuk</h2>
        <a href="{{ route('orders.scan') }}" class="btn-scan">
            <span>QR</span>
            Scan QR
        </a>
    </div>

    <div class="orders-container">
        @forelse ($orders as $order)
            <div class="order-card"
                onclick="showDetail(
                    '{{ $order->food->food_name }}',
                    '{{ $order->user->name }}',
                    '{{ $order->qty }}',
                    '{{ number_format($order->total_price) }}',
                    '{{ $order->order_code }}',
                    '{{ $order->id }}',
                    '{{ $order->status }}'
                )"
                style="cursor:pointer;">

                <div class="order-left">
                    <h3>{{ $order->food->food_name }}</h3>
                    <p class="buyer">{{ $order->user->name }}</p>

                    <p class="order-code">
                        Kode: <b>{{ $order->order_code }}</b>
                    </p>

                    <p class="order-id">
                        ID: #{{ $order->id }}
                    </p>
                </div>

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

                    <div class="order-qr">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $order->order_code }}"
                            alt="QR pesanan {{ $order->order_code }}">
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-box">
                <p>Belum ada pesanan masuk</p>
            </div>
        @endforelse
    </div>

    <div id="order-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Detail Pesanan</h3>
            <div id="modal-body"></div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/orders.js') }}"></script>
@endsection
