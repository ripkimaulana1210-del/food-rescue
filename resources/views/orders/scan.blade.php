@extends('layouts.app')

@section('title', 'Scan QR Pesanan')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection

@section('content')
    <div class="scan-page">
        <section class="scan-card">
            <div class="scan-topbar">
                <a href="{{ route('store.orders') }}" class="scan-back">Kembali</a>
                <span class="scan-badge">Validasi pesanan</span>
            </div>

            <div class="scan-header">
                <div>
                    <h2>Scan QR Pesanan</h2>
                    <p>Arahkan kamera ke kode QR pelanggan. Sistem akan membaca kode dan memproses pesanan secara otomatis.</p>
                </div>
            </div>

            @if (session('success'))
                <div class="scan-alert scan-alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="scan-alert scan-alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="scan-mode-tabs" role="tablist" aria-label="Metode scan QR">
                <button type="button" class="scan-mode-btn active" data-mode="camera">Kamera</button>
                <button type="button" class="scan-mode-btn" data-mode="upload">Upload File</button>
            </div>

            <div class="scan-controls" id="camera-panel">
                <label for="camera-select">Pilih kamera</label>
                <div class="scan-camera-row">
                    <select id="camera-select">
                        <option value="">Mencari kamera...</option>
                    </select>
                    <button type="button" id="start-camera" class="scan-action-btn">Mulai Scan</button>
                    <button type="button" id="stop-camera" class="scan-secondary-btn" disabled>Berhenti</button>
                </div>
            </div>

            <div class="scan-upload-panel" id="upload-panel" hidden>
                <label for="qr-file" class="scan-upload-box">
                    <span class="scan-upload-title">Pilih gambar QR</span>
                    <span class="scan-upload-text">Gunakan file JPG, PNG, atau gambar QR dari galeri.</span>
                    <span class="scan-upload-button">Upload File</span>
                </label>
                <input type="file" id="qr-file" accept="image/*">
                <p class="scan-file-name" id="scan-file-name">Belum ada file dipilih</p>
            </div>

            <div class="scanner-shell" aria-label="Area kamera scan QR">
                <div class="scanner-label" id="scanner-label">Kamera belum aktif</div>
                <div id="reader"></div>
            </div>

            <div class="scan-tips">
                <div>
                    <strong>Posisikan QR di tengah</strong>
                    <span>Jaga jarak kamera agar kode terbaca jelas.</span>
                </div>
                <div>
                    <strong>Cahaya cukup</strong>
                    <span>Hindari bayangan atau layar yang terlalu redup.</span>
                </div>
            </div>

            <form id="scan-form" action="{{ route('orders.scan.process') }}" method="POST">
                @csrf
                <input type="hidden" name="code" id="code">
            </form>
        </section>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        let hasScanned = false;
        let activeCameraId = null;
        let activeMode = 'camera';
        let scannerRunning = false;
        const html5QrCode = new Html5Qrcode('reader');

        const cameraSelect = document.getElementById('camera-select');
        const startButton = document.getElementById('start-camera');
        const stopButton = document.getElementById('stop-camera');
        const cameraPanel = document.getElementById('camera-panel');
        const uploadPanel = document.getElementById('upload-panel');
        const fileInput = document.getElementById('qr-file');
        const fileName = document.getElementById('scan-file-name');
        const scannerLabel = document.getElementById('scanner-label');
        const modeButtons = document.querySelectorAll('.scan-mode-btn');

        function onScanSuccess(decodedText, decodedResult) {
            if (hasScanned) {
                return;
            }

            hasScanned = true;
            console.log(`Code scanned: ${decodedText}`);

            document.getElementById('code').value = decodedText;
            document.getElementById('scan-form').submit();
        }

        function setScannerStatus(message) {
            scannerLabel.textContent = message;
        }

        async function loadCameras() {
            try {
                const cameras = await Html5Qrcode.getCameras();
                cameraSelect.innerHTML = '';

                if (!cameras.length) {
                    cameraSelect.innerHTML = '<option value="">Kamera tidak ditemukan</option>';
                    startButton.disabled = true;
                    setScannerStatus('Kamera tidak ditemukan');
                    return;
                }

                cameras.forEach((camera, index) => {
                    const option = document.createElement('option');
                    option.value = camera.id;
                    option.textContent = camera.label || `Kamera ${index + 1}`;
                    cameraSelect.appendChild(option);
                });

                activeCameraId = cameras[0].id;
                cameraSelect.value = activeCameraId;
                startButton.disabled = false;
                setScannerStatus('Pilih kamera lalu mulai scan');
            } catch (error) {
                cameraSelect.innerHTML = '<option value="">Izinkan akses kamera</option>';
                startButton.disabled = false;
                setScannerStatus('Akses kamera belum diizinkan');
            }
        }

        async function stopScanner() {
            if (!scannerRunning) {
                return;
            }

            await html5QrCode.stop();
            scannerRunning = false;
            stopButton.disabled = true;
            startButton.disabled = false;
            setScannerStatus('Kamera berhenti');
        }

        async function startScanner() {
            if (hasScanned) {
                return;
            }

            if (scannerRunning) {
                await stopScanner();
            }

            activeCameraId = cameraSelect.value || activeCameraId;

            if (!activeCameraId) {
                await loadCameras();
                activeCameraId = cameraSelect.value || activeCameraId;
            }

            if (!activeCameraId) {
                setScannerStatus('Kamera belum tersedia');
                return;
            }

            try {
                await html5QrCode.start(
                    activeCameraId,
                    {
                        fps: 10,
                        qrbox: {
                            width: 240,
                            height: 240
                        },
                        aspectRatio: 1.45
                    },
                    onScanSuccess
                );

                scannerRunning = true;
                startButton.disabled = true;
                stopButton.disabled = false;
                setScannerStatus('Kamera aktif');
            } catch (error) {
                scannerRunning = false;
                setScannerStatus('Gagal membuka kamera');
                startButton.disabled = false;
                stopButton.disabled = true;
            }
        }

        async function switchMode(mode) {
            activeMode = mode;
            modeButtons.forEach((button) => {
                button.classList.toggle('active', button.dataset.mode === mode);
            });

            cameraPanel.hidden = mode !== 'camera';
            uploadPanel.hidden = mode !== 'upload';

            if (mode === 'upload') {
                await stopScanner();
                setScannerStatus('Upload gambar QR');
            } else {
                setScannerStatus('Pilih kamera lalu mulai scan');
            }
        }

        cameraSelect.addEventListener('change', async (event) => {
            activeCameraId = event.target.value;

            if (scannerRunning) {
                await startScanner();
            }
        });

        startButton.addEventListener('click', startScanner);
        stopButton.addEventListener('click', stopScanner);

        modeButtons.forEach((button) => {
            button.addEventListener('click', () => switchMode(button.dataset.mode));
        });

        fileInput.addEventListener('change', async (event) => {
            const file = event.target.files[0];

            if (!file || hasScanned) {
                return;
            }

            fileName.textContent = file.name;
            await stopScanner();
            setScannerStatus('Membaca file QR...');

            try {
                const decodedText = await html5QrCode.scanFile(file, true);
                onScanSuccess(decodedText);
            } catch (error) {
                setScannerStatus('QR tidak terbaca dari file');
                fileName.textContent = 'QR tidak terbaca, coba gambar lain';
            }
        });

        loadCameras();
    </script>
@endsection
