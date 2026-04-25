@extends('layouts.app')

@section('css')
    <style>
        .scan-wrapper {
            max-width: 500px;
            margin: 40px auto;
            text-align: center;
            padding: 0 15px;
        }
        .scan-wrapper h2 {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            color: #333;
        }
        .scan-wrapper p.desc {
            color: #777;
            font-size: 0.95rem;
            margin-bottom: 25px;
        }
        .alert {
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
        }
        .alert-error {
            background: #ffebee;
            color: #c62828;
        }
        #reader {
            width: 100%;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        /* tombol switch camera */
        #html5-qrcode-button-camera-permission,
        #html5-qrcode-select-camera {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
    </style>
@endsection

@section('content')
    <div class="scan-wrapper">

        <h2>📷 Scan QR Pesanan</h2>
        <p class="desc">Arahkan kamera ke kode QR pesanan pelanggan</p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <!-- 🔥 CAMERA -->
        <div id="reader"></div>

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
            document.getElementById('code').value = decodedText;
            document.getElementById('scan-form').submit();
        }

        function onScanFailure(error) {
            // console.warn(`Code scan error = ${error}`);
        }

        // 🔥 PAKAI KAMERA BELAKANG (environment)
        Html5Qrcode.getCameras().then(cameras => {
            if (cameras && cameras.length) {
                // Cari kamera belakang (label mengandung 'back' atau 'environment')
                let cameraId = cameras[0].id; // default kamera pertama

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
                    {
                        fps: 10,
                        qrbox: { width: 250, height: 250 }
                    },
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
