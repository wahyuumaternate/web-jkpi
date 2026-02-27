<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Terverifikasi - Rakernas XII JKPI 2026</title>
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

        .success-icon {
            font-size: 60px;
            margin: 20px 0;
        }

        .content {
            padding: 40px 30px;
        }

        .content h2 {
            color: #0F2A4A;
            margin-top: 0;
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
            font-size: 16px;
        }

        .info-box p {
            margin: 8px 0;
        }

        .highlight {
            color: #0F2A4A;
            font-weight: bold;
            background: #e6f7f8;
            padding: 2px 6px;
            border-radius: 3px;
        }

        .success-box {
            background: #d4edda;
            border-left: 4px solid #28a745;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .success-box h3 {
            margin-top: 0;
            color: #155724;
        }

        .id-card-box {
            background: linear-gradient(135deg, #fef9e7 0%, #fdebd0 100%);
            border-left: 4px solid #d4a017;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .id-card-box h3 {
            margin-top: 0;
            color: #856404;
        }

        .important-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .important-box ul {
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

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .schedule-table th,
        .schedule-table td {
            padding: 10px;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        .schedule-table th {
            background: #0F2A4A;
            color: white;
            font-weight: 600;
        }

        .schedule-table tr:nth-child(even) {
            background: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="success-icon">✅</div>
            <h1>Email Berhasil Diverifikasi!</h1>
            <p>Selamat Datang di Rakernas XII JKPI 2026</p>
        </div>

        <div class="content">
            <h2>Selamat, {{ $peserta->nama_lengkap }}!</h2>

            <div class="success-box">
                <h3>🎉 Pendaftaran Anda Telah Dikonfirmasi</h3>
                <p>Email Anda telah berhasil diverifikasi dan pendaftaran Anda untuk mengikuti <strong>Rakernas XII JKPI
                        2026</strong> di Kota Ternate telah resmi terkonfirmasi.</p>
            </div>

            <div class="info-box">
                <h3>📋 Informasi Pendaftaran Anda</h3>
                <p><strong>Kode Registrasi:</strong> <span class="highlight">{{ $peserta->kode_registrasi }}</span></p>
                <p><strong>Nama:</strong> {{ $peserta->nama_lengkap }}</p>
                <p><strong>Jabatan:</strong> {{ $peserta->jabatan }}</p>
                <p><strong>Instansi/Organisasi:</strong> {{ $peserta->instansi_organisasi }}</p>
                <p><strong>Kota/Kabupaten:</strong> {{ $peserta->kota_kabupaten }}</p>
                <p><strong>Tanggal Kedatangan:</strong> {{ $peserta->tanggal_kedatangan->format('d F Y') }}</p>
                <p><strong>Tanggal Kepulangan:</strong> {{ $peserta->tanggal_kepulangan->format('d F Y') }}</p>
            </div>

            @if ($hasIdCard)
                <div class="id-card-box">
                    <h3>🎫 ID Card Anda Terlampir</h3>
                    <p>ID Card resmi Rakernas XII JKPI 2026 Anda telah terlampir dalam email ini.</p>
                    <p><strong>Cara Menggunakan ID Card:</strong></p>
                    <ul>
                        <li>Unduh dan simpan file PDF yang terlampir</li>
                        <li>Cetak ID Card Anda (ukuran B3: 95mm × 126mm)</li>
                        <li>Gunakan ID Card saat registrasi ulang dan selama acara berlangsung</li>
                        <li>QR Code pada ID Card dapat di-scan untuk verifikasi kehadiran</li>
                    </ul>
                    <p><strong>⚠️ Penting:</strong> Harap bawa ID Card tercetak saat menghadiri acara!</p>
                </div>
            @endif

            <div class="info-box">
                <h3>📅 Jadwal Acara</h3>
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Hari/Tanggal</th>
                            <th>Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hari 1</td>
                            <td>Registrasi & Opening Ceremony</td>
                        </tr>
                        <tr>
                            <td>Hari 2</td>
                            <td>Seminar & Workshop</td>
                        </tr>
                        <tr>
                            <td>Hari 3</td>
                            <td>Penutupan & City Tour</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="important-box">
                <p><strong>⚠️ Hal-hal yang Perlu Diperhatikan:</strong></p>
                <ul>
                    <li>Simpan email ini sebagai bukti konfirmasi pendaftaran</li>
                    <li>Cetak ID Card Anda dan bawa saat registrasi ulang</li>
                    <li>Datang 30 menit sebelum acara dimulai untuk registrasi ulang</li>
                    <li>Hubungi panitia jika ada perubahan jadwal kehadiran</li>
                </ul>
            </div>

            <div class="info-box">
                <h3>📞 Kontak Panitia</h3>
                <p><strong>Email:</strong> info@jkpi2026-ternate.id</p>
                <p><strong>WhatsApp:</strong> +62 812-3456-7890</p>
                <p><strong>Website:</strong> www.jkpi2026-ternate.id</p>
            </div>

            <p style="margin-top: 30px;">Kami tunggu kehadiran Anda di Rakernas XII JKPI 2026!</p>
            <p><strong>Sampai jumpa di Kota Ternate! 🌴</strong></p>
        </div>

        <div class="footer">
            <p><strong>Jaringan Kota Pusaka Indonesia (JKPI)</strong></p>
            <p>Rakernas XII 2026 - Kota Ternate, Maluku Utara</p>
            <p style="margin-top: 15px;">Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>Jika ada pertanyaan, silakan hubungi panitia melalui kontak di atas.</p>
            <p style="margin-top: 15px;">&copy; 2026 JKPI - All Rights Reserved</p>
        </div>
    </div>
</body>

</html>
