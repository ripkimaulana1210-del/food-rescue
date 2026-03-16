@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/form.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endsection

@section('content')
    <h2>Jual Makanan Surplus</h2>

    <form action="/sell" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label>Nama Toko</label>
            <input type="text" name="store_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nama Makanan</label>
            <input type="text" name="food_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga Asli</label>
            <input type="number" name="original_price" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga Rescue</label>
            <input type="number" name="rescue_price" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jumlah Porsi</label>
            <input type="number" name="portions" class="form-control">
        </div>

        <div class="mb-3">
            <label>Foto Makanan</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kadaluarsa</label>
            <input type="datetime-local" name="expired_at" class="form-control">
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="location" class="form-control">
        </div>

        <div class="mb-3">
            <label>Latitude</label>
            <input type="text" id="lat" name="latitude" class="form-control">
        </div>

        <div class="mb-3">
            <label>Longitude</label>
            <input type="text" id="lng" name="longitude" class="form-control">
        </div>

        <h4>Pilih Lokasi di Map</h4>

        <div id="map"></div>



        <button class="btn btn-success mt-3">
            Upload Produk
        </button>



    </form>
@endsection


@section('js')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script src="/js/map.js"></script>

    <script src="/js/sell.js"></script>
@endsection
