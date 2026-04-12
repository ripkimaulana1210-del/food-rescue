@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/detail.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endsection

@section('content')

<div class="detail-container">

    <div class="detail-card">

        <!-- IMAGE -->
        <div class="detail-image">
            @if ($food->image)
                <img src="{{ asset('storage/' . $food->image) }}">
            @endif

            @if ($food->status == 'sold_out')
                <span class="badge sold">Sold Out</span>
            @endif
        </div>

        <!-- INFO -->
        <div class="detail-info">

            <p class="store">🏪 {{ $food->store_name }}</p>

            <h2>{{ $food->food_name }}</h2>

            <p class="portion">🍱 {{ $food->portions }} porsi tersisa</p>

            <!-- PRICE -->
            <div class="price">
                <span class="original">
                    Rp {{ number_format($food->original_price) }}
                </span>

                <span class="rescue">
                    Rp {{ number_format($food->rescue_price) }}
                </span>
            </div>

            <p class="location">📍 {{ $food->location }}</p>

            <!-- ACTION -->
            <div class="actions">

                <a href="/foods" class="btn btn-outline">
                    ← Kembali
                </a>

                @if ($food->portions > 0)
                    <form action="/foods/checkout/{{ $food->id }}" method="POST">
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
    <h3 class="map-title">Lokasi</h3>
    <div id="map"></div>

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