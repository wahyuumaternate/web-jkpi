<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ID Card - {{ $nama }}</title>
    <style>
        @page {
            margin: 0;
            size: 95mm 126mm portrait;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 95mm;
            height: 126mm;
        }

        .card {
            width: 95mm;
            height: 126mm;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
        }

        /* ===== DARK TOP SECTION ===== */
        .top-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 95mm;
            height: 40mm;
            background: #1B4D85;
        }

        /* Geometric shapes - Triangle decorations */
        .geo-1 {
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 29mm 34mm 0;
            border-color: transparent #163D6B transparent transparent;
            opacity: 0.6;
        }

        .geo-2 {
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 19mm 24mm 0;
            border-color: transparent #1B4D85 transparent transparent;
            opacity: 0.4;
        }

        .geo-3 {
            position: absolute;
            top: 11mm;
            left: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 26mm 0 0 22mm;
            border-color: transparent transparent transparent #163D6B;
            opacity: 0.5;
        }

        /* Decorative circles */
        .circle-1 {
            position: absolute;
            top: -7mm;
            left: -7mm;
            width: 21mm;
            height: 21mm;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .circle-2 {
            position: absolute;
            bottom: 16mm;
            right: -8mm;
            width: 25mm;
            height: 25mm;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
        }

        /* ===== LOGO ===== */
        .logo-wrapper {
            position: absolute;
            top: 2.5mm;
            left: 0;
            width: 95mm;
            z-index: 10;
        }

        .logo-wrapper img {
            height: 12mm;
            margin: 0 auto 1mm auto;
            display: block;
        }

        .logo-text {
            font-size: 20pt;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 4pt;
            text-align: center;
            display: block;
        }

        .logo-sub {
            font-size: 6pt;
            color: #8BAFD0;
            letter-spacing: 0.5pt;
            text-transform: uppercase;
            margin-top: 1mm;
            line-height: 1.2;
            text-align: center;
            display: block;
        }

        .event-name {
            font-size: 5.5pt;
            color: #ffffff;
            margin-top: 1mm;
            font-weight: 600;
            letter-spacing: 0.5pt;
            opacity: 0.85;
            text-align: center;
            display: block;
        }

        /* ===== PHOTO ===== */
        .photo-wrapper {
            position: absolute;
            top: 22.5mm;
            left: 0;
            width: 95mm;
            z-index: 15;
        }

        .photo-ring {
            width: 29mm;
            height: 29mm;
            border-radius: 50%;
            border: 1mm solid #ffffff;
            overflow: hidden;
            background: #f0f0f0;
            margin: 0 auto;
            display: block;
            position: relative;
        }

        .photo-ring img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .initial-circle {
            width: 29mm;
            height: 29mm;
            border-radius: 50%;
            background: #1B4D85;
            color: #ffffff;
            font-size: 32pt;
            font-weight: bold;
            text-align: center;
            line-height: 29mm;
            display: block;
        }

        /* ===== INFO ===== */
        .info-wrapper {
            position: absolute;
            top: 57mm;
            left: 5mm;
            width: 85mm;
            z-index: 10;
        }

        .person-name {
            font-size: 13pt;
            font-weight: bold;
            color: #1a1a1a;
            line-height: 1.2;
            margin-bottom: 1.5mm;
            text-align: center;
            display: block;
        }

        .person-institution {
            font-size: 9pt;
            color: #0F2A4A;
            margin-bottom: 1mm;
            font-weight: 600;
            line-height: 1.2;
            text-align: center;
            display: block;
        }

        .person-role {
            font-size: 7pt;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 0.5pt;
            margin-top: 1.5mm;
            font-weight: 600;
            text-align: center;
            display: block;
        }

        .id-badge {
            margin-top: 2.5mm;
            text-align: center;
            display: block;
        }

        .id-badge-inner {
            display: inline-block;
            background: #0F2A4A;
            color: #ffffff;
            font-size: 7pt;
            font-weight: bold;
            letter-spacing: 0.3pt;
            padding: 1.5mm 4mm;
            border-radius: 3mm;
        }

        /* ===== QR CODE ===== */
        .qr-wrapper {
            position: absolute;
            bottom: 7mm;
            left: 0;
            width: 95mm;
            z-index: 20;
        }

        .qr-border {
            display: inline-block;
            padding: 1mm;
            border: 0.5mm solid #e0e0e0;
            background-color: #ffffff;
            border-radius: 2mm;
            margin: 0 auto;
            width: 20.5mm;
            height: 20.5mm;
        }

        .qr-center {
            text-align: center;
            display: block;
        }

        .qr-border img {
            width: 18.5mm;
            height: 18.5mm;
            display: block;
        }

        .qr-label {
            font-size: 5.5pt;
            color: #aaaaaa;
            margin-top: 1mm;
            font-weight: 500;
            text-align: center;
            display: block;
        }

        /* ===== BOTTOM LINE ===== */
        .bottom-line {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 95mm;
            height: 1mm;
            background: #0F2A4A;
        }
    </style>
</head>

<body>
    <div class="card">
        <!-- Background -->
        <div class="top-bg"></div>
        <div class="geo-1"></div>
        <div class="geo-2"></div>
        <div class="geo-3"></div>
        <div class="circle-1"></div>
        <div class="circle-2"></div>

        <!-- Logo -->
        <div class="logo-wrapper">
            {{-- @if ($logo)
                <img src="{{ $logo }}" alt="Logo JKPI">
            @endif
            @if (!$logo)
            @endif --}}
            <div class="logo-text">JKPI</div>
            <div class="logo-sub">JARINGAN KOTA PUSAKA INDONESIA</div>
            <div class="event-name">RAKERNAS XII 2026 • TERNATE</div>
        </div>

        <!-- Photo -->
        <div class="photo-wrapper">
            @if ($foto)
                <div class="photo-ring">
                    <img src="{{ $foto }}" alt="{{ $nama }}">
                </div>
            @else
                <div class="photo-ring">
                    <div class="initial-circle">{{ $initial }}</div>
                </div>
            @endif
        </div>

        <!-- Info -->
        <div class="info-wrapper">
            <div class="person-name">{{ $nama }}</div>
            <div class="person-institution">{{ $instansi }}</div>
            <div class="person-role">{{ $status }}</div>
            <div class="id-badge">
                <span class="id-badge-inner">ID: {{ $nomor_id }}</span>
            </div>
        </div>

        <!-- QR Code -->
        <div class="qr-wrapper">
            <div class="qr-center">
                <div class="qr-border">
                    <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
                </div>
            </div>
            <div class="qr-label">Scan untuk verifikasi</div>
        </div>

        <!-- Bottom Line -->
        <div class="bottom-line"></div>
    </div>
</body>

</html>
