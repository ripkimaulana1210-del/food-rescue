@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/home.css">
@endsection

@section('content')
    <div class="text-center home-hero">

        <h1>Selamatkan Makanan</h1>

        <p class="lead">
            Platform yang membantu mengurangi limbah makanan dengan menjual
            makanan surplus atau makanan yang mendekati masa kadaluarsa
            dengan harga lebih terjangkau.
        </p>

        <a href="/foods" class="btn btn-success btn-lg mt-3">
            EXPLORE
        </a>

    </div>


    <div class="container mt-5">

        <div class="row text-center">

            <div class="col-md-4">

                <h3>🥗 Apa itu Food Rescue?</h3>

                <p>
                    Food Rescue adalah platform yang membantu toko, restoran,
                    dan UMKM menjual makanan atau minuman yang masih layak
                    dikonsumsi tetapi tidak dapat dijual keesokan hari atau
                    mendekati tanggal kadaluarsa.
                </p>

                <p>
                    Contohnya seperti roti bakery yang hanya tahan satu hari,
                    kue yang tidak dapat dijual besok, atau makanan dan minuman
                    kemasan yang mendekati masa kadaluarsa. Melalui Food Rescue,
                    produk tersebut dapat dijual kembali dengan harga lebih murah
                    agar tetap bermanfaat dan tidak terbuang sia-sia.
                </p>

            </div>


            <div class="col-md-4">

                <h3>🌍 Mengurangi Limbah Makanan</h3>

                <p>
                    Setiap hari banyak makanan yang masih layak dikonsumsi
                    dibuang karena tidak terjual tepat waktu. Limbah makanan
                    atau food waste menjadi salah satu masalah lingkungan yang
                    cukup besar di berbagai negara.
                </p>

                <p>
                    Food Rescue hadir sebagai solusi untuk mengurangi limbah
                    makanan dengan menghubungkan toko yang memiliki makanan
                    surplus dengan konsumen yang ingin membeli makanan tersebut
                    dengan harga lebih terjangkau.
                </p>

            </div>


            <div class="col-md-4">

                <h3>💰 Hemat untuk Pembeli</h3>

                <p>
                    Pengguna dapat membeli makanan berkualitas dari toko
                    terdekat dengan harga yang jauh lebih murah dibanding
                    harga normal.
                </p>

                <p>
                    Dengan membeli melalui Food Rescue, pengguna tidak hanya
                    menghemat uang, tetapi juga ikut berkontribusi dalam
                    mengurangi pemborosan makanan dan menjaga lingkungan.
                </p>

            </div>

        </div>

    </div>


    <div class="container mt-5">

        <h2 class="text-center mb-4">Bagaimana Cara Kerjanya?</h2>

        <div class="row text-center">

            <div class="col-md-3">

                <h4>1️⃣ Toko Upload</h4>

                <p>
                    Toko atau restoran mengupload makanan yang tidak dapat
                    dijual keesokan hari atau produk yang mendekati masa
                    kadaluarsa seperti roti, kue, makanan kemasan, atau minuman.
                </p>

            </div>


            <div class="col-md-3">

                <h4>2️⃣ Diskon Harga</h4>

                <p>
                    Makanan dijual dengan harga lebih murah agar cepat
                    dibeli sebelum masa expired dan tidak menjadi limbah makanan.
                </p>

            </div>


            <div class="col-md-3">

                <h4>3️⃣ Pembeli Pesan</h4>

                <p>
                    Pengguna dapat menemukan makanan surplus dari toko
                    terdekat dan memesannya melalui marketplace Food Rescue.
                </p>

            </div>


            <div class="col-md-3">

                <h4>4️⃣ Ambil Pesanan</h4>

                <p>
                    Pembeli mengambil makanan di lokasi toko sebelum
                    batas waktu expired yang telah ditentukan.
                </p>

            </div>

        </div>

    </div>


    <div class="container mt-5 text-center">

        <h2>Bergabung dalam Gerakan Mengurangi Food Waste</h2>

        <p>
            Setiap pembelian di Food Rescue membantu menyelamatkan
            makanan dari pemborosan dan mendukung lingkungan yang
            lebih berkelanjutan.
        </p>

        <a href="/foods" class="btn btn-success btn-lg mt-3">
            Lihat Marketplace
        </a>

    </div>
@endsection


@section('js')
    <script src="/js/home.js"></script>
@endsection
