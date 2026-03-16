@extends('layouts.app')

@section('content')
    <h3>Register</h3>

    <form method="POST" action="/register">

        @csrf

        <input type="text" name="name" class="form-control mb-2" placeholder="Nama">

        <input type="email" name="email" class="form-control mb-2" placeholder="Email">

        <input type="password" name="password" class="form-control mb-2" placeholder="Password">

        <select name="role" class="form-control mb-2">

            <option value="user">User</option>
            <option value="store">Store</option>

        </select>

        <button class="btn btn-success">Register</button>

    </form>
@endsection
