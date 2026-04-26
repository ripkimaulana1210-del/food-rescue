<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Food Rescue')</title>
    @yield('meta')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    @yield('css')
</head>

<body>

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- NAVBAR -->
    <nav id="navbar">
        <div class="nav-container">

            <!-- LOGO -->
            <a href="/" class="logo">
                🍔 Food<span>Rescue.</span>
            </a>

            <!-- RIGHT SIDE -->
            <div class="nav-right">

                <!-- MENU UTAMA -->
                <ul class="nav-menu" id="navMenu">

                    <!-- PUBLIC -->
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="{{ route('foods.index') }}" class="{{ request()->routeIs('foods.index') ? 'active' : '' }}">Marketplace</a></li>
                    @auth

                        {{-- USER --}}
                        @if (auth()->user()->role == 'user')
                            <li><a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.index') ? 'active' : '' }}">Pesanan Saya</a></li>
                        @endif

                        {{-- STORE --}}
                        @if (auth()->user()->role == 'store')
                            <li><a href="{{ route('foods.my') }}" class="{{ request()->routeIs('foods.my') ? 'active' : '' }}">Produk Saya</a></li>
                            <li><a href="{{ route('store.orders') }}" class="{{ request()->routeIs('store.orders') ? 'active' : '' }}">Pesanan</a></li>
                        @endif

                    @endauth

                </ul>

                <!-- AUTH -->
                <div class="nav-auth">

                    @auth
                        <div class="nav-user">
                            <span style="font-size: 0.85rem; font-weight: 600; color: var(--gray-700);">{{ auth()->user()->name }}</span>
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="nav-avatar">
                            @else
                                <div class="nav-avatar" style="background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.9rem;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="btn btn-ghost btn-sm">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endauth

                    @guest
                        <a href="/login" class="btn btn-ghost btn-sm">Masuk</a>
                        <a href="/register" class="btn btn-primary btn-sm">Daftar</a>
                    @endguest

                </div>

                <!-- Mobile Toggle -->
                <div class="menu-toggle" id="menuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

            </div>

        </div>
    </nav>

    <!-- CONTENT -->
    <main class="main-content">
        @yield('content')
    </main>


    <!-- FOOTER -->
    <footer>
        <div class="footer-container">
            <div class="footer-brand">
                <a href="/" class="logo">🍔 Food<span>Rescue.</span></a>
                <p>Selamatkan makanan, kurangi limbah, dan nikmati hidangan lezat dengan harga terjangkau. Bersama kita bisa mengurangi food waste!</p>
                <div class="footer-social">
                    <a href="#" title="Instagram">📷</a>
                    <a href="#" title="Twitter">🐦</a>
                    <a href="#" title="Facebook">📘</a>
                    <a href="#" title="TikTok">🎵</a>
                </div>
            </div>
            <div class="footer-links">
                <h4>Menu</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('foods.index') }}">Marketplace</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="#">Jual Makanan</a></li>
                    <li><a href="#">Cara Kerja</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Kontak</h4>
                <ul>
                    <li>📧 hello@foodrescue.com</li>
                    <li>📱 +62 812-3456-7890</li>
                    <li>📍 Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Food Rescue. All rights reserved. Made with 💚 untuk bumi yang lebih baik.</p>
        </div>
    </footer>

    <!-- Back to Top -->
    <button class="back-to-top" id="backToTop" title="Kembali ke atas">↑</button>

    <!-- Global JS -->
    <script src="{{ asset('js/global.js') }}"></script>
    @yield('js')

</body>

</html>

