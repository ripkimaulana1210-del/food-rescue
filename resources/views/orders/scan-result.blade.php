@extends('layouts.app')

@section('title', 'Detail Pesanan - FoodRescue')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <style>
        .scan-result-wrapper {
            max-width: 600px;
            margin: 0 auto;
            padding: var(--space-6) var(--space-4);
        }

        .scan-result-card {
            background: white;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            padding: var(--space-6);
            margin-bottom: var(--space-4);
        }

        .scan-result-header {
            text-align: center;
            margin-bottom: var(--space-6);
        }

        .scan-result-header h2 {
            font-size: 1.5rem;
            color: var(--gray-900);
            margin-bottom: var(--space-2);
        }

        .scan-result-header p {
            color: var(--gray-500);
            font-size: 0.95rem;
        }

        .order-detail-section {
            margin-bottom: var(--space-6);
        }

        .order-detail-section h4 {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-500);
            margin-bottom: var(--space-3);
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--space-3) 0;
            border-bottom: 1px solid var(--gray-100);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-row span:first-child {
            color: var(--gray-600);
            font-size: 0.95rem;
        }

        .detail-row span:last-child,
        .detail-row strong {
            color: var(--gray-900);
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-badge.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-badge.paid {
            background: #d1fae5;
            color: #065f46;
        }

        .status-badge.done {
            background: #dbeafe;
            color: #1e40af;
        }

        .qr-display {
            text-align: center;
            padding: var(--space-4);
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            margin-bottom: var(--space-4);
        }

        .qr-display img {
            border-radius: var(--radius-lg);
            border: 4px solid white;
            box-shadow: var(--shadow-sm);
        }

        .qr-display p {
            margin-top: var(--space-2);
            font-size: 0.9rem;
            color: var(--gray-600);
        }

        .qr-display .order-code-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 2px;
            margin-top: var(--space-1);
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: var(--space-3);
            margin-top: var(--space-6);
        }

        .btn-action {
            display: block;
            width: 100%;
            padding: 14px;
            border-radius: var(--radius-lg);
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-confirm-payment {
            background: var(--primary);
            color: white;
        }

        .btn-confirm-payment:hover {
            background: var(--primary-dark);
        }

        .btn-complete {
            background: #059669;
            color: white;
        }

        .btn-complete:hover {
            background: #047857;
        }

        .btn-back {
            background: var(--gray-100);
            color: var(--gray-700);
        }

        .btn-back:hover {
            background: var(--gray-200);
        }

        .info-alert {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: var(--space-4);
            border-radius: var(--radius-md);
            margin-bottom: var(--space-4);
            color: #1e40af;
            font-size: 0.95rem;
        }

        .success-alert {
            background: #ecfdf5;
            border-left: 4px solid #10b981;
            padding: var(--space-4);
            border-radius: var(--radius-md);
            margin-bottom: var(--space-4);
            color: #065f46;
            font-size: 0.95rem;
        }
    </style>
@endsection

@section('content')
    <div class="scan-result-wrapper">

        <!-- Header -->
        <div class="scan-result-header">
            <h2>📦 Detail Pesanan</h2>
            <p>Pesanan ditemukan. Berikut detail lengkapnya.</p>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="success-alert">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="info-alert" style="background: #fef2f2; border-color: #ef4444; color: #991b1b;">
                <span>✕</span> {{ session('error') }}
            </div>
        @endif

        <!-- QR & Order Code -->
        <div class="scan-result-card">
            <div class="qr-display">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $order->order_code }}" alt="QR Code">
                <p>Kode Pesanan</p>
                <div class="order-code-text">{{ $order->order_code }}</div>
            </div>
        </div>

        <!-- Order Info -->
        <div class="scan-result-card">
            <div class="order-detail-section">
                <h4>📋 Informasi Pesanan</h4>
                <div class="detail-row">
                    <span>ID Pesanan</span>
                    <strong>#{{ $order->id }}</strong>
                </div>
                <div class="detail-row">
                    <span>Nama Makanan</span>
                    <strong>{{ $order->food->food_name }}</strong>
                </div>
                <div class="detail-row">
                    <span>Nama Toko</span>
                    <strong>{{ $order->food->store_name }}</strong>
                </div>
                <div class="detail-row">
                    <span>Jumlah</span>
                    <strong>{{ $order->qty }} porsi</strong>
                </div>
                <div class="detail-row">
                    <span>Total Harga</span>
                    <strong>Rp {{ number_format($order->total_price) }}</strong>
                </div>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="scan-result-card">
            <div class="order-detail-section">
                <h4>👤 Informasi Pelanggan</h4>
                <div class="detail-row">
                    <span>Nama Pelanggan</span>
                    <strong>{{ $order->user->name }}</strong>
                </div>
                <div class="detail-row">
                    <span>Email</span>
                    <strong>{{ $order->user->email }}</strong>
                </div>
            </div>
        </div>

        <!-- Payment Info -->
        <div class="scan-result-card">
            <div class="order-detail-section">
                <h4>💳 Informasi Pembayaran</h4>
                <div class="detail-row">
                    <span>Metode Pembayaran</span>
                    <strong>{{ strtoupper($order->payment_method ?? 'Belum dipilih') }}</strong>
                </div>
                <div class="detail-row">
                    <span>Status</span>
                    @if ($order->status == 'pending')
                        <span class="status-badge pending">⌛ Pending</span>
                    @elseif($order->status == 'paid')
                        <span class="status-badge paid">✔ Paid</span>
                    @elseif($order->status == 'done')
                        <span class="status-badge done">✅ Selesai</span>
                    @else
                        <span class="status-badge pending">{{ ucfirst($order->status) }}</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            @if ($order->status == 'pending')
                <div class="info-alert">
                    <strong>⏳ Menunggu Konfirmasi:</strong> Pelanggan telah memilih metode pembayaran <strong>{{ strtoupper($order->payment_method) }}</strong>. Konfirmasi pembayaran untuk melanjutkan.
                </div>
                <form action="{{ route('orders.confirm', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-action btn-confirm-payment">
                        ✔ Konfirmasi Pembayaran
                    </button>
                </form>
            @elseif($order->status == 'paid')
                <div class="success-alert">
                    <strong>✔ Pembayaran Dikonfirmasi:</strong> Pesanan sudah dibayar. Klik "Selesaikan Pesanan" setelah makanan diserahkan ke pelanggan.
                </div>
                <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-action btn-complete">
                        ✅ Selesaikan Pesanan
                    </button>
                </form>
            @elseif($order->status == 'done')
                <div class="success-alert">
                    <strong>✅ Pesanan Selesai:</strong> Makanan telah diserahkan ke pelanggan.
                </div>
            @endif

            <a href="{{ route('store.orders') }}" class="btn-action btn-back">
                ← Kembali ke Daftar Pesanan
            </a>
        </div>

    </div>
@endsection

