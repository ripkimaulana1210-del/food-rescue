@extends('layouts.app')

@section('title', 'Jual Makanan - Food Rescue')

@section('css')
<link rel="stylesheet" href="{{ secure_asset('css/form.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endsection

@section('content')

<section class="form-container">
    <div class="form-heading">
        <span class="eyebrow">Mitra toko</span>
        <h1>Jual Makanan Surplus</h1>
        <p>Unggah stok makanan layak konsumsi, tentukan harga rescue, lalu pilih lokasi pengambilan.</p>
    </div>

    <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">
            <div class="input-group">
                <label for="store_name">Nama Toko</label>
                <input type="text" id="store_name" name="store_name" placeholder="Contoh: Warung Bu Siti" required>
            </div>

            <div class="input-group">
                <label for="food_name">Nama Makanan</label>
                <input type="text" id="food_name" name="food_name" placeholder="Contoh: Nasi Goreng" required>
            </div>

            <div class="input-group">
                <label for="original_price">Harga Asli</label>
                <input type="number" id="original_price" name="original_price" min="0" placeholder="25000" required>
            </div>

            <div class="input-group">
                <label for="rescue_price">Harga Rescue</label>
                <input type="number" id="rescue_price" name="rescue_price" min="0" placeholder="15000" required>
            </div>

            <div class="input-group">
                <label for="portions">Jumlah Porsi</label>
                <input type="number" id="portions" name="portions" min="1" placeholder="10" required>
            </div>

            <div class="input-group">
                <label for="expired_at">Batas Ambil</label>
                <input type="datetime-local" id="expired_at" name="expired_at" required>
            </div>

            <div class="input-group full">
                <label for="image">Foto Makanan</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <div class="input-group full">
                <label for="location">Lokasi Pengambilan</label>
                <input type="text" id="location" name="location" placeholder="Contoh: Jakarta Selatan" required>
            </div>

            <div class="input-group">
                <label for="lat">Latitude</label>
                <input type="text" id="lat" name="latitude" readonly>
            </div>

            <div class="input-group">
                <label for="lng">Longitude</label>
                <input type="text" id="lng" name="longitude" readonly>
            </div>
        </div>

        <div class="map-section">
            <div>
                <span class="eyebrow">Peta</span>
                <h2>Pilih titik lokasi</h2>
            </div>
            <div id="map"></div>
        </div>

        <button class="btn btn-primary btn-full">
            Upload Produk
        </button>
    </form>
</section>

@endsection

@section('js')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ secure_asset('js/map.js') }}"></script>
<script src="{{ secure_asset('js/sell.js') }}"></script>
@endsection
