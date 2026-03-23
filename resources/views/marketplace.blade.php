@extends('layouts.app')

@section('title', 'Marketplace')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endsection

@section('content')

<h2 class="marketplace-title">Marketplace Makanan Surplus</h2>

<div class="marketplace-page">

<div class="product-grid">

@foreach ($foods as $food)
<div class="product-card">

    <div class="card-img-box">

        <img src="{{ asset('storage/' . $food->image) }}">

        <span class="tag tag-red">
            -{{ round((($food->original_price - $food->rescue_price) / $food->original_price) * 100) }}%
        </span>

        @if ($food->status == 'sold_out')
        <span class="tag tag-green">Sold Out</span>
        @endif

    </div>

    <div class="card-info">

        <p class="store-name">🏪 {{ $food->store_name }}</p>

        <h3>{{ $food->food_name }}</h3>

        <p>🍱 {{ $food->portions }} porsi tersisa</p>

        <div class="price-wrap">
            <span class="old-price">
                Rp {{ number_format($food->original_price) }}
            </span>

            <span class="new-price">
                Rp {{ number_format($food->rescue_price) }}
            </span>
        </div>

        <p class="countdown">Loading...</p>

        <a href="/foods/{{ $food->id }}" class="btn btn-primary btn-full">
            Lihat Detail
        </a>

    </div>

</div>
@endforeach

</div>

</div>

<h3 style="text-align:center; margin-top:2rem;">Lokasi Produk</h3>

<div id="map"></div>

@endsection


@section('js')
<script>
    const foods = @json($foods);
</script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ asset('js/map.js') }}"></script>
<script src="{{ asset('js/marketplace.js') }}"></script>
@endsection