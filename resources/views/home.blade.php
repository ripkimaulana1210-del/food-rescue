@extends('layouts.app')

@section('title', 'FoodRescue - Selamatkan Makanan Surplus')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')

<header class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-inner">
        <p class="hero-kicker">Marketplace makanan surplus</p>
        <h1>Makanan Surplus Terdekat</h1>
        <p>
            Temukan hidangan layak konsumsi dari toko dan restoran sekitar.
            Harga lebih ramah, makanan tidak terbuang, dan pesanan bisa langsung diambil.
        </p>

        <div class="hero-actions">
            <a href="{{ route('foods.index') }}" class="btn btn-primary btn-lg">Jelajahi Marketplace</a>
            @guest
                <a href="{{ route('register') }}" class="btn btn-light btn-lg">Daftar Akun</a>
            @else
                <a href="{{ route('foods.create') }}" class="btn btn-light btn-lg">Jual Makanan</a>
            @endguest
        </div>
    </div>
</header>

<section class="stats-strip" aria-label="Ringkasan FoodRescue">
    <div class="stat-item">
        <strong>10K+</strong>
        <span>Porsi diselamatkan</span>
    </div>
    <div class="stat-item">
        <strong>500+</strong>
        <span>Mitra aktif</span>
    </div>
    <div class="stat-item">
        <strong>70%</strong>
        <span>Potensi hemat</span>
    </div>
    <div class="stat-item">
        <strong>24 Jam</strong>
        <span>Update stok</span>
    </div>
</section>

<section class="highlight">
    <div class="highlight-container">
        <div class="highlight-text">
            <span class="eyebrow">Pilihan hari ini</span>
            <h2>Pesan makanan yang masih segar sebelum stok habis.</h2>
            <p>
                Setiap listing menampilkan harga asli, harga rescue, sisa porsi,
                dan lokasi pengambilan agar keputusanmu cepat dan jelas.
            </p>
            <a href="{{ route('foods.index') }}" class="btn btn-primary">Lihat Marketplace</a>
        </div>

        <div class="highlight-image">
            <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=900&auto=format&fit=crop" alt="Makanan siap saji">
        </div>
    </div>
</section>

<section id="how-it-works" class="features">
    <div class="section-title">
        <span class="eyebrow">Cara kerja</span>
        <h2>Tiga langkah sederhana</h2>
        <p>Pilih makanan, selesaikan pesanan, lalu ambil di toko sesuai lokasi.</p>
    </div>

    <div class="steps-grid">
        <article class="step-card">
            <span class="step-number">01</span>
            <h3>Temukan Makanan</h3>
            <p>Cari makanan surplus dari mitra terdekat dan bandingkan harga rescue.</p>
        </article>

        <article class="step-card">
            <span class="step-number">02</span>
            <h3>Pesan dan Bayar</h3>
            <p>Konfirmasi jumlah porsi, pilih metode pembayaran, lalu simpan kode pesanan.</p>
        </article>

        <article class="step-card">
            <span class="step-number">03</span>
            <h3>Ambil Pesanan</h3>
            <p>Tunjukkan kode atau QR saat datang ke toko untuk menyelesaikan pengambilan.</p>
        </article>
    </div>
</section>

<section class="about">
    <div class="about-container">
        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=900&auto=format&fit=crop" alt="Bahan makanan segar">
        </div>

        <div class="about-text">
            <span class="eyebrow">Dampak nyata</span>
            <h2>Lebih hemat untuk pembeli, lebih minim limbah untuk toko.</h2>
            <p>
                FoodRescue membantu toko menjual stok layak konsumsi menjelang batas waktu,
                sementara pembeli mendapatkan pilihan makanan berkualitas dengan harga lebih terjangkau.
            </p>

            <div class="about-points">
                <div class="point">
                    <strong>Harga transparan</strong>
                    <span>Lihat harga asli dan harga rescue sebelum checkout.</span>
                </div>
                <div class="point">
                    <strong>Lokasi jelas</strong>
                    <span>Setiap produk dilengkapi lokasi dan peta pengambilan.</span>
                </div>
                <div class="point">
                    <strong>Alur cepat</strong>
                    <span>Pesanan, kode, dan status dibuat ringkas untuk transaksi harian.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta">
    <div class="cta-box">
        <span class="eyebrow">Mulai sekarang</span>
        <h2>Selamatkan makanan pertama hari ini.</h2>
        <p>Buka marketplace dan pilih stok makanan surplus yang tersedia di sekitarmu.</p>
        <a href="{{ route('foods.index') }}" class="btn btn-light">Mulai Jelajah</a>
    </div>
</section>

@endsection
