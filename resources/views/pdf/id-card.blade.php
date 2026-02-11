<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ID Card - {{ $nama }}</title>
    <style>
        @page {
            margin: 0;
            size: 85.6mm 54mm landscape;
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
        }

        .card {
            width: 85.6mm;
            height: 54mm;
            background: white;
            position: relative;
            overflow: hidden;
        }

        /* Strip accent atas */
        .accent-top {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3mm;
            background: #8B1518;
        }

        .content {
            display: flex;
            align-items: center;
            padding: 6mm 5mm 4mm 5mm;
            height: 100%;
        }

        /* Kolom kiri: logo + info */
        .left {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding-right: 4mm;
        }

        .logo-img {
            max-width: 24mm;
            height: auto;
            margin-bottom: 3mm;
        }

        .logo-text {
            font-size: 11pt;
            font-weight: bold;
            color: #8B1518;
            letter-spacing: 2pt;
            margin-bottom: 2mm;
        }

        .photo-frame {
            width: 18mm;
            height: 18mm;
            border-radius: 50%;
            border: 1mm solid #8B1518;
            overflow: hidden;
            background: #f0f0f0;
            margin-bottom: 2mm;
        }

        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .initial {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20pt;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #DC2626, #8B1518);
        }

        .name {
            font-size: 12pt;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 1.5mm;
            line-height: 1.2;
        }

        .role {
            font-size: 8.5pt;
            color: #8B1518;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1pt;
        }

        /* Separator vertikal */
        .separator {
            width: 0.5mm;
            height: 34mm;
            background: #e0e0e0;
            flex-shrink: 0;
        }

        /* Kolom kanan: QR */
        .right {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-left: 4mm;
        }

        .qr-frame {
            background: white;
            padding: 2mm;
            border: 0.5mm solid #e0e0e0;
            border-radius: 2mm;
        }

        .qr-frame img {
            width: 28mm;
            height: 28mm;
            display: block;
        }

        .qr-label {
            font-size: 5.5pt;
            color: #999;
            margin-top: 1.5mm;
            text-align: center;
        }

        /* Strip accent bawah */
        .accent-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3mm;
            background: #8B1518;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="accent-top"></div>

        <div class="content">
            <div class="left">
                @if ($logo)
                    <img src="{{ $logo }}" alt="Logo" class="logo-img">
                @else
                    <div class="logo-text">JKPI</div>
                @endif

                <div class="photo-frame">
                    @if ($foto)
                        <img src="{{ $foto }}" alt="{{ $nama }}">
                    @else
                        <div class="initial">{{ strtoupper(substr($nama, 0, 1)) }}</div>
                    @endif
                </div>

                <div class="name">{{ $nama }}</div>
                <div class="role">{{ $status }}</div>
            </div>

            <div class="separator"></div>

            <div class="right">
                <div class="qr-frame">
                    <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
                </div>
                <div class="qr-label">Scan untuk verifikasi</div>
            </div>
        </div>

        <div class="accent-bottom"></div>
    </div>
</body>

</html>
