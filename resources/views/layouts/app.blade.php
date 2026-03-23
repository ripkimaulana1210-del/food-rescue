<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Food Rescue')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

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
                <li>
                    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
                        Beranda
                    </a>
                </li>

                <li>
                    <a href="/foods" class="{{ request()->is('foods') ? 'active' : '' }}">
                        Marketplace
                    </a>
                </li>

                @auth
                    @if(auth()->user()->role == 'store')
                        <li><a href="/my-foods">Produk Saya</a></li>
                    @endif

                    <li><a href="/dashboard">Dashboard</a></li>
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
@yield('content')

<!-- FOOTER -->
<footer>
    <p>&copy; {{ date('Y') }} Food Rescue</p>
</footer>

@yield('js')

</body>
</html>