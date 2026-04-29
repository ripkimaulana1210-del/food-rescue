@extends('layouts.app')

@section('title', 'Marketplace - Food Rescue')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<link rel="stylesheet" href="{{ secure_asset('css/marketplace.css') }}">
@endsection

@section('content')

<section class="marketplace-page">
    <header class="marketplace-header">
        <span class="eyebrow">Marketplace</span>
        <h1>Makanan surplus siap diselamatkan</h1>
        <p>Bandingkan stok, harga rescue, dan lokasi pengambilan dari mitra terdekat.</p>
    </header>

    <div class="marketplace-toolbar">
        <div class="search-box">
            <input type="text" id="searchFood" placeholder="Cari makanan atau toko..." onkeyup="filterFoods()">
        </div>

        <div class="filter-pills" role="group" aria-label="Filter kategori">
            <button class="filter-pill active" type="button" onclick="filterByCategory('all', this)">Semua</button>
            <button class="filter-pill" type="button" onclick="filterByCategory('makanan', this)">Makanan</button>
            <button class="filter-pill" type="button" onclick="filterByCategory('minuman', this)">Minuman</button>
            <button class="filter-pill" type="button" onclick="filterByCategory('snack', this)">Snack</button>
        </div>
    </div>

    <div class="product-grid" id="productGrid">
        @forelse ($foods as $food)
            @php
                $discount = $food->original_price > 0
                    ? round((($food->original_price - $food->rescue_price) / $food->original_price) * 100)
                    : 0;
            @endphp

            <article class="product-card" data-name="{{ strtolower($food->food_name . ' ' . $food->store_name) }}" data-category="makanan">
                <div class="card-img-box">
                    @if ($food->image)
                        <img src="{{ secure_asset('storage/' . $food->image) }}" alt="{{ $food->food_name }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&auto=format&fit=crop" alt="{{ $food->food_name }}">
                    @endif

                    @if ($discount > 0)
                        <span class="tag tag-red">Hemat {{ $discount }}%</span>
                    @endif

                    @if ($food->status == 'sold_out')
                        <span class="tag tag-sold">Habis</span>
                    @endif
                </div>

                <div class="card-info">
                    <p class="store-name">{{ $food->store_name }}</p>
                    <h3>{{ $food->food_name }}</h3>
                    <p class="portions">{{ $food->portions }} porsi tersisa</p>

                    <div class="price-wrap">
                        <span class="old-price">Rp {{ number_format($food->original_price) }}</span>
                        <span class="new-price">Rp {{ number_format($food->rescue_price) }}</span>
                    </div>

                    <p class="countdown" data-expired="{{ \Carbon\Carbon::parse($food->expired_at)->format('Y-m-d H:i:s') }}">
                        Memuat batas waktu...
                    </p>

                    <a href="{{ route('foods.show', $food->id) }}" class="btn-full">Lihat Detail</a>
                </div>
            </article>
        @empty
            <div class="empty-marketplace">
                <span class="empty-code">0</span>
                <h3>Belum ada makanan tersedia</h3>
                <p>Database sudah siap. Produk baru dari mitra akan tampil di sini setelah diunggah.</p>
                @auth
                    @if (auth()->user()->role == 'store')
                        <a href="{{ route('foods.create') }}" class="btn btn-primary">Tambah Produk</a>
                    @endif
                @endauth
            </div>
        @endforelse
    </div>

    <section class="map-panel">
        <div class="map-heading">
            <span class="eyebrow">Peta</span>
            <h2>Lokasi mitra tersedia</h2>
        </div>
        <div id="map"></div>
    </section>
</section>

@endsection

@section('js')
<script>
    const foods = @json($foods);
</script>
<script src="{{ secure_asset('js/map.js') }}"></script>
<script src="{{ secure_asset('js/marketplace.js') }}"></script>
<script>
function filterFoods() {
    const query = document.getElementById('searchFood').value.toLowerCase();
    const cards = document.querySelectorAll('.product-card');

    cards.forEach(card => {
        const name = card.getAttribute('data-name');
        card.style.display = name.includes(query) ? '' : 'none';
    });
}

function filterByCategory(category, button) {
    const cards = document.querySelectorAll('.product-card');
    const pills = document.querySelectorAll('.filter-pill');

    pills.forEach(pill => pill.classList.remove('active'));
    button.classList.add('active');

    cards.forEach(card => {
        const isVisible = category === 'all' || card.getAttribute('data-category') === category;
        card.style.display = isVisible ? '' : 'none';
    });
}
</script>
@endsection
