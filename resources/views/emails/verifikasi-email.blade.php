<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #8B1518;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            background: #f9f9f9;
            padding: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #8B1518;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>JKPI 2026</h1>
            <p>Rakernas Jaringan Kota Pusaka Indonesia</p>
        </div>

        <div class="content">
            <h2>Hai {{ $peserta->nama_lengkap }},</h2>

            <p>Terima kasih telah mendaftar untuk JKPI 2026!</p>

            <p>Kode Registrasi Anda: <strong>{{ $peserta->kode_registrasi }}</strong></p>

            <p>Untuk mengaktifkan akun Anda, silakan klik tombol di bawah ini:</p>

            <center>
                <a href="{{ $verificationUrl }}" class="button">Verifikasi Email</a>
            </center>

            <p><strong>ID Card Anda terlampir dalam email ini.</strong> Silakan simpan dan bawa saat acara berlangsung.
            </p>

            <p>Jika tombol di atas tidak berfungsi, copy dan paste URL berikut ke browser Anda:</p>
            <p><a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a></p>

            <p>Jika Anda tidak melakukan pendaftaran ini, abaikan email ini.</p>
        </div>

        <div class="footer">
            <p>© 2026 JKPI - Rakernas Jaringan Kota Pusaka Indonesia</p>
            <p>jkpi.ternatetourism.com | +123 456 7890</p>
        </div>
    </div>
</body>

</html>
