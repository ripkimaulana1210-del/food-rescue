<!DOCTYPE html>
<html>

<head>

    <title>Food Rescue</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/global.css">

    @yield('css')

</head>

<body>
    <nav class="navbar navbar-dark bg-success">

        <div class="container">

            <a class="navbar-brand" href="/">Food Rescue</a>

            <div>

                <a href="/" class="btn btn-light">Home</a>

                <a href="/foods" class="btn btn-light">Marketplace</a>

                @auth

                    @if (Auth::user()->role == 'store')
                        <a href="/my-foods" class="btn btn-light">Produk Saya</a>
                    @endif
                    <a href="/dashboard" class="btn btn-light">Dashboard</a>

                    <a href="/logout" class="btn btn-danger">Logout</a>

                @endauth


                @guest

                    <a href="/login" class="btn btn-light">Login</a>

                    <a href="/register" class="btn btn-warning">Register</a>

                @endguest

            </div>

        </div>

    </nav>

    <div class="container mt-5">

        @yield('content')

    </div>

    @yield('js')

</body>

</html>
