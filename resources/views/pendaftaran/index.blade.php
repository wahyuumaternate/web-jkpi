{{-- resources/views/pendaftaran/create.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi JKPI — Rakernas XII JKPI 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('logo_kota.png') }}" rel="icon">
    <link href="{{ asset('logo_kota.png') }}" rel="apple-touch-icon">

    {{-- Tipografi: Fraunces untuk judul (serif berkarakter), Plus Jakarta Sans untuk body --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            /* Palette: teal pusaka + navy resmi + aksen tembaga heritage */
            --teal: #0a8a96;
            --teal-deep: #066872;
            --teal-soft: #e6f3f4;
            --teal-tint: #f0fafb;
            --navy: #0F2A4A;
            --navy-soft: #1c3a5e;
            --copper: #b8763c;
            --copper-soft: #f5ebe0;

            --ink: #0e1726;
            --ink-soft: #3b4a60;
            --muted: #6b7280;
            --line: #e3e7ec;
            --line-strong: #cfd5dd;

            --bg: #f4f1ec;
            --bg-warm: #faf7f2;
            --card: #ffffff;

            --shadow-sm: 0 1px 2px rgba(15, 42, 74, 0.04), 0 1px 3px rgba(15, 42, 74, 0.06);
            --shadow-md: 0 4px 10px rgba(15, 42, 74, 0.05), 0 12px 32px rgba(15, 42, 74, 0.08);
            --shadow-lg: 0 8px 24px rgba(15, 42, 74, 0.08), 0 24px 56px rgba(15, 42, 74, 0.10);

            --radius: 14px;
            --radius-sm: 10px;
            --radius-lg: 20px;
        }

        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        html,
        body {
            background: var(--bg);
            color: var(--ink);
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            font-feature-settings: "ss01", "cv11";
        }

        body {
            background:
                radial-gradient(1100px 480px at 50% -120px, rgba(10, 138, 150, 0.10), transparent 60%),
                radial-gradient(900px 420px at 90% -80px, rgba(184, 118, 60, 0.08), transparent 60%),
                var(--bg);
            min-height: 100vh;
            padding: 0;
        }

        /* ===========================
           HERO HEADER
           =========================== */
        .hero {
            position: relative;
            background: linear-gradient(135deg, #0a2a3c 0%, #0d4f5e 40%, #099aa7 100%);
            color: #fff;
            overflow: hidden;
            padding: 56px 0 90px;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(45deg, rgba(255, 255, 255, 0.04) 0 1px, transparent 1px 18px),
                repeating-linear-gradient(-45deg, rgba(255, 255, 255, 0.03) 0 1px, transparent 1px 18px);
            opacity: 0.9;
            pointer-events: none;
        }

        .hero::after {
            content: "";
            position: absolute;
            right: -120px;
            top: -120px;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: radial-gradient(closest-side, rgba(184, 118, 60, 0.35), transparent 70%);
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            z-index: 2;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px 6px 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(6px);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #f0e6d8;
        }

        .hero-eyebrow .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--copper);
            box-shadow: 0 0 0 4px rgba(184, 118, 60, 0.25);
        }

        .hero h1 {
            font-family: 'Fraunces', Georgia, serif;
            font-weight: 600;
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1.08;
            letter-spacing: -0.015em;
            margin: 18px 0 10px;
        }

        .hero h1 em {
            font-style: italic;
            color: #f0d9bd;
            font-weight: 500;
        }

        .hero p.lead {
            font-size: 1.02rem;
            max-width: 620px;
            color: rgba(255, 255, 255, 0.78);
            margin-bottom: 0;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 22px 32px;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }

        .hero-meta div {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.82);
            font-size: 0.92rem;
        }

        .hero-meta i {
            color: var(--copper);
            font-size: 1.1rem;
        }

        .btn-back {
            position: absolute;
            top: 28px;
            right: 28px;
            z-index: 3;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            background: rgba(255, 255, 255, 0.06);
            color: #fff;
            padding: 9px 18px;
            border-radius: 999px;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            backdrop-filter: blur(8px);
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.14);
            border-color: rgba(255, 255, 255, 0.4);
            color: #fff;
            transform: translateY(-1px);
        }

        /* ===========================
           CARD UTAMA
           =========================== */
        .page-wrap {
            margin-top: -56px;
            padding-bottom: 80px;
            position: relative;
            z-index: 4;
        }

        .registration-card {
            background: var(--card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            padding: 44px clamp(24px, 4vw, 56px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        /* ===========================
           SECTION TITLES
           =========================== */
        .form-section-title {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--navy);
            letter-spacing: -0.01em;
            margin: 40px 0 22px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .form-section-title:first-of-type {
            margin-top: 8px;
        }

        .form-section-title .icon-badge {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--teal-soft), #d4ecee);
            color: var(--teal-deep);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            flex-shrink: 0;
            box-shadow: inset 0 0 0 1px rgba(10, 138, 150, 0.15);
        }

        .form-section-title small {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--muted);
            letter-spacing: 0;
        }

        /* ===========================
           FORM INPUTS
           =========================== */
        .form-label {
            font-weight: 600;
            color: var(--ink);
            font-size: 0.88rem;
            margin-bottom: 7px;
            letter-spacing: -0.005em;
        }

        .required {
            color: #d64545;
            margin-left: 3px;
        }

        .form-control,
        .form-select {
            border: 1.5px solid var(--line);
            border-radius: var(--radius-sm);
            padding: 12px 14px;
            font-size: 0.94rem;
            font-family: inherit;
            background: #fff;
            color: var(--ink);
            transition: border-color 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .form-control::placeholder {
            color: #9aa3af;
        }

        .form-control:hover,
        .form-select:hover {
            border-color: var(--line-strong);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 4px rgba(10, 138, 150, 0.12);
            background: #fff;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background: #f7f5f1;
            color: var(--ink-soft);
            cursor: not-allowed;
        }

        .field-help {
            font-size: 0.8rem;
            color: var(--muted);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .field-help i {
            color: var(--copper);
            font-size: 0.9rem;
        }

        /* ===========================
           EVENT (KEGIATAN) PICKER
           =========================== */
        .event-summary-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 14px 18px;
            background: linear-gradient(180deg, var(--teal-tint), #fff);
            border: 1px solid var(--teal-soft);
            border-radius: var(--radius);
            margin-bottom: 14px;
        }

        .event-count-label {
            font-size: 0.92rem;
            color: var(--navy);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .event-count-badge {
            background: var(--navy);
            color: #fff;
            padding: 3px 12px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
            min-width: 32px;
            text-align: center;
            font-variant-numeric: tabular-nums;
        }

        .select-all-btn {
            background: #fff;
            border: 1.5px solid var(--line);
            color: var(--navy);
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .select-all-btn:hover {
            background: var(--teal);
            border-color: var(--teal);
            color: #fff;
        }

        .events-list-wrap {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        @media (min-width: 768px) {
            .events-list-wrap {
                grid-template-columns: 1fr 1fr;
            }
        }

        .event-check-item {
            position: relative;
            display: flex;
            gap: 14px;
            align-items: flex-start;
            padding: 16px 18px;
            border-radius: var(--radius);
            cursor: pointer;
            border: 1.5px solid var(--line);
            background: #fff;
            transition: all 0.2s ease;
            margin: 0;
        }

        .event-check-item:hover {
            border-color: var(--teal);
            background: var(--teal-tint);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .event-check-item.selected {
            background: linear-gradient(180deg, var(--teal-soft), #fff);
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(10, 138, 150, 0.12);
        }

        .event-check-item input[type="checkbox"] {
            margin: 4px 0 0 0;
            width: 18px;
            height: 18px;
            accent-color: var(--teal);
            flex-shrink: 0;
            cursor: pointer;
        }

        .event-check-content {
            flex: 1;
            min-width: 0;
        }

        .event-date-chip {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 999px;
            margin-bottom: 8px;
        }

        .chip-pre {
            background: var(--copper-soft);
            color: var(--copper);
            border: 1px solid rgba(184, 118, 60, 0.2);
        }

        .chip-d1 {
            background: var(--copper-soft);
            color: var(--copper);
            border: 1px solid rgba(184, 118, 60, 0.2);
        }

        .chip-d2 {
            background: var(--teal-soft);
            color: var(--teal-deep);
            border: 1px solid rgba(10, 138, 150, 0.2);
        }

        .chip-d3 {
            background: var(--teal-soft);
            color: var(--teal-deep);
            border: 1px solid rgba(10, 138, 150, 0.2);
        }

        .chip-d4 {
            background: #fff3e0;
            color: #e65100;
            border: 1px solid rgba(230, 81, 0, 0.2);
        }

        .chip-d5 {
            background: #fce4ec;
            color: #c2185b;
            border: 1px solid rgba(194, 24, 91, 0.2);
        }

        .event-check-title {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 1.08rem;
            font-weight: 600;
            color: var(--navy);
            line-height: 1.25;
            margin-bottom: 4px;
        }

        .event-check-meta {
            font-size: 0.84rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .event-check-meta i {
            color: var(--teal);
        }

        /* ===========================
           NARAHUBUNG
           =========================== */
        .narahubung-card {
            background: linear-gradient(180deg, #fbfaf7, #fff);
            border: 1.5px solid var(--line);
            border-radius: var(--radius);
            padding: 22px;
            margin-bottom: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .narahubung-card:hover {
            border-color: var(--line-strong);
            box-shadow: var(--shadow-sm);
        }

        .narahubung-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .narahubung-card-title {
            font-family: 'Fraunces', Georgia, serif;
            font-weight: 600;
            color: var(--navy);
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .narahubung-number-badge {
            background: var(--navy);
            color: #fff;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
        }

        .btn-remove-narahubung {
            background: transparent;
            border: 1.5px solid #e6c5c5;
            color: #b53d3d;
            padding: 5px 13px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-remove-narahubung:hover:not(:disabled) {
            background: #b53d3d;
            border-color: #b53d3d;
            color: #fff;
        }

        .btn-remove-narahubung:disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }

        .btn-add-narahubung {
            background: transparent;
            border: 1.5px dashed var(--teal);
            color: var(--teal-deep);
            padding: 14px 20px;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            width: 100%;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-add-narahubung:hover {
            background: var(--teal-tint);
            border-style: solid;
            border-color: var(--teal);
        }

        /* ===========================
           SUBMIT
           =========================== */
        .form-footer {
            margin-top: 40px;
            padding-top: 28px;
            border-top: 1px solid var(--line);
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .form-footer-note {
            font-size: 0.85rem;
            color: var(--muted);
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .form-footer-note i {
            color: var(--copper);
            margin-top: 2px;
        }

        .btn-submit {
            background: var(--navy);
            background-image: linear-gradient(135deg, var(--navy) 0%, var(--navy-soft) 100%);
            color: #fff;
            padding: 16px 40px;
            border: none;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.01em;
            transition: all 0.2s;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 6px 20px rgba(15, 42, 74, 0.25);
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 28px rgba(15, 42, 74, 0.32);
            color: #fff;
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* ===========================
           ALERTS
           =========================== */
        .alert {
            border-radius: var(--radius-sm);
            border: none;
            font-size: 0.93rem;
        }

        .alert-success {
            background: #e8f6ee;
            color: #1e6b3e;
        }

        .alert-danger {
            background: #fdecec;
            color: #9b2a2a;
        }

        .alert-info {
            background: var(--teal-tint);
            color: var(--teal-deep);
        }

        /* ===========================
           RESPONSIVE
           =========================== */
        @media (max-width: 576px) {
            .hero {
                padding: 48px 0 80px;
            }

            .btn-back {
                top: 18px;
                right: 18px;
                padding: 7px 14px;
                font-size: 0.85rem;
            }

            .registration-card {
                padding: 28px 22px;
                border-radius: var(--radius);
            }

            .form-section-title {
                font-size: 1.15rem;
            }

            .hero-meta {
                gap: 14px 22px;
            }
        }
    </style>
</head>

<body>

    {{-- ===== HERO HEADER ===== --}}
    <header class="hero">
        <a href="{{ url('/') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="container hero-inner" style="max-width: 1100px;">
            <span class="hero-eyebrow">
                <span class="dot"></span>
                Rakernas XII JKPI · Ternate 2026
            </span>

            <h1>Registrasi <em>Peserta</em><br>Jaringan Kota Pusaka Indonesia</h1>
            <p class="lead">
                Lengkapi data berikut sesuai format registrasi resmi. Seluruh informasi
                yang Bapak/Ibu kirimkan akan dirahasiakan dan digunakan khusus untuk
                penyelenggaraan acara.
            </p>

            <div class="hero-meta">
                <div><i class="bi bi-calendar-event"></i> 25 – 30 Agustus 2026</div>
                <div><i class="bi bi-geo-alt"></i> Kota Ternate, Maluku Utara</div>
                <div><i class="bi bi-shield-check"></i> Data terenkripsi</div>
            </div>
        </div>
    </header>

    {{-- ===== FORM CARD ===== --}}
    <div class="page-wrap">
        <div class="container" style="max-width: 1100px;">
            <div class="registration-card">

                {{-- ===== FLASH MESSAGES ===== --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-info-circle-fill me-2"></i>{{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <div class="fw-bold mb-1">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>Mohon periksa kembali isian berikut:
                        </div>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- ===== FORM ===== --}}
                <form id="registrationForm" method="POST" action="{{ route('pendaftaran.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- ============ DATA UTAMA ============ --}}
                    <h3 class="form-section-title">
                        <span class="icon-badge"><i class="bi bi-person-vcard"></i></span>
                        Data Kepala Daerah
                    </h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Jumlah Rombongan <span class="required">*</span>
                            </label>
                            <input type="number" min="1" class="form-control" name="jumlah_rombongan"
                                value="{{ old('jumlah_rombongan', 1) }}" required>
                            <span class="field-help">
                                <i class="bi bi-people"></i>
                                Termasuk kepala daerah, pasangan, ajudan, OPD dan tim pendamping.
                            </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_daerah">
                                Nama Daerah <span class="required">*</span>
                            </label>
                            <select class="form-select" id="nama_daerah" name="nama_daerah" required>
                                <option value="">Pilih Daerah</option>
                                <optgroup label="Anggota JKPI">
                                    @php
                                        $daerahList = [
                                            'Kota Ambon',
                                            'Kota Banda Aceh',
                                            'Kota Bengkulu',
                                            'Kota Bukittinggi',
                                            'Kota Baubau',
                                            'Kota Blitar',
                                            'Kota Banjarmasin',
                                            'Kota Bontang',
                                            'Kota Bogor',
                                            'Kab. Bangka Barat',
                                            'Kab. Bangli',
                                            'Kab. Buleleng',
                                            'Kab. Brebes',
                                            'Kab. Banjar Negara',
                                            'Kab. Banyumas',
                                            'Kab. Batang',
                                            'Kota Cirebon',
                                            'Kab. Cilacap',
                                            'Kota Jakarta Pusat',
                                            'Kota Lubuk Linggau',
                                            'Kota Langsa',
                                            'Kab. Kepulauan Seribu',
                                            'Kab. Karang Asem',
                                            'Kota Medan',
                                            'Kota Madiun',
                                            'Kota Malang',
                                            'Kota Palembang',
                                            'Kota Pangkal Pinang',
                                            'Kota Pekalongan',
                                            'Kota Padang',
                                            'Kota Palopo',
                                            'Kota Pontianak',
                                            'Kab. Purbalingga',
                                            'Kota Sawahlunto',
                                            'Kota Semarang',
                                            'Kota Surakarta',
                                            'Kota Ternate',
                                            'Kota Tegal',
                                            'Kab. Tegal',
                                            'Kota Yogyakarta',
                                            'Kota Sungai Penuh',
                                            'Kab. Ngawi',
                                            'Kota Tidore',
                                            'Kota Tangerang',
                                            'Kota Kupang',
                                            'Kab. Temanggung',
                                            'Kota Sabang',
                                            'Kab. Halmahera Barat',
                                            'Kab. Siak',
                                            'Kab. Pesawaran',
                                            'Kota Probolinggo',
                                            'Kab. Buton Utara',
                                            'Kab. Kutai Kartanegara',
                                            'Kab. Muna',
                                            'Kota Denpasar',
                                            'Kota Sibolga',
                                            'Kab. Sambas',
                                            'Kab. Gianyar',
                                            'Kota Jakarta Barat',
                                            'Kota Jakarta Utara',
                                            'Kota Salatiga',
                                            'Kota Surabaya',
                                            'Kota Singkawang',
                                            'Kab. Sumbawa',
                                            'Kab. Belitung Timur',
                                            'Kota Pasuruan',
                                            'Kab. Sumba Timur',
                                            'Kab. Flores Timur',
                                            'Kab. Sumenep',
                                            'Kab. Nias Selatan',
                                            'Kab. Jepara',
                                            'Kab. Buton Selatan',
                                            'Kab. Ende',
                                            'Kota Kediri',
                                            'Kota Bandung',
                                            'Kab. Sleman',
                                            'Kab. Pulang Pisau',
                                            'Kota Magelang',
                                            'Kab. Lombok Utara',
                                        ];
                                        sort($daerahList);
                                    @endphp
                                    @foreach ($daerahList as $daerah)
                                        <option value="{{ $daerah }}"
                                            {{ old('nama_daerah', 'Kota Ternate') == $daerah ? 'selected' : '' }}>
                                            {{ $daerah }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_kepala_daerah">
                                Nama Lengkap Kepala Daerah <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama_kepala_daerah" name="nama_kepala_daerah"
                                value="{{ old('nama_kepala_daerah') }}" placeholder="Lengkap dengan gelar" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_pasangan_kepala_daerah">
                                Nama Lengkap Pasangan Kepala Daerah
                            </label>
                            {{-- Nama Pasangan --}}
                            <input type="text" class="form-control" id="nama_pasangan_kepala_daerah"
                                name="nama_pasangan_kepala_daerah" value="{{ old('nama_pasangan_kepala_daerah') }}"
                                placeholder="Opsional, kosongkan jika tidak hadir" oninput="toggleUkuranPasangan()">
                        </div>
                    </div>

                    {{-- ============ INFORMASI TAMBAHAN ============
                    <h3 class="form-section-title">
                        <span class="icon-badge"><i class="bi bi-card-checklist"></i></span>
                        Informasi Tambahan
                    </h3> --}}

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Ukuran Baju Kepala Daerah <span class="required">*</span>
                            </label>
                            <select class="form-select" name="ukuran_baju" required>
                                <option value="">Pilih Ukuran</option>
                                @foreach (['S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $ukuran)
                                    <option value="{{ $ukuran }}"
                                        {{ old('ukuran_baju') == $ukuran ? 'selected' : '' }}>
                                        {{ $ukuran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            {{-- Label ukuran baju pasangan, ubah jadi dinamis --}}
                            <label class="form-label" id="label_ukuran_pasangan">
                                Ukuran Baju Pasangan Kepala Daerah
                                <span class="required" id="required_ukuran_pasangan" style="display:none">*</span>
                            </label>
                            {{-- Ukuran Baju Pasangan --}}
                            <select class="form-select" name="ukuran_baju_pasangan" id="ukuran_baju_pasangan">
                                <option value="">Pilih Ukuran</option>
                                @foreach (['S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $ukuran)
                                    <option value="{{ $ukuran }}"
                                        {{ old('ukuran_baju_pasangan') == $ukuran ? 'selected' : '' }}>
                                        {{ $ukuran }}
                                    </option>
                                @endforeach
                            </select>


                        </div>

                    </div>

                    {{-- ============ KEGIATAN ============ --}}
                    <h3 class="form-section-title">
                        <span class="icon-badge"><i class="bi bi-calendar2-check"></i></span>
                        Kegiatan yang Akan Diikuti
                        <small>· Pilih satu atau lebih</small>
                    </h3>

                    <div class="event-summary-bar">
                        <div class="event-count-label">
                            Kegiatan dipilih
                            <span class="event-count-badge" id="eventCountBadge">0</span>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="select-all-btn" onclick="selectAllEvents()">
                                <i class="bi bi-check2-all"></i> Pilih Semua
                            </button>
                            <button type="button" class="select-all-btn" onclick="clearAllEvents()"
                                style="border-color:#e6c5c5;color:#b53d3d">
                                <i class="bi bi-x-lg"></i> Bersihkan
                            </button>
                        </div>
                    </div>

                    <div class="events-list-wrap">
                        {{-- Pre Event --}}
                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]" value="Welcome Dinner"
                                onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-pre">25 AGUSTUS</span>
                                <div class="event-check-title">Welcome Dinner</div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Pendopo Kediaman Wali Kota Ternate
                                </div>
                            </div>
                        </label>

                        {{-- 26 Agustus --}}
                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]" value="Master Class"
                                onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-d1">26 AGUSTUS</span>
                                <div class="event-check-title">Master Class</div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Berbagai Titik Cagar Budaya
                                </div>
                            </div>
                        </label>

                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]" value="Heritage City Tour"
                                onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-d1">26 AGUSTUS</span>
                                <div class="event-check-title">Heritage City Tour</div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Kadaton Kesultanan & Cagar Budaya
                                </div>
                            </div>
                        </label>

                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]" value="Ladies Program"
                                onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-d1">26 AGUSTUS</span>
                                <div class="event-check-title">Ladies Program</div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Benteng Oranje & Pusat Kreatif
                                </div>
                            </div>
                        </label>

                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]" value="Expo UMKM" onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-d1">26–29 AGUSTUS</span>
                                <div class="event-check-title">Expo UMKM (4 Hari)</div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                </div>
                            </div>
                        </label>

                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]" value="Pentas Budaya"
                                onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-d1">26–29 AGUSTUS</span>
                                <div class="event-check-title">Pentas Budaya (4 Hari)</div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                </div>
                            </div>
                        </label>

                        {{-- 27 Agustus --}}
                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]"
                                value="Simposium Internasional - Pulau-Pulau Penghasil Rempah"
                                onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-d2">27 AGUSTUS</span>
                                <div class="event-check-title">
                                    Simposium Internasional - Pulau-Pulau Penghasil Rempah
                                </div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Bela Hotel
                                </div>
                            </div>
                        </label>

                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]" value="Festival Gastronomi"
                                onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-d2">27–28 AGUSTUS</span>
                                <div class="event-check-title">Festival Gastronomi</div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                </div>
                            </div>
                        </label>

                        {{-- 28 Agustus --}}
                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]" value="Rapat Kerja Nasional"
                                onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-d3">28 AGUSTUS</span>
                                <div class="event-check-title">Rapat Kerja Nasional</div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Bela Hotel
                                </div>
                            </div>
                        </label>

                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]" value="Gelar Budaya dan Penyerahan Pataka"
                                onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-d3">28 AGUSTUS</span>
                                <div class="event-check-title">Gelar Budaya & Penyerahan Pataka</div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Landmark Ternate
                                </div>
                            </div>
                        </label>

                        {{-- 29 Agustus --}}
                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]" value="Pawai Budaya dan Karnaval"
                                onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-d4">29 AGUSTUS</span>
                                <div class="event-check-title">Pawai Budaya dan Karnaval</div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Benteng Oranje – Lapangan Salero
                                </div>
                            </div>
                        </label>

                        {{-- 30 Agustus --}}
                        <label class="event-check-item">
                            <input type="checkbox" name="kegiatan[]" value="Nusantara Raya Run"
                                onchange="onEventChange()">
                            <div class="event-check-content">
                                <span class="event-date-chip chip-d5">30 AGUSTUS</span>
                                <div class="event-check-title">Nusantara Raya Run</div>
                                <div class="event-check-meta">
                                    <i class="bi bi-geo-alt-fill"></i> Fort to Fort
                                </div>
                            </div>
                        </label>
                    </div>

                    {{-- ============ PERJALANAN ============ --}}
                    <h3 class="form-section-title">
                        <span class="icon-badge"><i class="bi bi-airplane"></i></span>
                        Informasi Perjalanan
                    </h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nomor_plat">
                                Nomor Plat Kendaraan Kepala Daerah
                            </label>
                            <input type="text" class="form-control" id="nomor_plat" name="nomor_plat"
                                value="{{ old('nomor_plat') }}" placeholder="Contoh: B 1 ABC">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="info_kedatangan">
                                Info Kedatangan Kepala Daerah <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control" id="info_kedatangan" name="info_kedatangan"
                                value="{{ old('info_kedatangan') }}"
                                placeholder="Contoh: 26 Agustus 2026, GA-602, 10:30 WIT" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="info_kepulangan">
                            Info Kepulangan Kepala Daerah <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control" id="info_kepulangan" name="info_kepulangan"
                            value="{{ old('info_kepulangan') }}"
                            placeholder="Contoh: 30 Agustus 2026, GA-603, 14:15 WIT" required>
                    </div>

                    {{-- ============ AJUDAN ============ --}}
                    <h3 class="form-section-title">
                        <span class="icon-badge"><i class="bi bi-person-badge"></i></span>
                        Data Ajudan / ADC
                    </h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_ajudan">Nama Ajudan/ADC</label>
                            <input type="text" class="form-control" id="nama_ajudan" name="nama_ajudan"
                                value="{{ old('nama_ajudan') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="telepon_ajudan">Nomor Telepon Ajudan/ADC</label>
                            <input type="text" class="form-control" id="telepon_ajudan" name="telepon_ajudan"
                                value="{{ old('telepon_ajudan') }}" placeholder="08xxxxxxxxxx">
                        </div>
                    </div>

                    {{-- ============ NARAHUBUNG ============ --}}
                    <h3 class="form-section-title">
                        <span class="icon-badge"><i class="bi bi-people"></i></span>
                        Data Narahubung
                        <small>· Bisa lebih dari satu</small>
                    </h3>

                    <div id="narahubungContainer">
                        @php $oldNarahubung = old('narahubung', [[]]); @endphp

                        @foreach ($oldNarahubung as $index => $nh)
                            <div class="narahubung-card" data-index="{{ $index }}">
                                <div class="narahubung-card-header">
                                    <div class="narahubung-card-title">
                                        <span class="narahubung-number-badge nh-number">{{ $index + 1 }}</span>
                                        Narahubung
                                    </div>
                                    <button type="button" class="btn-remove-narahubung"
                                        onclick="removeNarahubung(this)"
                                        {{ count($oldNarahubung) <= 1 ? 'disabled' : '' }}>
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Nama Narahubung <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        name="narahubung[{{ $index }}][nama]" value="{{ $nh['nama'] ?? '' }}"
                                        required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Nomor Telepon <span class="required">*</span>
                                        </label>
                                        <input type="text" class="form-control nh-telepon"
                                            name="narahubung[{{ $index }}][telepon]"
                                            value="{{ $nh['telepon'] ?? '' }}" placeholder="08xxxxxxxxxx" required>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <label class="form-label">
                                            Email <span class="required">*</span>
                                        </label>
                                        <input type="email" class="form-control"
                                            name="narahubung[{{ $index }}][email]"
                                            value="{{ $nh['email'] ?? '' }}" placeholder="email@domain.com" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn-add-narahubung mb-4" onclick="addNarahubung()">
                        <i class="bi bi-plus-circle"></i> Tambah Narahubung
                    </button>

                    {{-- ============ FOOTER & SUBMIT ============ --}}
                    <div class="form-footer">
                        <div class="form-footer-note">
                            <i class="bi bi-shield-lock-fill"></i>
                            <span>
                                Dengan menekan tombol di bawah, Anda menyatakan bahwa seluruh data
                                yang diisi adalah benar dan dapat dipertanggungjawabkan.
                            </span>
                        </div>
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-send-check"></i> Simpan Data Registrasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== TEMPLATE NARAHUBUNG (untuk JS) ===== --}}
    <template id="narahubungTemplate">
        <div class="narahubung-card" data-index="__INDEX__">
            <div class="narahubung-card-header">
                <div class="narahubung-card-title">
                    <span class="narahubung-number-badge nh-number">__NUMBER__</span>
                    Narahubung
                </div>
                <button type="button" class="btn-remove-narahubung" onclick="removeNarahubung(this)">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Narahubung <span class="required">*</span></label>
                <input type="text" class="form-control" name="narahubung[__INDEX__][nama]" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor Telepon <span class="required">*</span></label>
                    <input type="text" class="form-control nh-telepon" name="narahubung[__INDEX__][telepon]"
                        placeholder="08xxxxxxxxxx" required>
                </div>
                <div class="col-md-6 mb-0">
                    <label class="form-label">Email <span class="required">*</span></label>
                    <input type="email" class="form-control" name="narahubung[__INDEX__][email]"
                        placeholder="email@domain.com" required>
                </div>
            </div>
        </div>
    </template>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ===== TIMESTAMP =====
        function updateTimestamp() {
            const el = document.getElementById('timestamp');
            if (!el) return;
            const d = new Date();
            const pad = n => String(n).padStart(2, '0');
            el.value =
                `${pad(d.getDate())}/${pad(d.getMonth()+1)}/${d.getFullYear()}, ${pad(d.getHours())}.${pad(d.getMinutes())}`;
        }
        updateTimestamp();
        setInterval(updateTimestamp, 30000);

        // ===== NARAHUBUNG DYNAMIC =====
        function getNarahubungCount() {
            return document.querySelectorAll('#narahubungContainer .narahubung-card').length;
        }

        function renumberNarahubung() {
            const cards = document.querySelectorAll('#narahubungContainer .narahubung-card');
            cards.forEach((card, idx) => {
                card.setAttribute('data-index', idx);
                card.querySelector('.nh-number').textContent = idx + 1;
                card.querySelectorAll('[name^="narahubung["]').forEach(input => {
                    const name = input.getAttribute('name');
                    const newName = name.replace(/narahubung\[\d+\]/, `narahubung[${idx}]`);
                    input.setAttribute('name', newName);
                });
            });
            document.querySelectorAll('.btn-remove-narahubung').forEach(btn => {
                btn.disabled = cards.length <= 1;
            });
        }

        function addNarahubung() {
            const container = document.getElementById('narahubungContainer');
            const template = document.getElementById('narahubungTemplate');
            const newIndex = getNarahubungCount();
            const html = template.innerHTML
                .replace(/__INDEX__/g, newIndex)
                .replace(/__NUMBER__/g, newIndex + 1);
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html.trim();
            const newCard = wrapper.firstChild;
            container.appendChild(newCard);
            renumberNarahubung();
            attachPhoneFilter(newCard);
            newCard.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function removeNarahubung(btn) {
            const cards = document.querySelectorAll('#narahubungContainer .narahubung-card');
            if (cards.length <= 1) return;
            const card = btn.closest('.narahubung-card');
            if (confirm('Hapus narahubung ini?')) {
                card.remove();
                renumberNarahubung();
            }
        }

        // ===== PHONE NUMBER FILTER =====
        function attachPhoneFilter(scope = document) {
            const phoneInputs = scope.querySelectorAll('#telepon_ajudan, .nh-telepon');
            phoneInputs.forEach(el => {
                if (el.dataset.phoneFilter) return;
                el.dataset.phoneFilter = '1';
                el.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9+]/g, '');
                });
            });
        }
        attachPhoneFilter();
        renumberNarahubung();

        // ===== EVENT PICKER =====
        function onEventChange() {
            let total = 0;
            document.querySelectorAll('input[name="kegiatan[]"]').forEach(cb => {
                const item = cb.closest('.event-check-item');
                if (cb.checked) {
                    total++;
                    item.classList.add('selected');
                } else {
                    item.classList.remove('selected');
                }
            });
            document.getElementById('eventCountBadge').innerText = total;
        }

        function selectAllEvents() {
            document.querySelectorAll('input[name="kegiatan[]"]').forEach(cb => cb.checked = true);
            onEventChange();
        }

        function clearAllEvents() {
            document.querySelectorAll('input[name="kegiatan[]"]').forEach(cb => cb.checked = false);
            onEventChange();
        }

        // initial state
        onEventChange();
    </script>
    <script>
        function toggleUkuranPasangan() {
            const namaPasangan = document.getElementById('nama_pasangan_kepala_daerah').value.trim();
            const selectUkuran = document.getElementById('ukuran_baju_pasangan');
            const requiredMark = document.getElementById('required_ukuran_pasangan');

            if (namaPasangan !== '') {
                selectUkuran.required = true;
                requiredMark.style.display = 'inline';
            } else {
                selectUkuran.required = false;
                selectUkuran.value = '';
                requiredMark.style.display = 'none';
            }
        }

        // Jalankan saat halaman load (untuk handle old() value setelah validasi gagal)
        document.addEventListener('DOMContentLoaded', toggleUkuranPasangan);
    </script>
</body>

</html>
