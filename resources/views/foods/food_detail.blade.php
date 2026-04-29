@extends('layouts.app')

@section('title', $food->food_name . ' - Food Rescue')

@section('css')
<link rel="stylesheet" href="{{ secure_asset('css/detail.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endsection

@section('content')

<section class="detail-container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <span>/</span>
        <a href="{{ route('foods.index') }}">Marketplace</a>
        <span>/</span>
        <span>{{ $food->food_name }}</span>
    </nav>

    @php
        $discount = $food->original_price > 0
            ? round((($food->original_price - $food->rescue_price) / $food->original_price) * 100)
            : 0;
    @endphp

    <article class="detail-card">
        <div class="detail-image">
            @if ($food->image)
                <img src="{{ secure_asset('storage/' . $food->image) }}" alt="{{ $food->food_name }}">
            @else
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=900&auto=format&fit=crop" alt="{{ $food->food_name }}">
            @endif

            @if ($discount > 0)
                <span class="discount-badge">Hemat {{ $discount }}%</span>
            @endif

            @if ($food->status == 'sold_out')
                <span class="badge sold">Habis</span>
            @endif
        </div>

        <div class="detail-info">
            <p class="store">{{ $food->store_name }}</p>
            <h1>{{ $food->food_name }}</h1>
            <p class="portion">{{ $food->portions }} porsi tersisa</p>

            <div class="price">
                <span class="original">Rp {{ number_format($food->original_price) }}</span>
                <span class="rescue">Rp {{ number_format($food->rescue_price) }}</span>
                @if ($discount > 0)
                    <span class="discount">Hemat {{ $discount }}%</span>
                @endif
            </div>

            <div class="detail-meta">
                <div>
                    <span>Lokasi</span>
                    <strong>{{ $food->location }}</strong>
                </div>
                <div>
                    <span>Batas ambil</span>
                    <strong>{{ \Carbon\Carbon::parse($food->expired_at)->format('d M Y H:i') }}</strong>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('foods.index') }}" class="btn btn-outline">Kembali</a>

                @if ($food->portions > 0)
                    <form action="{{ route('foods.checkout', $food->id) }}" method="POST" class="checkout-inline">
                        @csrf
                        <input type="number" name="qty" min="1" max="{{ $food->portions }}" value="1" class="qty-input" aria-label="Jumlah porsi">
                        <button class="btn btn-primary">Checkout</button>
                    </form>
                @else
                    <button class="btn btn-danger" disabled>Habis</button>
                @endif
            </div>
        </div>
    </article>

    <section class="map-section">
        <div>
            <span class="eyebrow">Lokasi</span>
            <h2>Lokasi Pengambilan</h2>
        </div>
        <div id="map"></div>
    </section>
</section>
@endsection

@section('js')
<script>
    const food = @json($food);
</script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ secure_asset('js/map.js') }}"></script>
<script src="{{ secure_asset('js/detail.js') }}"></script>
@endsection
