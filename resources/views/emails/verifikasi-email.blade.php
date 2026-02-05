<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - JKPI 2026</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #099aa7 0%, #077b86 100%);
            color: #ffffff;
            padding: 40px 30px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
        }

        .email-header p {
            margin: 10px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .email-body {
            padding: 40px 30px;
        }

        .email-body h2 {
            color: #099aa7;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .email-body p {
            margin-bottom: 15px;
            color: #666;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #099aa7;
            padding: 20px;
            margin: 25px 0;
            border-radius: 5px;
        }

        .info-box strong {
            color: #099aa7;
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .info-box p {
            margin: 5px 0;
            color: #555;
        }

        .btn-verify {
            display: inline-block;
            background: linear-gradient(135deg, #099aa7 0%, #077b86 100%);
            color: #ffffff !important;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(9, 154, 167, 0.3);
            transition: all 0.3s;
        }

        .btn-verify:hover {
            box-shadow: 0 8px 25px rgba(9, 154, 167, 0.4);
        }

        .email-footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .email-footer p {
            margin: 5px 0;
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #099aa7;
            text-decoration: none;
        }

        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 30px 0;
        }

        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 20px 10px;
            }

            .email-header,
            .email-body,
            .email-footer {
                padding: 25px 20px;
            }

            .email-header h1 {
                font-size: 24px;
            }

            .btn-verify {
                display: block;
                padding: 15px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>RAKERNAS XII JKPI 2026</h1>
            <p>Pusaka Ternate, Pusaka Dunia</p>
        </div>

        <div class="email-body">
            <h2>Halo, {{ $peserta->nama_lengkap }}!</h2>

            <p>Terima kasih telah mendaftar untuk Rakernas XII Jaringan Kota Pusaka Indonesia (JKPI) 2026 yang akan
                diselenggarakan di Kota Ternate, Maluku Utara.</p>

            <p>Untuk menyelesaikan proses pendaftaran Anda, silakan verifikasi alamat email Anda dengan mengklik tombol
                di bawah ini:</p>

            <center>
                <a href="{{ $verificationUrl }}" class="btn-verify">
                    ✓ Verifikasi Email Saya
                </a>
            </center>

            <div class="info-box">
                <strong>Informasi Pendaftaran Anda:</strong>
                <p><strong>Nama:</strong> {{ $peserta->nama_lengkap }}</p>
                <p><strong>Email:</strong> {{ $peserta->email }}</p>
                <p><strong>Kode Registrasi:</strong> {{ $peserta->kode_registrasi }}</p>
                <p><strong>Nomor WhatsApp:</strong> {{ $peserta->nomor_telepon }}</p>
            </div>

            <div class="divider"></div>

            <p style="font-size: 14px; color: #999;">
                <strong>Catatan:</strong> Link verifikasi ini akan kadaluarsa dalam 24 jam. Jika Anda tidak merasa
                mendaftar untuk acara ini, abaikan email ini.
            </p>

            <p style="font-size: 14px; color: #999;">
                Jika tombol di atas tidak berfungsi, copy dan paste link berikut ke browser Anda:<br>
                <a href="{{ $verificationUrl }}"
                    style="color: #099aa7; word-break: break-all;">{{ $verificationUrl }}</a>
            </p>
        </div>

        <div class="email-footer">
            <p><strong>Sekretariat Rakernas XII JKPI 2026</strong></p>
            <p>Pemerintah Kota Ternate, Maluku Utara</p>
            <p>Email: info@jkpi.ternatetourism.com</p>

            <div class="social-links">
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a> |
                <a href="#">Twitter</a>
            </div>

            <p style="margin-top: 20px; font-size: 12px; color: #999;">
                © 2026 Rakernas XII JKPI - Kota Ternate. All Rights Reserved.
            </p>
        </div>
    </div>
</body>

</html>
