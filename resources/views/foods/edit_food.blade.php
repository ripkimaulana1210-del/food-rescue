@extends('layouts.app')

@section('title', 'Edit Produk - FoodRescue')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<section class="form-container">
    <div class="form-heading">
        <span class="eyebrow">Kelola produk</span>
        <h1>Edit Produk</h1>
        <p>Perbarui informasi stok, harga, lokasi, dan batas pengambilan.</p>
    </div>

    <form action="{{ route('foods.update', $food->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="input-group">
                <label for="store_name">Nama Toko</label>
                <input type="text" id="store_name" name="store_name" value="{{ $food->store_name }}" required>
            </div>

            <div class="input-group">
                <label for="food_name">Nama Makanan</label>
                <input type="text" id="food_name" name="food_name" value="{{ $food->food_name }}" required>
            </div>

            <div class="input-group full">
                <label for="image">Upload Foto</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <div class="input-group">
                <label for="original_price">Harga Asli</label>
                <input type="number" id="original_price" name="original_price" value="{{ $food->original_price }}" min="0" required>
            </div>

            <div class="input-group">
                <label for="rescue_price">Harga Rescue</label>
                <input type="number" id="rescue_price" name="rescue_price" value="{{ $food->rescue_price }}" min="0" required>
            </div>

            <div class="input-group">
                <label for="portions">Porsi</label>
                <input type="number" id="portions" name="portions" value="{{ $food->portions }}" min="0" required>
            </div>

            <div class="input-group">
                <label for="location">Lokasi</label>
                <input type="text" id="location" name="location" value="{{ $food->location }}" required>
            </div>

            <div class="input-group">
                <label for="latitude">Latitude</label>
                <input type="text" id="latitude" name="latitude" value="{{ $food->latitude }}">
            </div>

            <div class="input-group">
                <label for="longitude">Longitude</label>
                <input type="text" id="longitude" name="longitude" value="{{ $food->longitude }}">
            </div>

            <div class="input-group full">
                <label for="expired_at">Batas Ambil</label>
                <input type="datetime-local" id="expired_at" name="expired_at"
                    value="{{ $food->expired_at ? date('Y-m-d\TH:i', strtotime($food->expired_at)) : '' }}" required>
            </div>
        </div>

        <button class="btn btn-primary btn-full">
            Update Produk
        </button>
    </form>
</section>
@endsection
