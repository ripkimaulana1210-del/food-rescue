@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/detail.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endsection


@section('content')
    <h2>Detail Makanan</h2>

    <div class="card">


        <div class="card-body">

            <p><strong>Toko:</strong> {{ $food->store_name }}</p>

            <p><strong>Makanan:</strong> {{ $food->food_name }}</p>
            @if ($food->image)
                <img src="{{ asset('storage/' . $food->image) }}" class="img-fluid mb-3" style="border-radius:10px;">
            @endif

            <p><strong>Porsi:</strong> {{ $food->portions }}</p>

            <p><strong>Lokasi:</strong> {{ $food->location }}</p>

            <a href="/foods" class="btn btn-secondary">
                Kembali
            </a>

            @if ($food->portions > 0)
                <form action="/foods/checkout/{{ $food->id }}" method="POST">

                    @csrf

                    <input type="number" name="qty" min="1" max="{{ $food->portions }}" value="1"
                        class="form-control mb-3">

                    <button class="btn btn-success">
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

    <h3>Lokasi</h3>

    <div id="map"></div>
@endsection


@section('js')
    <script>
        const food = @json($food);
    </script>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="/js/map.js"></script>
    <script src="/js/detail.js"></script>
@endsection
