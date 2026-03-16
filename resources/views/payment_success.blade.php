@extends('layouts.app')

@section('content')
    <div class="text-center">

        <h2>Pembayaran Berhasil</h2>

        <p>Makanan berhasil dipesan.</p>

        <p>
            Metode pembayaran:
            <strong>{{ strtoupper($payment) }}</strong>
        </p>

        <p>
            Silakan ambil makanan di lokasi toko.
        </p>

        <a href="/foods" class="btn btn-success">
            Kembali ke Marketplace
        </a>

    </div>
@endsection
