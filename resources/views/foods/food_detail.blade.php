@extends('layouts.app')

@section('title', $food->food_name . ' - Food Rescue')

@section('css')
    <link rel="stylesheet" href="/css/detail.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endsection

@section('content')

<div class="detail-container">

    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <span>/</span>
        <a href="{{ route('foods.index') }}">Marketplace</a>
        <span>/</span>
        <span>{{ $food->food_name }}</span>
    </nav>

    <div class="detail-card">

        <!-- IMAGE -->
        <div class="detail-image">
            @if ($food->image)
                <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->food_name }}">
            @else
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600" alt="Food">
            @endif

            @php
                $discount = $food->original_price > 0 
                    ? round((($food->original_price - $food->rescue_price) / $food->original_price) * 100) 
                    : 0;
            @endphp
            @if ($discount > 0)
                <span class="discount-badge">-{{ $discount }}%</span>
            @endif

            @if ($food->status == 'sold_out')
                <span class="badge sold">Sold Out</span>
            @endif
        </div>

        <!-- INFO -->
        <div class="detail-info">

            <p class="store">🏪 {{ $food->store_name }}</p>

            <h2>{{ $food->food_name }}</h2>

            <p class="portion">
                🍱 {{ $food->portions }} porsi tersisa
            </p>

            <!-- PRICE -->
            <div class="price">
                <span class="original">
                    Rp {{ number_format($food->original_price) }}
                </span>

                <span class="rescue">
                    Rp {{ number_format($food->rescue_price) }}
                </span>

                @if ($discount > 0)
                    <span class="discount">Hemat {{ $discount }}%</span>
                @endif
            </div>

            <p class="location">
                📍 {{ $food->location }}
            </p>

            <!-- ACTION -->
            <div class="actions">

                <a href="{{ route('foods.index') }}" class="btn btn-outline">
                    ← Kembali
                </a>

                @if ($food->portions > 0)
                    <form action="{{ route('foods.checkout', $food->id) }}" method="POST" style="display: flex; gap: 12px; align-items: center;">
                        @csrf

                        <input type="number" name="qty"
                            min="1"
                            max="{{ $food->portions }}"
                            value="1"
                            class="qty-input">

                        <button class="btn btn-primary">
                            Checkout
                        </button>
                    </form>
                @else
                    <button class="btn btn-danger" disabled>
                        Habis
                    </button>
                @endif

            </div>
        </div>
    </div>

    <!-- MAP -->
    <div class="map-section">
        <h3>📍 Lokasi Pengambilan</h3>
        <div id="map"></div>

    </div>

</div>
@endsection

@section('js')
<script>
    const food = @json($food);
</script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="/js/map.js"></script>
<script src="/js/detail.js"></script>
@endsection
