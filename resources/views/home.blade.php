@extends('layouts.app')

@section('title', 'Food Rescue - Selamatkan Makanan, Kurangi Limbah')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')

<!-- HERO -->
<header class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <span class="badge-hero">🌍 #ZeroFoodWaste</span>

            <h1>Makanan Enak, <span>Harga Ramah</span>, Bumi Selamat</h1>

            <p>
                Ribuan porsi makanan layak konsumsi terbuang setiap harinya.
                Jadilah pahlawan dengan menyelamatkan makanan dari restoran favoritmu.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('foods.index') }}" class="btn btn-primary btn-lg">Jelajahi Makanan</a>
                <a href="#how-it-works" class="btn btn-outline btn-lg">Cara Kerja</a>
            </div>
        </div>

        <div class="hero-image">
            <img src="https://cdn-icons-png.flaticon.com/512/3075/3075977.png" alt="Food Rescue">
        </div>
    </div>
</header>

<div class="page-container">

    <!-- STATS BAR -->
    <section class="stats-bar fade-in">
        <div class="stat-item">
            <h3>10K+</h3>
            <p>Makanan Terselamatkan</p>
        </div>
        <div class="stat-item">
            <h3>500+</h3>
            <p>Mitra Restoran</p>
        </div>
        <div class="stat-item">
            <h3>50K+</h3>
            <p>Pengguna Aktif</p>
        </div>
        <div class="stat-item">
            <h3>70%</h3>
            <p>Hemat Biaya</p>
        </div>
    </section>

    <!-- HIGHLIGHT -->
    <section class="highlight">
        <div class="highlight-container">
            <div class="highlight-text">
                <h2>🔥 Makanan Hari Ini</h2>
                <p>Temukan makanan terbaik yang bisa kamu selamatkan sekarang. Diskon hingga 70% dari harga asli!</p>
                <a href="{{ route('foods.index') }}" class="btn btn-primary">Lihat Marketplace</a>
            </div>

            <div class="highlight-image">
                <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=800" alt="Delicious Food">
            </div>
        </div>
    </section>

</div>

<!-- FEATURES -->
<section id="how-it-works" class="features">
    <div class="section-title">
        <h2>Bagaimana Cara Kerjanya?</h2>
        <p>Tiga langkah mudah untuk mengurangi limbah makanan dan menghemat uang.</p>
    </div>

    <div class="steps-grid">
        <div class="step-card">
            <span class="step-number">01</span>
            <div class="step-icon">📱</div>
            <h3>Temukan Makanan</h3>
            <p>Cari makanan surplus dari mitra terdekat dengan harga terjangkau.</p>
        </div>

        <div class="step-card">
            <span class="step-number">02</span>
            <div class="step-icon">💳</div>
            <h3>Pesan & Bayar</h3>
            <p>Beli dengan harga lebih murah dan bayar secara aman.</p>
        </div>

        <div class="step-card">
            <span class="step-number">03</span>
            <div class="step-icon">🛍️</div>
            <h3>Ambil Pesanan</h3>
            <p>Ambil makananmu di lokasi dan nikmati hidangan lezat!</p>
        </div>
    </div>
</section>

<div class="page-container">

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
                        <span style="font-size: 2rem;">💸</span>
                        <div>
                            <h4>Hemat Hingga 70%</h4>
                            <p>Dapatkan makanan berkualitas dengan harga terjangkau</p>
                        </div>
                    </div>
                    <div class="point">
                        <span style="font-size: 2rem;">🌱</span>
                        <div>
                            <h4>Peduli Lingkungan</h4>
                            <p>Kurangi jejak karbon dan limbah makanan</p>
                        </div>
                    </div>
                    <div class="point">
                        <span style="font-size: 2rem;">⚡</span>
                        <div>
                            <h4>Praktis & Cepat</h4>
                            <p>Pesan dalam hitungan menit, ambil sesuai jadwal</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-image">
                <img src="https://cdn-icons-png.flaticon.com/512/3075/3075977.png" alt="About Food Rescue">
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="cta-box">
            <h2>Siap Jadi Pahlawan Makanan? 🍔</h2>
            <p>Mulai selamatkan makanan & bantu bumi sekarang juga</p>
            <a href="{{ route('foods.index') }}" class="btn">Mulai Sekarang</a>
        </div>
    </section>

</div>

@endsection

