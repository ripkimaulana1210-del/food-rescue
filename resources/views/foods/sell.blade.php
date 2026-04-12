@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endsection

@section('content')

<div class="form-container">

    <h2>Jual Makanan Surplus 🍱</h2>
    <p class="form-subtitle">Upload makananmu dan bantu kurangi food waste 🌍</p>

    <form action="/sell" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">

            <!-- TOKO -->
            <div class="input-group">
                <label>Nama Toko</label>
                <input type="text" name="store_name" placeholder="Contoh: Warung Bu Siti">
            </div>

            <!-- MAKANAN -->
            <div class="input-group">
                <label>Nama Makanan</label>
                <input type="text" name="food_name" placeholder="Contoh: Nasi Goreng">
            </div>

            <!-- HARGA -->
            <div class="input-group">
                <label>Harga Asli</label>
                <input type="number" name="original_price">
            </div>

            <div class="input-group">
                <label>Harga Rescue</label>
                <input type="number" name="rescue_price">
            </div>

            <!-- PORSI -->
            <div class="input-group">
                <label>Jumlah Porsi</label>
                <input type="number" name="portions">
            </div>

            <!-- EXPIRED -->
            <div class="input-group">
                <label>Kadaluarsa</label>
                <input type="datetime-local" name="expired_at">
            </div>

            <!-- FOTO -->
            <div class="input-group full">
                <label>Foto Makanan</label>
                <input type="file" name="image">
            </div>

            <!-- LOKASI -->
            <div class="input-group full">
                <label>Lokasi (Nama Tempat)</label>
                <input type="text" name="location" placeholder="Contoh: Jakarta Selatan">
            </div>

            <!-- LAT LONG -->
            <div class="input-group">
                <label>Latitude</label>
                <input type="text" id="lat" name="latitude" readonly>
            </div>

            <div class="input-group">
                <label>Longitude</label>
                <input type="text" id="lng" name="longitude" readonly>
            </div>

        </div>

        <!-- MAP -->
        <div class="map-section">
            <h4>📍 Pilih Lokasi di Map</h4>
            <div id="map"></div>
        </div>

        <button class="btn btn-primary btn-full">
            Upload Produk 🚀
        </button>

    </form>

</div>

@endsection


@section('js')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="/js/map.js"></script>
<script src="/js/sell.js"></script>
@endsection