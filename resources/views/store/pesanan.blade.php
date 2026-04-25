@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
    <style>
        .filter-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .filter-tab {
            padding: 8px 18px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            background: #f5f5f5;
            color: #666;
            transition: 0.2s;
        }
        .filter-tab:hover {
            background: #eee;
        }
        .filter-tab.active {
            background: var(--green, #4CAF50);
            color: white;
        }
        .confirm-form {
            text-align: right;
            margin-top: -10px;
            margin-bottom: 15px;
        }
        .btn-confirm {
            background: var(--green, #4CAF50);
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 0.85rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-confirm:hover {
            opacity: 0.9;
        }
    </style>
@endsection

@section('content')
    <div class="orders-wrapper">
        <div class="orders-container">

            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;flex-wrap:wrap;gap:10px;">
                <h2 class="orders-title">📦 Pesanan Masuk</h2>

                <a href="{{ route('orders.scan') }}" class="btn-scan">
                    📷 Scan QR
                </a>
            </div>

            <!-- FILTER TABS -->
            <div class="filter-tabs">
                <a href="{{ route('store.orders') }}"
                   class="filter-tab {{ !$status ? 'active' : '' }}">
                    Semua
                </a>
                <a href="{{ route('store.orders', ['status' => 'pending']) }}"
                   class="filter-tab {{ $status == 'pending' ? 'active' : '' }}">
                    ⏳ Pending
                </a>
                <a href="{{ route('store.orders', ['status' => 'paid']) }}"
                   class="filter-tab {{ $status == 'paid' ? 'active' : '' }}">
                    ✔ Paid
                </a>
                <a href="{{ route('store.orders', ['status' => 'done']) }}"
                   class="filter-tab {{ $status == 'done' ? 'active' : '' }}">
                    ✅ Selesai
                </a>
            </div>

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

                    <!-- LEFT -->
                    <div class="order-left">
                        <h3>{{ $order->food->food_name }}</h3>
                        <p class="buyer">👤 {{ $order->user->name }}</p>

                        <p class="order-code">
                            Kode: <b>{{ $order->order_code }}</b>
                        </p>

                        <p class="order-id">
                            ID: #{{ $order->id }}
                        </p>
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

                        <div style="margin-top:10px;">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $order->order_code }}"
                                alt="QR">
                        </div>

                </div>

                @if ($order->status == 'pending')
                <div class="confirm-form">
                    <form action="{{ route('orders.confirm', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-confirm">
                            ✔ Konfirmasi Pembayaran
                        </button>
                    </form>
                </div>
                @endif

            @empty
                <div class="empty-box">
                    <p>😢 Belum ada pesanan masuk</p>
                </div>
            @endforelse

        </div>

    <div id="order-modal" class="modal">
        <div class="modal-content">

            <span class="close">&times;</span>

            <h3>📦 Detail Pesanan</h3>

            <div id="modal-body"></div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/orders.js') }}"></script>
@endsection
