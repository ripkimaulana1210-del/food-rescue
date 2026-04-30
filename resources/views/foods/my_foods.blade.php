@extends('layouts.app')

@section('title', 'Produk Saya - FoodRescue')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my-foods.css') }}">
@endsection

@section('content')

<section class="myfoods-page">
    <div class="myfoods-header">
        <div>
            <span class="eyebrow">Dashboard toko</span>
            <h1>Produk Saya</h1>
            <p>Kelola stok makanan surplus, harga rescue, dan status produk.</p>
        </div>

        <a href="{{ route('foods.create') }}" class="btn btn-primary">
            + Jual Makanan
        </a>
    </div>

    <div class="foods-grid">
        @forelse($foods as $food)
            <article class="food-card">
                <div class="card-img-box">
                    @if ($food->image)
                        <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->food_name }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&auto=format&fit=crop" alt="{{ $food->food_name }}">
                    @endif
                </div>

                <div class="card-info">
                    <p class="store">{{ $food->store_name }}</p>
                    <h3>{{ $food->food_name }}</h3>

                    <div class="price-row">
                        <span class="old-price">Rp {{ number_format($food->original_price) }}</span>
                        <span class="new-price">Rp {{ number_format($food->rescue_price) }}</span>
                    </div>

                    <p>{{ $food->portions }} porsi tersedia</p>
                    <p class="location">{{ $food->location }}</p>
                    <p class="expired">{{ \Carbon\Carbon::parse($food->expired_at)->diffForHumans() }}</p>
                </div>

                <div class="card-actions">
                    <a href="{{ route('foods.show', $food->id) }}" class="btn btn-outline">Detail</a>
                    <a href="{{ route('foods.edit', $food->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('foods.delete', $food->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <span class="empty-code">0</span>
                <h3>Belum ada produk</h3>
                <p>Upload produk pertama agar pembeli bisa menemukan stok makanan surplus tokomu.</p>
                <a href="{{ route('foods.create') }}" class="btn btn-primary">Jual Sekarang</a>
            </div>
        @endforelse
    </div>
</section>

@endsection
