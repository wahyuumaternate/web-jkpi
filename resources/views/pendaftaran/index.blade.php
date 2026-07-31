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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700;9..144,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
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
            --shadow-sm: 0 1px 2px rgba(15, 42, 74, .04), 0 1px 3px rgba(15, 42, 74, .06);
            --shadow-md: 0 4px 10px rgba(15, 42, 74, .05), 0 12px 32px rgba(15, 42, 74, .08);
            --shadow-lg: 0 8px 24px rgba(15, 42, 74, .08), 0 24px 56px rgba(15, 42, 74, .10);
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
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            font-feature-settings: "ss01", "cv11";
        }

        body {
            background:
                radial-gradient(1100px 480px at 50% -120px, rgba(10, 138, 150, .10), transparent 60%),
                radial-gradient(900px 420px at 90% -80px, rgba(184, 118, 60, .08), transparent 60%),
                var(--bg);
            min-height: 100vh;
        }

        /* ── HERO ────────────────────────── */
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
                repeating-linear-gradient(45deg, rgba(255, 255, 255, .04) 0 1px, transparent 1px 18px),
                repeating-linear-gradient(-45deg, rgba(255, 255, 255, .03) 0 1px, transparent 1px 18px);
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
            background: radial-gradient(closest-side, rgba(184, 118, 60, .35), transparent 70%);
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
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .18);
            backdrop-filter: blur(6px);
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #f0e6d8;
        }

        .hero-eyebrow .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--copper);
            box-shadow: 0 0 0 4px rgba(184, 118, 60, .25);
        }

        .hero h1 {
            font-family: 'Fraunces', Georgia, serif;
            font-weight: 600;
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1.08;
            letter-spacing: -.015em;
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
            color: rgba(255, 255, 255, .78);
            margin-bottom: 0;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 22px 32px;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid rgba(255, 255, 255, .12);
        }

        .hero-meta div {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, .82);
            font-size: .92rem;
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
            border: 1px solid rgba(255, 255, 255, .25);
            background: rgba(255, 255, 255, .06);
            color: #fff;
            padding: 9px 18px;
            border-radius: 999px;
            font-weight: 500;
            font-size: .9rem;
            text-decoration: none;
            backdrop-filter: blur(8px);
            transition: all .2s ease;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, .14);
            border-color: rgba(255, 255, 255, .4);
            color: #fff;
            transform: translateY(-1px);
        }

        /* ── PAGE WRAP ───────────────────── */
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
            border: 1px solid rgba(255, 255, 255, .6);
        }

        /* ── ALERTS ──────────────────────── */
        .alert {
            border-radius: var(--radius-sm);
            border: none;
            font-size: .93rem;
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

        /* ────────────────────────────────────
           PENDAFTARAN DITUTUP
           ──────────────────────────────────── */
        .closed-wrap {
            text-align: center;
            padding: 12px 0 6px;
        }

        .closed-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--copper-soft), #fff);
            border: 1.5px solid rgba(184, 118, 60, .25);
            color: var(--copper);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 22px;
        }

        .closed-title {
            font-family: 'Fraunces', Georgia, serif;
            font-weight: 600;
            font-size: clamp(1.5rem, 3vw, 1.9rem);
            color: var(--navy);
            letter-spacing: -.01em;
            margin-bottom: 12px;
        }

        .closed-desc {
            color: var(--ink-soft);
            font-size: 1rem;
            max-width: 560px;
            margin: 0 auto 34px;
            line-height: 1.6;
        }

        .closed-contact-label {
            font-size: .88rem;
            font-weight: 600;
            color: var(--ink-soft);
            margin-bottom: 14px;
        }

        .closed-contact-card {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            padding: 12px 20px 12px 12px;
            border-radius: 999px;
            border: 1.5px solid var(--line);
            background: #fff;
            text-decoration: none;
            margin: 0 auto 30px;
            transition: all .2s ease;
        }

        .closed-contact-card:hover {
            border-color: #25D366;
            box-shadow: var(--shadow-sm);
            transform: translateY(-1px);
        }

        .closed-contact-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal-soft), #d4ecee);
            color: var(--teal-deep);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .closed-contact-info {
            display: flex;
            flex-direction: column;
            text-align: left;
            line-height: 1.3;
        }

        .closed-contact-role {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .closed-contact-name {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 1rem;
            font-weight: 600;
            color: var(--navy);
        }

        .closed-contact-wa {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 999px;
            background: #25D366;
            color: #fff;
            font-weight: 700;
            font-size: .85rem;
            margin-left: 8px;
        }

        @media (max-width: 480px) {
            .closed-contact-card {
                flex-wrap: wrap;
                justify-content: center;
                text-align: center;
                padding: 16px 18px;
            }

            .closed-contact-info {
                text-align: center;
            }

            .closed-contact-wa {
                margin-left: 0;
            }
        }

        .closed-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            max-width: 560px;
            margin: 0 auto 26px;
        }

        .closed-divider::before,
        .closed-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--line);
        }

        .closed-divider span {
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--muted);
            white-space: nowrap;
        }

        .closed-events {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            max-width: 720px;
            margin: 0 auto;
            text-align: left;
        }

        @media (max-width: 700px) {
            .closed-events {
                grid-template-columns: 1fr;
            }
        }

        .closed-event-card {
            display: block;
            padding: 22px 22px 20px;
            border-radius: var(--radius);
            border: 1.5px solid var(--line);
            background: linear-gradient(180deg, var(--teal-tint), #fff);
            text-decoration: none;
            transition: all .2s ease;
        }

        .closed-event-card:hover {
            border-color: var(--teal);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .closed-event-chip {
            display: inline-block;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 999px;
            margin-bottom: 12px;
            background: var(--teal-soft);
            color: var(--teal-deep);
            border: 1px solid rgba(10, 138, 150, .2);
        }

        .closed-event-title {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 6px;
        }

        .closed-event-meta {
            font-size: .86rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 14px;
        }

        .closed-event-meta i {
            color: var(--teal);
        }

        .closed-event-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: .88rem;
            color: var(--teal-deep);
        }

        .closed-event-card:hover .closed-event-cta {
            color: var(--navy);
        }

        .closed-footer-note {
            margin-top: 34px;
            font-size: .85rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .closed-footer-note i {
            color: var(--copper);
        }

        /* ── RESPONSIVE ──────────────────── */
        @media (max-width: 576px) {
            .hero {
                padding: 48px 0 80px;
            }

            .btn-back {
                top: 18px;
                right: 18px;
                padding: 7px 14px;
                font-size: .85rem;
            }

            .registration-card {
                padding: 28px 20px;
                border-radius: var(--radius);
            }
        }
    </style>
</head>

<body>
    {{-- HERO --}}
    <header class="hero">
        <a href="{{ url('/') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <div class="container hero-inner" style="max-width:1100px;">
            <span class="hero-eyebrow"><span class="dot"></span> Rakernas XII JKPI · Ternate 2026</span>
            <h1>Registrasi <em>Peserta</em><br>Jaringan Kota Pusaka Indonesia</h1>
            <p class="lead">Lengkapi data berikut sesuai format registrasi resmi. Seluruh informasi yang Bapak/Ibu
                kirimkan akan dirahasiakan dan digunakan khusus untuk penyelenggaraan acara.</p>
            <div class="hero-meta">
                <div><i class="bi bi-calendar-event"></i> 26 – 30 Agustus 2026</div>
                <div><i class="bi bi-geo-alt"></i> Kota Ternate, Maluku Utara</div>
                <div><i class="bi bi-shield-check"></i> Data terenkripsi</div>
            </div>
        </div>
    </header>

    {{-- MAIN --}}
    <div class="page-wrap">
        <div class="container" style="max-width:1100px;">
            <div class="registration-card">

                {{-- ALERTS --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- PENDAFTARAN DITUTUP --}}
                <div class="closed-wrap">
                    <div class="closed-icon"><i class="bi bi-calendar-x-fill"></i></div>
                    <h2 class="closed-title">Pendaftaran Ditutup</h2>
                    <p class="closed-desc">
                        Mohon maaf, pendaftaran peserta Rakernas XII JKPI 2026 telah <strong>ditutup</strong>.
                        Terima kasih atas antusiasme Bapak/Ibu.
                    </p>

                    <p class="closed-contact-label">Untuk pertanyaan lebih lanjut, silakan hubungi:</p>

                    <a class="closed-contact-card" href="https://wa.me/6282290056150" target="_blank" rel="noopener">
                        <span class="closed-contact-avatar"><i class="bi bi-person-fill"></i></span>
                        <span class="closed-contact-info">
                            <span class="closed-contact-role">Sekretaris</span>
                            <span class="closed-contact-name">Ronny Aries</span>
                        </span>
                        <span class="closed-contact-wa"><i class="bi bi-whatsapp"></i> 082290056150</span>
                    </a>

                    <div class="closed-divider"><span>Masih dibuka</span></div>

                    <div class="closed-events">
                        <a class="closed-event-card"
                            href="https://docs.google.com/forms/d/e/1FAIpQLSeqhlkZeeFmfHzcURAkbeDaXBC70Mhp5S9JRPIG3ZTlElLEFg/viewform"
                            target="_blank" rel="noopener">
                            <span class="closed-event-chip">26 Agustus</span>
                            <div class="closed-event-title">Master Class</div>
                            <div class="closed-event-meta"><i class="bi bi-geo-alt-fill"></i> Berbagai Titik Cagar
                                Budaya</div>
                            <span class="closed-event-cta">Isi Formulir <i class="bi bi-arrow-up-right"></i></span>
                        </a>
                        <a class="closed-event-card"
                            href="https://docs.google.com/forms/d/e/1FAIpQLSf-cQrDYIoF8JoOY0oOwSoNwFrhvKg4bH4Pq1rYWB9iiQy5-g/viewform"
                            target="_blank" rel="noopener">
                            <span class="closed-event-chip">26–29 Agustus</span>
                            <div class="closed-event-title">Pentas Budaya (4 Hari)</div>
                            <div class="closed-event-meta"><i class="bi bi-geo-alt-fill"></i> Benteng Oranje</div>
                            <span class="closed-event-cta">Isi Formulir <i class="bi bi-arrow-up-right"></i></span>
                        </a>
                    </div>

                    <div class="closed-footer-note">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>Formulir di atas terpisah dari pendaftaran utama dan masih dapat diisi.</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
