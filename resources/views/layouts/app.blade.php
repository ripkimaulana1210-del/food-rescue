<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Food Rescue')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    @yield('css')
</head>

<body>

    <!-- NAVBAR -->
    <nav>
        <div class="nav-container">

            <!-- LOGO -->
            <a href="/" class="logo">🍔 Food<span>Rescue.</span></a>

            <!-- RIGHT SIDE -->
            <div class="nav-right">

                <!-- MENU UTAMA -->
                <ul class="nav-menu">

                    <!-- PUBLIC -->
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('foods.index') }}">Marketplace</a></li>
                    @auth

                        {{-- USER --}}
                        @if (auth()->user()->role == 'user')
                            <li><a href="{{ route('orders.index') }}">Pesanan Saya</a></li>
                        @endif

                        {{-- STORE --}}
                        @if (auth()->user()->role == 'store')
                            <li><a href="{{ route('foods.my') }}">Produk Saya</a></li>
                            <li><a href="{{ route('store.orders') }}">Pesanan</a></li>
                        @endif

                    @endauth

                </ul>
                <!-- AUTH DIPISAH -->
                <div class="nav-auth">

                    @auth
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="btn btn-primary">
                                Logout
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a href="/login" class="btn btn-outline">Masuk</a>
                        <a href="/register" class="btn btn-primary">Daftar</a>
                    @endguest

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
        <p>&copy; {{ date('Y') }} Food Rescue</p>
    </footer>

    @yield('js')

</body>

</html>
