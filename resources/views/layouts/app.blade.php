<!DOCTYPE html>
<html lang="id">

<head>
    @php
        $siteLogoFiles = glob(public_path('images/foodrescue-logo.{png,jpg,jpeg,webp,svg}'), GLOB_BRACE) ?: [];
        $siteLogoPath = $siteLogoFiles ? 'images/' . basename($siteLogoFiles[0]) : null;
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodRescue')</title>
    @yield('meta')
    @if ($siteLogoPath)
        <link rel="icon" href="{{ asset($siteLogoPath) }}">
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    @yield('css')
</head>

<body>
    <div class="scroll-progress" id="scrollProgress"></div>
    <div class="toast-container" id="toastContainer"></div>

    <nav id="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo" aria-label="FoodRescue">
                @if ($siteLogoPath)
                    <img src="{{ asset($siteLogoPath) }}" alt="" class="site-logo">
                @else
                    <span class="logo-mark">FR</span>
                @endif
                <span class="logo-text">Food<span>Rescue</span></span>
            </a>

            <div class="nav-right">
                <ul class="nav-menu" id="navMenu">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="{{ route('foods.index') }}" class="{{ request()->routeIs('foods.index') ? 'active' : '' }}">Marketplace</a></li>

                    @auth
                        @if (auth()->user()->role == 'user')
                            <li><a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.index') ? 'active' : '' }}">Pesanan Saya</a></li>
                        @endif

                        @if (auth()->user()->role == 'store')
                            <li><a href="{{ route('foods.my') }}" class="{{ request()->routeIs('foods.my') ? 'active' : '' }}">Produk Saya</a></li>
                            <li><a href="{{ route('store.orders') }}" class="{{ request()->routeIs('store.orders') ? 'active' : '' }}">Pesanan</a></li>
                        @endif
                    @endauth
                </ul>

                <div class="nav-auth">
                    @auth
                        <div class="nav-user">
                            <span class="nav-user-name">{{ auth()->user()->name }}</span>
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="nav-avatar">
                            @else
                                <div class="nav-avatar nav-avatar-fallback">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-ghost btn-sm">Logout</button>
                            </form>
                        </div>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a>
                    @endguest
                </div>

                <button type="button" class="menu-toggle" id="menuToggle" aria-label="Buka menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <main class="main-content">
        @yield('content')
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="logo">
                    @if ($siteLogoPath)
                        <img src="{{ asset($siteLogoPath) }}" alt="" class="site-logo">
                    @else
                        <span class="logo-mark">FR</span>
                    @endif
                    <span class="logo-text">Food<span>Rescue</span></span>
                </a>
                <p>Selamatkan makanan, kurangi limbah, dan nikmati hidangan layak konsumsi dengan harga lebih ramah.</p>
                <div class="footer-social">
                    <a href="#" title="Instagram">IG</a>
                    <a href="#" title="Twitter">X</a>
                    <a href="#" title="Facebook">FB</a>
                    <a href="#" title="TikTok">TT</a>
                </div>
            </div>

            <div class="footer-links">
                <h4>Menu</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('foods.index') }}">Marketplace</a></li>
                    <li><a href="{{ route('foods.create') }}">Jual Makanan</a></li>
                    <li><a href="{{ route('orders.scan') }}">Scan Pesanan</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="{{ route('foods.index') }}">Cari Makanan</a></li>
                    <li><a href="{{ route('register') }}">Daftar Mitra</a></li>
                    <li><a href="{{ route('login') }}">Masuk Akun</a></li>
                    <li><a href="{{ route('password.request') }}">Reset Password</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Kontak</h4>
                <ul>
                    <li>hello@foodrescue.com</li>
                    <li>+62 812-3456-7890</li>
                    <li>Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} FoodRescue. Dibuat untuk mengurangi food waste.</p>
        </div>
    </footer>

    <button class="back-to-top" id="backToTop" title="Kembali ke atas">^</button>

    <script src="{{ asset('js/global.js') }}"></script>
    @yield('js')
</body>

</html>
