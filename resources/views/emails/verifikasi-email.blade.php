<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Rakernas XII JKPI 2026</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #0F2A4A 0%, #1B4D85 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }

        .content {
            padding: 40px 30px;
        }

        .button {
            display: inline-block;
            padding: 15px 40px;
            background: #0F2A4A;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
            transition: background 0.3s;
        }

        .button:hover {
            background: #1B4D85;
        }

        .info-box {
            background: #f8f9fa;
            padding: 20px;
            border-left: 4px solid #0F2A4A;
            margin: 20px 0;
            border-radius: 5px;
        }

        .info-box h3 {
            margin-top: 0;
            color: #0F2A4A;
        }

        .highlight {
            color: #0F2A4A;
            font-weight: bold;
            background: #e6f7f8;
            padding: 2px 6px;
            border-radius: 3px;
        }

        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .warning-box ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }

        .footer p {
            margin: 5px 0;
            font-size: 12px;
            color: #6c757d;
        }

        .link-box {
            background: white;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            word-break: break-all;
            font-family: monospace;
            font-size: 12px;
            margin: 15px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Verifikasi Email Pendaftaran</h1>
            <p>Rakernas XII JKPI 2026 - Kota Ternate</p>
        </div>

        <div class="content">
            <h2>Halo, {{ $peserta->nama_lengkap }}</h2>

            <p>Terima kasih telah mendaftar untuk mengikuti <strong>Rakernas XII JKPI 2026</strong> di Kota Ternate,
                Maluku Utara.</p>

            <div class="info-box">
                <h3>📋 Data Pendaftaran Anda</h3>
                <p><strong>Kode Registrasi:</strong> <span class="highlight">{{ $peserta->kode_registrasi }}</span></p>
                <p><strong>Nama:</strong> {{ $peserta->nama_lengkap }}</p>
                <p><strong>Jabatan:</strong> {{ $peserta->jabatan }}</p>
                <p><strong>Instansi/Organisasi:</strong> {{ $peserta->instansi_organisasi }}</p>
                <p><strong>Kota/Kabupaten:</strong> {{ $peserta->kota_kabupaten }}</p>
            </div>

            <p>Untuk mengaktifkan pendaftaran Anda dan menerima <strong>ID Card resmi</strong>, silakan verifikasi email
                Anda dengan mengklik tombol di bawah ini:</p>

            <center>
                <a href="{{ $verificationUrl }}" class="button">✓ Verifikasi Email Saya</a>
            </center>

            <p style="margin-top: 30px;"><strong>Jika tombol di atas tidak berfungsi,</strong> silakan copy dan paste
                link berikut ke browser Anda:</p>
            <div class="link-box">{{ $verificationUrl }}</div>

            <div class="warning-box">
                <p><strong>⚠️ Penting:</strong></p>
                <ul>
                    <li>Link verifikasi ini berlaku selama <strong>24 jam</strong></li>
                    <li>Setelah verifikasi berhasil, <strong>ID Card Anda akan dikirim via email</strong></li>
                    <li>Jika Anda tidak melakukan pendaftaran ini, abaikan email ini</li>
                    <li>Simpan kode registrasi Anda untuk keperluan check-in</li>
                </ul>
            </div>

            <div class="info-box">
                <h3>🎫 Setelah Verifikasi</h3>
                <p>Setelah email Anda terverifikasi, Anda akan menerima:</p>
                <ul>
                    <li>Email konfirmasi pendaftaran</li>
                    <li><strong>ID Card resmi</strong> dalam format PDF</li>
                    <li>Informasi lengkap tentang acara</li>
                    <li>Jadwal dan rundown acara</li>
                </ul>
            </div>
        </div>

        <div class="footer">
            <p><strong>Jaringan Kota Pusaka Indonesia (JKPI)</strong></p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>Jika ada pertanyaan, silakan hubungi panitia Rakernas XII JKPI 2026</p>
            <p style="margin-top: 15px;">&copy; 2026 JKPI - All Rights Reserved</p>
        </div>
    </div>
</body>

</html>
