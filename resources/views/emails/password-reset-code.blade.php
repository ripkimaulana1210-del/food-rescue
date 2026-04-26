<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Reset Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .header p {
            margin: 8px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .body {
            padding: 30px;
            text-align: center;
        }
        .body p {
            color: #4b5563;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .code-box {
            background: #f0fdf4;
            border: 2px dashed #10b981;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .code {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 8px;
            color: #059669;
            font-family: 'Courier New', monospace;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🍔 Food Rescue</h1>
            <p>Kode Verifikasi Reset Password</p>
        </div>
        <div class="body">
            <p>Halo,</p>
            <p>Kami menerima permintaan untuk mereset password akun Anda. Gunakan kode verifikasi di bawah ini untuk melanjutkan:</p>
            
            <div class="code-box">
                <div class="code">{{ $code }}</div>
            </div>
            
            <p>Kode ini berlaku selama <strong>60 menit</strong>. Jangan bagikan kode ini kepada siapapun.</p>
            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Food Rescue. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

