@extends('layouts.app')

@section('content')
    <h2>Checkout</h2>

    <div class="card p-4">

        <h4>{{ $food->food_name }}</h4>

        <p>🏪 {{ $food->store_name }}</p>

        <p>Jumlah porsi: {{ $qty }}</p>

        <h3 class="text-success">
            Rp {{ number_format($food->rescue_price * $qty) }}
        </h3>

        <hr>

        <h5>Pilih Metode Pembayaran</h5>

        <form action="/foods/pay/{{ $food->id }}" method="POST">

            @csrf

            <input type="hidden" name="qty" value="{{ $qty }}">

            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" value="qris" required>
                <label class="form-check-label">
                    QRIS
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" value="transfer">
                <label class="form-check-label">
                    Transfer Bank
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" value="cash">
                <label class="form-check-label">
                    Cash on Pickup
                </label>
            </div>

            <br>

            <button class="btn btn-success">
                Bayar Sekarang
            </button>

        </form>

    </div>
@endsection
