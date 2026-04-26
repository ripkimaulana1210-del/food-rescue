@extends('layouts.app')

@section('title', 'Marketplace - Food Rescue')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<link rel="stylesheet" href="{{ asset('css/marketplace.css') }}">
@endsection

@section('content')

<!-- Header -->
<div class="marketplace-header">
    <h2>🛒 Marketplace Makanan Surplus</h2>
    <p>Temukan makanan lezat dengan harga terjangkau dari mitra terdekat</p>
</div>

<!-- Toolbar -->
<div class="marketplace-toolbar">
    <div class="search-box">
        <input type="text" id="searchFood" placeholder="Cari makanan..." onkeyup="filterFoods()">
    </div>
    <div class="filter-pills">
        <button class="filter-pill active" onclick="filterByCategory('all')">Semua</button>
        <button class="filter-pill" onclick="filterByCategory('makanan')">Makanan</button>
        <button class="filter-pill" onclick="filterByCategory('minuman')">Minuman</button>
        <button class="filter-pill" onclick="filterByCategory('snack')">Snack</button>
    </div>
</div>

<!-- Product Grid -->
<div class="product-grid" id="productGrid">
    @forelse ($foods as $food)
    <div class="product-card" data-name="{{ strtolower($food->food_name) }}" data-category="makanan">

        <div class="card-img-box">
            <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->food_name }}">

            <span class="tag tag-red">
                -{{ round((($food->original_price - $food->rescue_price) / $food->original_price) * 100) }}%
            </span>

            @if ($food->status == 'sold_out')
            <span class="tag tag-sold">Sold Out</span>
            @endif
        </div>

        <div class="card-info">
            <p class="store-name">🏪 {{ $food->store_name }}</p>
            <h3>{{ $food->food_name }}</h3>
            <p class="portions">🍱 {{ $food->portions }} porsi tersisa</p>

            <div class="price-wrap">
                <span class="old-price">Rp {{ number_format($food->original_price) }}</span>
                <span class="new-price">Rp {{ number_format($food->rescue_price) }}</span>
            </div>

            <p class="countdown" data-expired="{{ \Carbon\Carbon::parse($food->expired_at)->format('Y-m-d H:i:s') }}">
                ⏳ Memuat...
            </p>

            <a href="/foods/{{ $food->id }}" class="btn-full">Lihat Detail</a>
        </div>

    </div>
    @empty
    <div class="empty-marketplace">
        <div style="font-size: 4rem; margin-bottom: var(--space-4);">😢</div>
        <h3>Belum ada makanan tersedia</h3>
        <p>Coba kembali nanti atau jelajahi kategori lain</p>
    </div>
    @endforelse
</div>

<!-- Map -->
<div id="map"></div>

@endsection

@section('js')
<script>
    const foods = @json($foods);
</script>
<script src="{{ asset('js/map.js') }}"></script>
<script src="{{ asset('js/marketplace.js') }}"></script>
<script>
// Search filter
function filterFoods() {
    const query = document.getElementById('searchFood').value.toLowerCase();
    const cards = document.querySelectorAll('.product-card');
    
    cards.forEach(card => {
        const name = card.getAttribute('data-name');
        if (name.includes(query)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

// Category filter
function filterByCategory(category) {
    const cards = document.querySelectorAll('.product-card');
    const pills = document.querySelectorAll('.filter-pill');
    
    pills.forEach(pill => pill.classList.remove('active'));
    event.target.classList.add('active');
    
    cards.forEach(card => {
        if (category === 'all' || card.getAttribute('data-category') === category) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
@endsection

