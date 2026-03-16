@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/marketplace.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endsection

@section('content')
    <h2 class="mb-4">Marketplace Makanan Surplus</h2>

    <div class="row">

        @foreach ($foods as $food)
            <div class="col-md-4 mb-4">

                <div class="card food-card">

                    <div class="position-relative">

                        @if ($food->image)
                            <img src="{{ asset('storage/' . $food->image) }}">
                        @endif

                        <span class="discount-badge">

                            -{{ round((($food->original_price - $food->rescue_price) / $food->original_price) * 100) }}%

                        </span>

                    </div>

                    <div class="card-body">

                        <h5>{{ $food->food_name }}</h5>

                        <p class="store">🏪 {{ $food->store_name }}</p>
                        <p>🍱 {{ $food->portions }} porsi tersisa</p>

                        <p class="price">

                            <span class="original">
                                Rp {{ number_format($food->original_price) }}
                            </span>

                            <span class="rescue">
                                Rp {{ number_format($food->rescue_price) }}
                            </span>

                        </p>

                        <p class="countdown" data-expired="{{ $food->expired_at }}">
                            Loading...
                        </p>

                        @if ($food->status == 'sold_out')
                            <span class="badge bg-danger">
                                Sold Out
                            </span>
                        @endif

                        <a href="/foods/{{ $food->id }}" class="btn btn-success w-100">
                            Lihat Detail
                        </a>

                    </div>

                </div>

            </div>
        @endforeach

    </div>


    <h3>Lokasi Produk</h3>

    <div id="map"></div>
@endsection


@section('js')
    <script>
        const foods = @json($foods);
    </script>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script src="/js/map.js"></script>

    <script src="/js/marketplace.js"></script>
@endsection
