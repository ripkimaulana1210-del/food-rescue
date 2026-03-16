@extends('layouts.app')

@section('content')
    <h3>Login</h3>

    <form method="POST" action="/login">

        @csrf

        <input type="email" name="email" class="form-control mb-2" placeholder="Email">

        <input type="password" name="password" class="form-control mb-2" placeholder="Password">

        <button class="btn btn-success">Login</button>

    </form>

    <p class="mt-2">
        Belum punya akun? <a href="/register">Register</a>
    </p>
@endsection
