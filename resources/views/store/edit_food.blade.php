@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')

<div class="form-container">
    <h2>Edit Produk 🍱</h2>

    <form action="/foods/{{ $food->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <!-- Nama Toko -->
            <div class="input-group">
                <label>Nama Toko</label>
                <input type="text" name="store_name" value="{{ $food->store_name }}">
            </div>

            <!-- Nama Makanan -->
            <div class="input-group">
                <label>Nama Makanan</label>
                <input type="text" name="food_name" value="{{ $food->food_name }}">
            </div>

            <!-- Upload -->
            <div class="input-group full">
                <label>Upload Foto</label>
                <input type="file" name="image">
            </div>

            <!-- Harga -->
            <div class="input-group">
                <label>Harga Asli</label>
                <input type="number" name="original_price" value="{{ $food->original_price }}">
            </div>

            <div class="input-group">
                <label>Harga Rescue</label>
                <input type="number" name="rescue_price" value="{{ $food->rescue_price }}">
            </div>

            <!-- Porsi -->
            <div class="input-group">
                <label>Porsi</label>
                <input type="number" name="portions" value="{{ $food->portions }}">
            </div>

            <!-- LOCATION (WAJIB) -->
            <div class="input-group">
                <label>Lokasi</label>
                <input type="text" name="location" value="{{ $food->location }}">
            </div>

            <!-- LAT LONG -->
            <div class="input-group">
                <label>Latitude</label>
                <input type="text" name="latitude" value="{{ $food->latitude }}">
            </div>

            <div class="input-group">
                <label>Longitude</label>
                <input type="text" name="longitude" value="{{ $food->longitude }}">
            </div>

            <!-- EXPIRED -->
            <div class="input-group full">
                <label>Expired At</label>
                <input type="datetime-local" name="expired_at"
                    value="{{ $food->expired_at ? date('Y-m-d\TH:i', strtotime($food->expired_at)) : '' }}">
            </div>

        </div>

        <button class="btn btn-primary btn-full">
            Update Produk 🚀
        </button>

    </form>
</div>

@endsection