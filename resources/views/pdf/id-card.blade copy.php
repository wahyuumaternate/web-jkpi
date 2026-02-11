<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ID Card - {{ $nama }}</title>
    <style>
        @page {
            margin: 0;
            size: 54mm 85.6mm portrait;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Helvetica', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .card {
            width: 54mm;
            height: 85.6mm;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
        }

        /* ===== DARK TOP SECTION ===== */
        .top-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 54mm;
            height: 32mm;
            background-color: #0F2A4A;
        }

        /* Geometric shapes via CSS border triangles */
        .geo-1 {
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 22mm 28mm 0;
            border-color: transparent #163D6B transparent transparent;
        }

        .geo-2 {
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 16mm 20mm 0;
            border-color: transparent #1B4D85 transparent transparent;
        }

        .geo-3 {
            position: absolute;
            top: 10mm;
            left: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 22mm 0 0 18mm;
            border-color: transparent transparent transparent #163D6B;
        }

        /* ===== LOGO ===== */
        .logo-wrapper {
            position: absolute;
            top: 2.5mm;
            left: 0;
            width: 54mm;
            z-index: 10;
        }

        .logo-wrapper td {
            text-align: center;
            vertical-align: middle;
        }

        .logo-wrapper img {
            height: 10mm;
        }

        .logo-text {
            font-size: 11pt;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 3pt;
        }

        .logo-sub {
            font-size: 5pt;
            color: #8BAFD0;
            letter-spacing: 1pt;
            text-transform: uppercase;
            padding-top: 0.5mm;
        }

        /* ===== PHOTO ===== */
        .photo-wrapper {
            position: absolute;
            top: 19mm;
            left: 0;
            width: 54mm;
            z-index: 20;
        }

        .photo-wrapper td {
            text-align: center;
            vertical-align: middle;
        }

        .photo-ring {
            width: 22mm;
            height: 22mm;
            border-radius: 50%;
            border: 1mm solid #ffffff;
            overflow: hidden;
            background-color: #e0e0e0;
            display: inline-block;
        }

        .photo-ring img {
            width: 20mm;
            height: 20mm;
        }

        .initial-circle {
            width: 20mm;
            height: 20mm;
            border-radius: 50%;
            background-color: #1B4D85;
            text-align: center;
            line-height: 20mm;
            font-size: 20pt;
            font-weight: bold;
            color: #ffffff;
        }

        /* ===== INFO ===== */
        .info-wrapper {
            position: absolute;
            top: 43mm;
            left: 0;
            width: 54mm;
            z-index: 10;
        }

        .info-wrapper td {
            text-align: center;
            vertical-align: top;
            padding: 0 3mm;
        }

        .person-name {
            font-size: 9pt;
            font-weight: bold;
            color: #1a1a1a;
            line-height: 1.3;
        }

        .person-role {
            font-size: 6pt;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 1.5pt;
            padding-top: 1mm;
        }

        .id-badge-inner {
            display: inline-block;
            background-color: #0F2A4A;
            color: #ffffff;
            font-size: 6pt;
            font-weight: bold;
            letter-spacing: 0.5pt;
            padding: 1.2mm 4mm;
            border-radius: 3mm;
            margin-top: 2mm;
        }

        /* ===== QR CODE ===== */
        .qr-wrapper {
            position: absolute;
            bottom: 2.5mm;
            left: 0;
            width: 54mm;
            z-index: 10;
        }

        .qr-wrapper td {
            text-align: center;
            vertical-align: middle;
        }

        .qr-border {
            display: inline-block;
            padding: 1mm;
            border: 0.3mm solid #e0e0e0;
            border-radius: 1.5mm;
            background-color: #ffffff;
        }

        .qr-border img {
            width: 16mm;
            height: 16mm;
            display: block;
        }

        .qr-label {
            font-size: 4.5pt;
            color: #aaaaaa;
            padding-top: 1mm;
            letter-spacing: 0.3pt;
        }

        /* ===== BOTTOM LINE ===== */
        .bottom-line {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 54mm;
            height: 1mm;
            background-color: #0F2A4A;
        }
    </style>
</head>

<body>
    <div class="card">

        {{-- Background biru gelap --}}
        <div class="top-bg"></div>

        {{-- Geometric shapes --}}
        <div class="geo-1"></div>
        <div class="geo-2"></div>
        <div class="geo-3"></div>

        {{-- Logo --}}
        <table class="logo-wrapper" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                    @if ($logo)
                        <img src="{{ $logo }}" alt="Logo"><br>
                    @else
                        <div class="logo-text">JKPI</div>
                    @endif
                    <div class="logo-sub">Jaringan Kota Pusaka Indonesia</div>
                </td>
            </tr>
        </table>

        {{-- Foto --}}
        <table class="photo-wrapper" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                    <div class="photo-ring">
                        @if ($foto)
                            <img src="{{ $foto }}" alt="{{ $nama }}">
                        @else
                            <div class="initial-circle">{{ strtoupper(substr($nama, 0, 1)) }}</div>
                        @endif
                    </div>
                </td>
            </tr>
        </table>

        {{-- Nama + Status + ID --}}
        <table class="info-wrapper" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                    <div class="person-name">{{ $nama }}</div>
                    <div class="person-role">{{ $status }}</div>
                    @if (!empty($nomor_id))
                        <br>
                        <span class="id-badge-inner">ID : {{ $nomor_id }}</span>
                    @endif
                </td>
            </tr>
        </table>

        {{-- QR Code --}}
        <table class="qr-wrapper" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                    <div class="qr-border">
                        <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
                    </div>
                    <div class="qr-label">Scan untuk verifikasi</div>
                </td>
            </tr>
        </table>

        {{-- Garis bawah --}}
        <div class="bottom-line"></div>

    </div>
</body>

</html>
