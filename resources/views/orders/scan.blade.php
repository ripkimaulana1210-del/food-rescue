@extends('layouts.app')

@section('content')
    <div style="max-width:500px;margin:50px auto;text-align:center;">

        <h2>📷 Scan QR Pesanan</h2>

        @if (session('success'))
            <p style="color:green">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p style="color:red">{{ session('error') }}</p>
        @endif

        <!-- 🔥 CAMERA -->
        <div id="reader" style="width:100%;margin-top:20px;"></div>

        <!-- FORM HIDDEN -->
        <form id="scan-form" action="{{ route('orders.scan.process') }}" method="POST">
            @csrf
            <input type="hidden" name="code" id="code">
        </form>

    </div>

    <!-- LIBRARY QR -->
    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code scanned: ${decodedText}`);

            // isi ke input
            document.getElementById('code').value = decodedText;

            // auto submit
            document.getElementById('scan-form').submit();
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            }
        );

        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endsection
