@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my-foods.css') }}">
@endsection

@section('content')

<div class="myfoods-header">
    <h2>Produk Saya 🍱</h2>

    <a href="/sell" class="btn btn-primary">
        + Jual Makanan
    </a>
</div>

<div class="foods-grid">

    @forelse($foods as $food)
        <div class="food-card">

            <!-- IMAGE -->
            <div class="card-img-box">
                <img src="{{ asset('storage/' . $food->image) }}">
            </div>

            <!-- CONTENT -->
            <div class="card-info">

                <h3>{{ $food->food_name }}</h3>

                <p class="store">🏪 {{ $food->store_name }}</p>

                <p class="old-price">
                    Rp {{ number_format($food->original_price) }}
                </p>

                <p class="new-price">
                    Rp {{ number_format($food->rescue_price) }}
                </p>

                <p>🍽 {{ $food->portions }} porsi</p>

                <p class="location">📍 {{ $food->location }}</p>

                <p class="expired">
                    ⏰ {{ \Carbon\Carbon::parse($food->expired_at)->diffForHumans() }}
                </p>

            </div>

            <!-- ACTION -->
            <div class="card-actions">

                <a href="/foods/{{ $food->id }}" class="btn btn-outline">
                    Detail
                </a>

                <a href="/foods/{{ $food->id }}/edit" class="btn btn-warning">
                    Edit
                </a>

                <form action="/foods/{{ $food->id }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">
                        Hapus
                    </button>
                </form>

            </div>

        </div>

    @empty

        <div class="empty-state">
            <p>Kamu belum upload makanan 😢</p>
            <a href="/sell" class="btn btn-primary">Jual Sekarang</a>
        </div>

    @endforelse

</div>

@endsection