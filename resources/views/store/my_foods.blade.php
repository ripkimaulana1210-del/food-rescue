@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">

        <h2>Produk Saya</h2>

        <a href="/sell" class="btn btn-success">
            + Jual Makanan
        </a>

    </div>

    <div class="row">

        @forelse($foods as $food)
            <div class="col-md-4 mb-4">

                <div class="card h-100 shadow-sm">

                    {{-- FOTO MAKANAN --}}
                    <img src="{{ asset('storage/' . $food->image) }}" class="card-img-top"
                        style="height:200px;object-fit:cover;">

                    <div class="card-body">

                        {{-- NAMA MAKANAN --}}
                        <h5 class="card-title">{{ $food->food_name }}</h5>

                        {{-- NAMA TOKO --}}
                        <p class="text-muted mb-1">
                            🏪 {{ $food->store_name }}
                        </p>

                        {{-- HARGA --}}
                        <p class="mb-1">
                            <del class="text-muted">
                                Rp {{ number_format($food->original_price) }}
                            </del>
                        </p>

                        <h5 class="text-success">
                            Rp {{ number_format($food->rescue_price) }}
                        </h5>

                        {{-- PORSI --}}
                        <p>
                            🍽 Porsi tersisa:
                            <b>{{ $food->portions }}</b>
                        </p>

                        {{-- LOKASI --}}
                        <p class="text-muted">
                            📍 {{ $food->location }}
                        </p>

                        {{-- EXPIRED --}}
                        <p class="text-danger">
                            ⏰ Expired: {{ $food->expired_at }}
                        </p>

                    </div>

                    {{-- AKSI --}}
                    <div class="card-footer d-flex justify-content-between">

                        <a href="/foods/{{ $food->id }}" class="btn btn-sm btn-primary">
                            Detail
                        </a>

                        <a href="/foods/{{ $food->id }}/edit" class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <form action="/foods/{{ $food->id }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>

                        </form>
                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">
                <div class="alert alert-info">
                    Kamu belum mengupload makanan.
                </div>
            </div>
        @endforelse

    </div>
@endsection
