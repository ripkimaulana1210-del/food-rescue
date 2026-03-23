@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    @yield('css')

<!-- HERO -->
<header class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <span class="badge-hero">#ZeroFoodWaste 🌍</span>

            <h1>Makanan Enak, Harga Ramah, Bumi Selamat.</h1>

            <p>
                Ribuan porsi makanan layak konsumsi terbuang setiap harinya.
                Jadilah pahlawan dengan menyelamatkan makanan dari restoran favoritmu.
            </p>

            <div class="hero-buttons">
                <a href="/foods" class="btn btn-primary">Mulai</a>
                <a href="#how-it-works" class="btn btn-outline">Pelajari</a>
            </div>
        </div>

        <div class="hero-image">
            <img src="https://cdn-icons-png.flaticon.com/512/3075/3075977.png" class="floating-img">
        </div>
    </div>
</header>

<!-- HIGHLIGHT -->
<section class="highlight">
    <div class="highlight-container">

        <div class="highlight-text">
            <h2>🔥 Makanan Hari Ini</h2>
            <p>Temukan makanan terbaik yang bisa kamu selamatkan sekarang</p>
            <a href="/foods" class="btn btn-primary">Lihat Marketplace</a>
        </div>

        <div class="highlight-image">
            <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=800">
        </div>

    </div>
</section>

<!-- FEATURES -->
<section id="how-it-works" class="features">
    <div class="section-title">
        <h2>Bagaimana Cara Kerjanya?</h2>
        <p>Tiga langkah mudah untuk mengurangi limbah makanan.</p>
    </div>

    <div class="steps-grid">
        <div class="step-card">
            <div class="step-icon" style="background: var(--yellow);">📱</div>
            <h3>Temukan Makanan</h3>
            <p>Cari makanan surplus dari mitra terdekat.</p>
        </div>

        <div class="step-card">
            <div class="step-icon" style="background: var(--orange);">💳</div>
            <h3>Pesan & Bayar</h3>
            <p>Beli dengan harga lebih murah.</p>
        </div>

        <div class="step-card">
            <div class="step-icon" style="background: var(--green); color:white;">🛍️</div>
            <h3>Ambil Pesanan</h3>
            <p>Ambil dan nikmati makananmu.</p>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="about">
    <div class="about-container">
        <div class="about-text">
            <h2>Kenapa Food Rescue? 🌍</h2>
            <p>
                Setiap hari, ribuan makanan terbuang padahal masih layak konsumsi.
                Kami hadir untuk menghubungkan restoran dengan kamu.
            </p>

            <div class="about-points">
                <div class="point">
                    <h4>💸 Hemat</h4>
                    <p>Diskon sampai 70%</p>
                </div>
                <div class="point">
                    <h4>🌱 Peduli Lingkungan</h4>
                    <p>Mengurangi limbah makanan</p>
                </div>
                <div class="point">
                    <h4>⚡ Praktis</h4>
                    <p>Order cepat & mudah</p>
                </div>
            </div>
        </div>

        <div class="about-image">
            <img src="https://cdn-icons-png.flaticon.com/512/3075/3075977.png">
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta">
    <div class="cta-box">
        <h2>Siap Jadi Pahlawan Makanan? 🍔</h2>
        <p>Mulai selamatkan makanan & bantu bumi sekarang</p>
        <a href="/foods" class="btn">Mulai Sekarang</a>
    </div>
</section>

@endsection