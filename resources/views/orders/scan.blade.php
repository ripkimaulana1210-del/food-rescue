@extends('layouts.app')

@section('title', 'Scan QR - Food Rescue')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/scan.css') }}">
@endsection

@section('content')
    <div class="scan-page">

        <div class="scan-header">
            <div class="scan-icon">📷</div>
            <h2>Scan QR Pesanan</h2>
            <p>Arahkan kamera ke kode QR pesanan pelanggan</p>
        </div>

        @if (session('success'))
            <div class="scan-alert success">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="scan-alert error">
                <span>✕</span> {{ session('error') }}
            </div>
        @endif

        <!-- Scanner -->
        <div class="scanner-container">
            <div class="scanner-overlay"></div>
            <div id="reader"></div>

        <!-- Hidden Form -->
        <form id="scan-form" action="{{ route('orders.scan.process') }}" method="POST">
            @csrf
            <input type="hidden" name="code" id="code">
        </form>

        <div class="divider-or"><span>ATAU</span></div>

        <!-- Manual Input -->
        <div class="manual-section">
            <h3>📝 Input Kode Pesanan Manual</h3>
            <form action="{{ route('orders.scan.process') }}" method="POST" id="manual-form">
                @csrf
                <div class="manual-input-group">
                    <input type="text" name="manual_code" id="manual_code" placeholder="Masukkan kode pesanan..." maxlength="8" required oninput="this.value = this.value.toUpperCase()">
                    <button type="submit" class="btn-manual" id="manual-btn">Cari</button>
                </div>
            </form>
        </div>

    <!-- QR Library -->
    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        let scanned = false;

        function onScanSuccess(decodedText, decodedResult) {
            if (scanned) return;
            scanned = true;

            console.log(`Code scanned: ${decodedText}`);
            document.getElementById('code').value = decodedText;
            document.getElementById('scan-form').submit();
        }

        function onScanFailure(error) {
            // console.warn(`Code scan error = ${error}`);
        }

        // Prevent double submit on manual form too
        document.getElementById('manual-form').addEventListener('submit', function() {
            const btn = document.getElementById('manual-btn');
            btn.disabled = true;
            btn.textContent = 'Memproses...';
        });

        Html5Qrcode.getCameras().then(cameras => {
            if (cameras && cameras.length) {
                let cameraId = cameras[0].id;

                for (let cam of cameras) {
                    const label = cam.label.toLowerCase();
                    if (label.includes('back') || label.includes('environment') || label.includes('belakang')) {
                        cameraId = cam.id;
                        break;
                    }
                }

                const html5QrCode = new Html5Qrcode("reader");
                html5QrCode.start(
                    cameraId,
                    { fps: 10, qrbox: { width: 250, height: 250 } },
                    onScanSuccess,
                    onScanFailure
                ).catch(err => {
                    console.error("Failed to start scanning", err);
                });
            }
        }).catch(err => {
            console.error("Error getting cameras", err);
        });
    </script>
@endsection
