@extends('layouts.app')

@section('content')
    <h2>Edit Produk</h2>

    <form action="/foods/{{ $food->id }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Toko</label>
            <input type="text" name="store_name" class="form-control" value="{{ $food->store_name }}">
        </div>

        <div class="mb-3">
            <label>Nama Makanan</label>
            <input type="text" name="food_name" class="form-control" value="{{ $food->food_name }}">
        </div>

        <div class="mb-3">
            <label>Upload Foto</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga Asli</label>
            <input type="number" name="original_price" class="form-control" value="{{ $food->original_price }}">
        </div>

        <div class="mb-3">
            <label>Harga Rescue</label>
            <input type="number" name="rescue_price" class="form-control" value="{{ $food->rescue_price }}">
        </div>

        <div class="mb-3">
            <label>Porsi</label>
            <input type="number" name="portions" class="form-control" value="{{ $food->portions }}">
        </div>

        <button class="btn btn-success">
            Update Produk
        </button>

    </form>
@endsection
