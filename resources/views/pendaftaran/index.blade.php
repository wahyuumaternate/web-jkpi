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

        /* ────────────────────────────────────
           STEP INDICATOR
           ──────────────────────────────────── */
        .steps-wrap {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            margin-bottom: 36px;
            padding-bottom: 32px;
            border-bottom: 1px solid var(--line);
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 9px;
            flex: 0 0 auto;
        }

        .step-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 2px solid var(--line-strong);
            background: #fff;
            color: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .9rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all .3s ease;
            position: relative;
            z-index: 2;
        }

        .step-item.active .step-circle {
            background: var(--navy);
            border-color: var(--navy);
            color: #fff;
            box-shadow: 0 4px 16px rgba(15, 42, 74, .22);
            transform: scale(1.08);
        }

        .step-item.done .step-circle {
            background: var(--teal);
            border-color: var(--teal);
            color: #fff;
            transform: scale(1);
        }

        .step-label {
            font-size: .76rem;
            font-weight: 600;
            color: var(--muted);
            transition: color .3s ease;
            text-align: center;
            white-space: nowrap;
        }

        .step-item.active .step-label {
            color: var(--navy);
        }

        .step-item.done .step-label {
            color: var(--teal-deep);
        }

        .step-connector {
            flex: 1;
            height: 2px;
            background: var(--line);
            margin: 21px 14px 0;
            max-width: 160px;
            min-width: 48px;
            transition: background .4s ease;
            position: relative;
            z-index: 1;
        }

        .step-connector.done {
            background: var(--teal);
        }

        /* ── FORM SECTION TITLES ─────────── */
        .form-section-title {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--navy);
            letter-spacing: -.01em;
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
            box-shadow: inset 0 0 0 1px rgba(10, 138, 150, .15);
        }

        .form-section-title small {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: .78rem;
            font-weight: 500;
            color: var(--muted);
            letter-spacing: 0;
        }

        /* ── FORM INPUTS ─────────────────── */
        .form-label {
            font-weight: 600;
            color: var(--ink);
            font-size: .88rem;
            margin-bottom: 7px;
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
            font-size: .94rem;
            font-family: inherit;
            background: #fff;
            color: var(--ink);
            transition: border-color .18s ease, box-shadow .18s ease;
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
            box-shadow: 0 0 0 4px rgba(10, 138, 150, .12);
            background: #fff;
        }

        .field-help {
            font-size: .8rem;
            color: var(--muted);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .field-help i {
            color: var(--copper);
            font-size: .9rem;
        }

        /* ── EVENT PICKER ────────────────── */
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
            font-size: .92rem;
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
            font-size: .85rem;
            font-weight: 700;
        }

        .select-all-btn {
            background: #fff;
            border: 1.5px solid var(--line);
            color: var(--navy);
            padding: 6px 14px;
            border-radius: 999px;
            font-size: .82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
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
            transition: all .2s ease;
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
            box-shadow: 0 0 0 3px rgba(10, 138, 150, .12);
        }

        .event-check-item input[type="checkbox"] {
            margin: 4px 0 0;
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
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 999px;
            margin-bottom: 8px;
        }

        .chip-pre,
        .chip-d1 {
            background: var(--copper-soft);
            color: var(--copper);
            border: 1px solid rgba(184, 118, 60, .2);
        }

        .chip-d2 {
            background: var(--teal-soft);
            color: var(--teal-deep);
            border: 1px solid rgba(10, 138, 150, .2);
        }

        .chip-d3 {
            background: #e8fff8;
            color: #00796b;
            border: 1px solid rgba(0, 121, 107, .18);
        }

        .chip-d4 {
            background: #fff3e0;
            color: #e65100;
            border: 1px solid rgba(230, 81, 0, .2);
        }

        .chip-d5 {
            background: #fce4ec;
            color: #c2185b;
            border: 1px solid rgba(194, 24, 91, .2);
        }

        .chip-d6 {
            background: #f3e8ff;
            color: #6b21a8;
            border: 1px solid rgba(107, 33, 168, .18);
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
            font-size: .84rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .event-check-meta i {
            color: var(--teal);
        }

        /* ── NARAHUBUNG ──────────────────── */
        .narahubung-card {
            background: linear-gradient(180deg, #fbfaf7, #fff);
            border: 1.5px solid var(--line);
            border-radius: var(--radius);
            padding: 22px;
            margin-bottom: 14px;
            transition: border-color .2s, box-shadow .2s;
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
            font-size: .82rem;
            font-weight: 700;
        }

        .btn-remove-narahubung {
            background: transparent;
            border: 1.5px solid #e6c5c5;
            color: #b53d3d;
            padding: 5px 13px;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
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
            opacity: .35;
            cursor: not-allowed;
        }

        .btn-add-narahubung {
            background: transparent;
            border: 1.5px dashed var(--teal);
            color: var(--teal-deep);
            padding: 14px 20px;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: .95rem;
            cursor: pointer;
            width: 100%;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-add-narahubung:hover {
            background: var(--teal-tint);
            border-style: solid;
        }

        /* ── FORM FOOTER ─────────────────── */
        .form-footer {
            margin-top: 40px;
            padding-top: 28px;
            border-top: 1px solid var(--line);
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .form-footer-note {
            font-size: .85rem;
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
            transition: all .2s;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 6px 20px rgba(15, 42, 74, .25);
            cursor: pointer;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 28px rgba(15, 42, 74, .32);
            color: #fff;
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

        /* ── KEYFRAMES ───────────────────── */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #daerahLainnyaWrap {
            animation: fadeInUp .2s ease;
        }

        /* ────────────────────────────────────
           STEP TRANSITIONS
           ──────────────────────────────────── */
        @keyframes stepFwd {
            from {
                opacity: 0;
                transform: translateX(28px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes stepBack {
            from {
                opacity: 0;
                transform: translateX(-28px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .anim-fwd {
            animation: stepFwd .32s ease forwards;
        }

        .anim-back {
            animation: stepBack .32s ease forwards;
        }

        /* ────────────────────────────────────
           PREVIEW STEP
           ──────────────────────────────────── */
        .pv-header {
            background: linear-gradient(180deg, var(--teal-tint), #fff);
            border: 1.5px solid var(--teal-soft);
            border-radius: var(--radius);
            padding: 18px 22px;
            margin-bottom: 26px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .pv-header-left h3 {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 1.18rem;
            font-weight: 600;
            color: var(--navy);
            margin: 0 0 4px;
        }

        .pv-header-left p {
            font-size: .83rem;
            color: var(--muted);
            margin: 0;
        }

        .pv-daerah-chip {
            background: var(--navy);
            color: #fff;
            padding: 7px 18px;
            border-radius: 999px;
            font-size: .82rem;
            font-weight: 700;
            white-space: nowrap;
            flex-shrink: 0;
        }

        /* Two-col layout */
        .pv-two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        @media (max-width: 768px) {
            .pv-two-col {
                grid-template-columns: 1fr;
            }
        }

        /* Blocks */
        .pv-block {
            background: var(--bg-warm);
            border: 1.5px solid var(--line);
            border-radius: var(--radius);
            padding: 18px 20px;
            margin-bottom: 16px;
        }

        .pv-block:last-child {
            margin-bottom: 0;
        }

        .pv-block-col {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .pv-block-col .pv-block {
            flex: 1;
        }

        .pv-block-col .pv-block:not(:last-child) {
            margin-bottom: 16px;
        }

        .pv-block-title {
            font-family: 'Fraunces', Georgia, serif;
            font-size: .95rem;
            font-weight: 600;
            color: var(--navy);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--line);
        }

        .pv-block-title .icon-badge {
            width: 30px;
            height: 30px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--teal-soft), #d4ecee);
            color: var(--teal-deep);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            flex-shrink: 0;
        }

        /* Fields */
        .pv-fields {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .pv-field {
            padding: 9px 12px;
            background: #fff;
            border-radius: 8px;
            border: 1px solid var(--line);
        }

        .pv-field-label {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--muted);
            margin-bottom: 3px;
        }

        .pv-field-value {
            font-size: .91rem;
            color: var(--ink);
            font-weight: 500;
            line-height: 1.4;
            word-break: break-word;
        }

        .pv-field-value.is-empty {
            color: var(--muted);
            font-style: italic;
            font-weight: 400;
        }

        /* Kegiatan tags */
        .pv-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .pv-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            background: var(--teal-soft);
            color: var(--teal-deep);
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 600;
            border: 1px solid rgba(10, 138, 150, .18);
        }

        .pv-tag i {
            font-size: .8rem;
        }

        .pv-no-event {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            background: #fff8f2;
            border: 1.5px dashed #e4c49a;
            border-radius: var(--radius-sm);
            color: var(--copper);
            font-size: .84rem;
            font-weight: 600;
        }

        /* Narahubung preview */
        .pv-nh-item {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--radius-sm);
            padding: 12px 14px;
            margin-bottom: 8px;
        }

        .pv-nh-item:last-child {
            margin-bottom: 0;
        }

        .pv-nh-head {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 9px;
            font-weight: 700;
            color: var(--navy);
            font-size: .88rem;
        }

        .pv-nh-badge {
            background: var(--teal);
            color: #fff;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .72rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .pv-nh-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 7px;
        }

        @media (max-width: 480px) {
            .pv-nh-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Action buttons */
        .pv-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--line);
            flex-wrap: wrap;
        }

        .btn-pv-back {
            background: #fff;
            border: 1.5px solid var(--line-strong);
            color: var(--ink-soft);
            padding: 14px 22px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: .93rem;
            cursor: pointer;
            transition: all .18s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            justify-content: center;
            min-width: 140px;
        }

        .btn-pv-back:hover {
            border-color: var(--navy);
            color: var(--navy);
            background: var(--bg);
        }

        .btn-pv-confirm {
            background: var(--navy);
            background-image: linear-gradient(135deg, var(--navy) 0%, var(--navy-soft) 100%);
            color: #fff;
            padding: 14px 32px;
            border: none;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: .93rem;
            cursor: pointer;
            transition: all .18s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex: 2;
            justify-content: center;
            min-width: 180px;
            box-shadow: 0 4px 16px rgba(15, 42, 74, .24);
        }

        .btn-pv-confirm:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(15, 42, 74, .30);
        }

        .btn-pv-confirm:disabled {
            opacity: .65;
            cursor: not-allowed;
            transform: none;
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

            .form-section-title {
                font-size: 1.15rem;
            }

            .hero-meta {
                gap: 14px 22px;
            }

            .steps-wrap {
                gap: 0;
            }

            .step-connector {
                min-width: 24px;
            }

            .step-label {
                font-size: .68rem;
            }

            .pv-actions {
                flex-direction: column;
            }

            .btn-pv-back,
            .btn-pv-confirm {
                flex: none;
                width: 100%;
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
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Mohon periksa
                            kembali isian berikut:</div>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM --}}
                <form id="registrationForm" method="POST" action="{{ route('pendaftaran.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- ═══════════ STEP INDICATOR ═══════════ --}}
                    <div class="steps-wrap">
                        <div class="step-item active" id="si-1">
                            <div class="step-circle" id="sc-circle-1">1</div>
                            <div class="step-label">Isi Data</div>
                        </div>
                        <div class="step-connector" id="sc-1"></div>
                        <div class="step-item" id="si-2">
                            <div class="step-circle" id="sc-circle-2">2</div>
                            <div class="step-label">Pratinjau</div>
                        </div>
                        <div class="step-connector" id="sc-2"></div>
                        <div class="step-item" id="si-3">
                            <div class="step-circle" id="sc-circle-3">3</div>
                            <div class="step-label">Kirim</div>
                        </div>
                    </div>

                    {{-- ═══════════ STEP 1 : FORM ═══════════ --}}
                    <div id="step-form">

                        {{-- Data Kepala Daerah --}}
                        <h3 class="form-section-title">
                            <span class="icon-badge"><i class="bi bi-person-vcard"></i></span>Data Kepala Daerah
                        </h3>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jumlah Rombongan <span class="required">*</span></label>
                                <input type="number" min="1" class="form-control" name="jumlah_rombongan"
                                    value="{{ old('jumlah_rombongan', 1) }}" required>
                                <span class="field-help"><i class="bi bi-people"></i>Termasuk kepala daerah, pasangan,
                                    ajudan, OPD dan tim pendamping.</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="nama_daerah">Nama Daerah <span
                                        class="required">*</span></label>
                                <select class="form-select" id="nama_daerah" name="nama_daerah" required
                                    onchange="toggleDaerahLainnya()">
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
                                            $oldDaerah = old('nama_daerah', 'Kota Ternate');
                                            $isOther = $oldDaerah !== '' && !in_array($oldDaerah, $daerahList);
                                        @endphp
                                        @foreach ($daerahList as $daerah)
                                            <option value="{{ $daerah }}"
                                                {{ !$isOther && $oldDaerah === $daerah ? 'selected' : '' }}>
                                                {{ $daerah }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Lainnya">
                                        <option value="__lainnya__" {{ $isOther ? 'selected' : '' }}>Ketik nama daerah
                                            lainnya...</option>
                                    </optgroup>
                                </select>
                                <div id="daerahLainnyaWrap"
                                    style="display:{{ $isOther ? 'block' : 'none' }};margin-top:10px;">
                                    <div style="position:relative;">
                                        <span
                                            style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#9aa3af;font-size:.9rem;pointer-events:none;"><i
                                                class="bi bi-pencil-fill"></i></span>
                                        <input type="text" class="form-control" id="nama_daerah_lainnya"
                                            name="nama_daerah_lainnya" value="{{ $isOther ? $oldDaerah : '' }}"
                                            placeholder="Tulis nama Kab./Kota Anda..." style="padding-left:38px;"
                                            {{ $isOther ? 'required' : '' }}>
                                    </div>
                                    <span class="field-help"><i class="bi bi-info-circle"></i>Tulis lengkap, contoh:
                                        <strong>Kab. Halmahera Tengah</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="nama_kepala_daerah">Nama Lengkap Kepala Daerah <span
                                        class="required">*</span></label>
                                <input type="text" class="form-control" id="nama_kepala_daerah"
                                    name="nama_kepala_daerah" value="{{ old('nama_kepala_daerah') }}"
                                    placeholder="Lengkap dengan gelar" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="nama_pasangan_kepala_daerah">Nama Lengkap Pasangan
                                    Kepala Daerah</label>
                                <input type="text" class="form-control" id="nama_pasangan_kepala_daerah"
                                    name="nama_pasangan_kepala_daerah"
                                    value="{{ old('nama_pasangan_kepala_daerah') }}"
                                    placeholder="Opsional, kosongkan jika tidak hadir"
                                    oninput="toggleUkuranPasangan()">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ukuran Baju Kepala Daerah <span
                                        class="required">*</span></label>
                                <select class="form-select" name="ukuran_baju" required>
                                    <option value="">Pilih Ukuran</option>
                                    @foreach (['S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $u)
                                        <option value="{{ $u }}"
                                            {{ old('ukuran_baju') == $u ? 'selected' : '' }}>{{ $u }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" id="label_ukuran_pasangan">
                                    Ukuran Baju Pasangan Kepala Daerah
                                    <span class="required" id="required_ukuran_pasangan"
                                        style="display:none">*</span>
                                </label>
                                <select class="form-select" name="ukuran_baju_pasangan" id="ukuran_baju_pasangan">
                                    <option value="">Pilih Ukuran</option>
                                    @foreach (['S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $u)
                                        <option value="{{ $u }}"
                                            {{ old('ukuran_baju_pasangan') == $u ? 'selected' : '' }}>
                                            {{ $u }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Kegiatan --}}
                        <h3 class="form-section-title">
                            <span class="icon-badge"><i class="bi bi-calendar2-check"></i></span>
                            Kegiatan yang Akan Diikuti <small>· Pilih satu atau lebih</small>
                        </h3>

                        <div class="event-summary-bar">
                            <div class="event-count-label">Kegiatan dipilih <span class="event-count-badge"
                                    id="eventCountBadge">0</span></div>
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="button" class="select-all-btn" onclick="selectAllEvents()"><i
                                        class="bi bi-check2-all"></i> Pilih Semua</button>
                                <button type="button" class="select-all-btn" onclick="clearAllEvents()"
                                    style="border-color:#e6c5c5;color:#b53d3d"><i class="bi bi-x-lg"></i>
                                    Bersihkan</button>
                            </div>
                        </div>

                        <div class="events-list-wrap">
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Master Class" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d1">26
                                        AGUSTUS</span>
                                    <div class="event-check-title">Master Class</div><small><a
                                            href="https://docs.google.com/forms/d/e/1FAIpQLSeqhlkZeeFmfHzcURAkbeDaXBC70Mhp5S9JRPIG3ZTlElLEFg/viewform"
                                            target="_blank" onclick="event.stopPropagation()">Daftar di laman
                                            resmi</a></small>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Berbagai Titik
                                        Cagar Budaya</div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Welcome Dinner" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-pre">26
                                        AGUSTUS</span>
                                    <div class="event-check-title">Makan Bersama</div>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Pendopo Kediaman
                                        Wali Kota</div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Expo UMKM" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d6">26–29
                                        AGUSTUS</span>
                                    <div class="event-check-title">Expo UMKM (4 Hari)</div>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                    </div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Pentas Budaya" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d6">26–29
                                        AGUSTUS</span>
                                    <div class="event-check-title">Pentas Budaya (4 Hari)</div><small><a
                                            href="https://docs.google.com/forms/d/e/1FAIpQLSf-cQrDYIoF8JoOY0oOwSoNwFrhvKg4bH4Pq1rYWB9iiQy5-g/viewform"
                                            target="_blank" onclick="event.stopPropagation()">Isi formulir terpisah di
                                            sini</a></small>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                    </div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Ladies Program" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d2">27
                                        AGUSTUS</span>
                                    <div class="event-check-title">Ladies Program</div>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Benteng Oranje &
                                        Pusat Kreatif</div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Simposium Internasional - Pulau-Pulau Penghasil Rempah"
                                    onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d2">27
                                        AGUSTUS</span>
                                    <div class="event-check-title">Simposium Internasional – Pulau Penghasil Rempah
                                    </div>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Bela Hotel</div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Rapat Kerja Nasional" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d3">28
                                        AGUSTUS</span>
                                    <div class="event-check-title">Rapat Kerja Nasional</div>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Bela Hotel</div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Festival Gastronomi" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d3">28
                                        AGUSTUS</span>
                                    <div class="event-check-title">Festival Gastronomi</div>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Benteng Oranje
                                    </div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Gelar Budaya dan Penyerahan Pataka" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d3">28
                                        AGUSTUS</span>
                                    <div class="event-check-title">Gelar Budaya & Penyerahan Pataka</div>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Landmark Ternate
                                    </div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Seminar Nasional" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d3">29
                                        AGUSTUS</span>
                                    <div class="event-check-title">Seminar Nasional</div>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Universitas
                                        Khairun Ternate</div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Heritage City Tour" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d4">29
                                        AGUSTUS</span>
                                    <div class="event-check-title">Heritage City Tour</div>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Kadaton
                                        Kesultanan & Cagar Budaya</div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Pawai Budaya dan Karnaval" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d4">29
                                        AGUSTUS</span>
                                    <div class="event-check-title">Pawai Budaya dan Karnaval</div>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Benteng Oranje –
                                        Lapangan Salero</div>
                                </div>
                            </label>
                            <label class="event-check-item"><input type="checkbox" name="kegiatan[]"
                                    value="Nusantara Raya Run" onchange="onEventChange()">
                                <div class="event-check-content"><span class="event-date-chip chip-d5">30
                                        AGUSTUS</span>
                                    <div class="event-check-title">Nusantara Raya Run</div><small><a
                                            href="https://widget.etix.co.id/?lan=id&product=ternate-fort-to-fort-harita-nusantara-raya-run-178149830891179"
                                            target="_blank" onclick="event.stopPropagation()">Daftar di laman
                                            resmi</a></small>
                                    <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i> Fort to Fort
                                    </div>
                                </div>
                            </label>
                        </div>

                        {{-- Perjalanan --}}
                        <h3 class="form-section-title">
                            <span class="icon-badge"><i class="bi bi-airplane"></i></span>Informasi Perjalanan
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Plat Kendaraan Kepala Daerah</label>
                                <input type="text" class="form-control" name="nomor_plat"
                                    value="{{ old('nomor_plat') }}" placeholder="Contoh: B 1 ABC">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Info Kedatangan Kepala Daerah <span
                                        class="required">*</span></label>
                                <input type="text" class="form-control" name="info_kedatangan"
                                    value="{{ old('info_kedatangan') }}"
                                    placeholder="Contoh: 26 Agustus 2026, GA-602, 10:30 WIT" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Info Kepulangan Kepala Daerah <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control" name="info_kepulangan"
                                value="{{ old('info_kepulangan') }}"
                                placeholder="Contoh: 30 Agustus 2026, GA-603, 14:15 WIT" required>
                        </div>

                        {{-- Ajudan --}}
                        <h3 class="form-section-title">
                            <span class="icon-badge"><i class="bi bi-person-badge"></i></span>Data Ajudan / ADC
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ajudan/ADC</label>
                                <input type="text" class="form-control" name="nama_ajudan"
                                    value="{{ old('nama_ajudan') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Telepon Ajudan/ADC</label>
                                <input type="text" class="form-control" id="telepon_ajudan" name="telepon_ajudan"
                                    value="{{ old('telepon_ajudan') }}" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>

                        {{-- Narahubung --}}
                        <h3 class="form-section-title">
                            <span class="icon-badge"><i class="bi bi-people"></i></span>
                            Data Narahubung <small>· Bisa lebih dari satu</small>
                        </h3>
                        <div id="narahubungContainer">
                            @php $oldNarahubung = old('narahubung', [[]]); @endphp
                            @foreach ($oldNarahubung as $index => $nh)
                                <div class="narahubung-card" data-index="{{ $index }}">
                                    <div class="narahubung-card-header">
                                        <div class="narahubung-card-title">
                                            <span
                                                class="narahubung-number-badge nh-number">{{ $index + 1 }}</span>Narahubung
                                        </div>
                                        <button type="button" class="btn-remove-narahubung"
                                            onclick="removeNarahubung(this)"
                                            {{ count($oldNarahubung) <= 1 ? 'disabled' : '' }}><i
                                                class="bi bi-trash"></i> Hapus</button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Narahubung <span
                                                class="required">*</span></label>
                                        <input type="text" class="form-control"
                                            name="narahubung[{{ $index }}][nama]"
                                            value="{{ $nh['nama'] ?? '' }}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nomor Telepon <span
                                                    class="required">*</span></label>
                                            <input type="text" class="form-control nh-telepon"
                                                name="narahubung[{{ $index }}][telepon]"
                                                value="{{ $nh['telepon'] ?? '' }}" placeholder="08xxxxxxxxxx"
                                                required>
                                        </div>
                                        <div class="col-md-6 mb-0">
                                            <label class="form-label">Email <span class="required">*</span></label>
                                            <input type="email" class="form-control"
                                                name="narahubung[{{ $index }}][email]"
                                                value="{{ $nh['email'] ?? '' }}" placeholder="email@domain.com"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn-add-narahubung mb-4" onclick="addNarahubung()">
                            <i class="bi bi-plus-circle"></i> Tambah Narahubung
                        </button>

                        {{-- Footer step 1 --}}
                        <div class="form-footer">
                            <div class="form-footer-note">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Klik <strong>Pratinjau Data</strong> untuk memeriksa kembali isian Anda sebelum
                                    dikirimkan.</span>
                            </div>
                            <button type="button" class="btn-submit" onclick="goToPreview()">
                                <i class="bi bi-eye"></i> Pratinjau Data
                            </button>
                        </div>

                    </div>{{-- /step-form --}}

                    {{-- ═══════════ STEP 2 : PREVIEW ═══════════ --}}
                    <div id="step-preview" style="display:none;">

                        {{-- Preview header --}}
                        <div class="pv-header">
                            <div class="pv-header-left">
                                <h3>Periksa Data Registrasi</h3>
                                <p>Pastikan seluruh informasi sudah benar sebelum dikirimkan.</p>
                            </div>
                            <div class="pv-daerah-chip" id="pv-daerah-chip">—</div>
                        </div>

                        {{-- 2-column grid --}}
                        <div class="pv-two-col">

                            {{-- Left column --}}
                            <div class="pv-block-col">
                                {{-- Data Kepala Daerah --}}
                                <div class="pv-block">
                                    <div class="pv-block-title">
                                        <span class="icon-badge"><i class="bi bi-person-vcard"></i></span>Data Kepala
                                        Daerah
                                    </div>
                                    <div class="pv-fields">
                                        <div class="pv-field">
                                            <div class="pv-field-label">Jumlah Rombongan</div>
                                            <div class="pv-field-value" id="pv-jumlah">—</div>
                                        </div>
                                        <div class="pv-field">
                                            <div class="pv-field-label">Nama Kepala Daerah</div>
                                            <div class="pv-field-value" id="pv-nama-kepala">—</div>
                                        </div>
                                        <div class="pv-field">
                                            <div class="pv-field-label">Nama Pasangan</div>
                                            <div class="pv-field-value" id="pv-nama-pasangan">—</div>
                                        </div>
                                        <div class="pv-field">
                                            <div class="pv-field-label">Ukuran Baju Kepala Daerah</div>
                                            <div class="pv-field-value" id="pv-ukuran-baju">—</div>
                                        </div>
                                        <div class="pv-field">
                                            <div class="pv-field-label">Ukuran Baju Pasangan</div>
                                            <div class="pv-field-value" id="pv-ukuran-pasangan">—</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Perjalanan --}}
                                <div class="pv-block">
                                    <div class="pv-block-title">
                                        <span class="icon-badge"><i class="bi bi-airplane"></i></span>Informasi
                                        Perjalanan
                                    </div>
                                    <div class="pv-fields">
                                        <div class="pv-field">
                                            <div class="pv-field-label">Nomor Plat Kendaraan</div>
                                            <div class="pv-field-value" id="pv-plat">—</div>
                                        </div>
                                        <div class="pv-field">
                                            <div class="pv-field-label">Info Kedatangan</div>
                                            <div class="pv-field-value" id="pv-kedatangan">—</div>
                                        </div>
                                        <div class="pv-field">
                                            <div class="pv-field-label">Info Kepulangan</div>
                                            <div class="pv-field-value" id="pv-kepulangan">—</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Right column --}}
                            <div class="pv-block-col">
                                {{-- Kegiatan --}}
                                <div class="pv-block">
                                    <div class="pv-block-title">
                                        <span class="icon-badge"><i class="bi bi-calendar2-check"></i></span>Kegiatan
                                        Dipilih
                                    </div>
                                    <div id="pv-kegiatan-wrap"></div>
                                </div>

                                {{-- Ajudan --}}
                                <div class="pv-block">
                                    <div class="pv-block-title">
                                        <span class="icon-badge"><i class="bi bi-person-badge"></i></span>Data Ajudan
                                        / ADC
                                    </div>
                                    <div class="pv-fields">
                                        <div class="pv-field">
                                            <div class="pv-field-label">Nama Ajudan</div>
                                            <div class="pv-field-value" id="pv-nama-ajudan">—</div>
                                        </div>
                                        <div class="pv-field">
                                            <div class="pv-field-label">Nomor Telepon</div>
                                            <div class="pv-field-value" id="pv-telepon-ajudan">—</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>{{-- /pv-two-col --}}

                        {{-- Narahubung (full width) --}}
                        <div class="pv-block">
                            <div class="pv-block-title">
                                <span class="icon-badge"><i class="bi bi-people"></i></span>Data Narahubung
                            </div>
                            <div id="pv-narahubung-wrap"></div>
                        </div>

                        {{-- Action buttons --}}
                        <div class="pv-actions">
                            <button type="button" class="btn-pv-back" onclick="goBackToForm()">
                                <i class="bi bi-chevron-left"></i> Edit Kembali
                            </button>
                            <button type="button" class="btn-pv-confirm" id="btn-pv-confirm"
                                onclick="confirmSubmit()">
                                <i class="bi bi-send-check"></i> Konfirmasi & Kirim Data
                            </button>
                        </div>

                    </div>{{-- /step-preview --}}

                </form>
            </div>
        </div>
    </div>

    {{-- NARAHUBUNG TEMPLATE --}}
    <template id="narahubungTemplate">
        <div class="narahubung-card" data-index="__INDEX__">
            <div class="narahubung-card-header">
                <div class="narahubung-card-title"><span
                        class="narahubung-number-badge nh-number">__NUMBER__</span>Narahubung</div>
                <button type="button" class="btn-remove-narahubung" onclick="removeNarahubung(this)"><i
                        class="bi bi-trash"></i> Hapus</button>
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
        /* ────── NARAHUBUNG DYNAMIC ────── */
        function renumberNarahubung() {
            const cards = document.querySelectorAll('#narahubungContainer .narahubung-card');
            cards.forEach((card, idx) => {
                card.setAttribute('data-index', idx);
                card.querySelector('.nh-number').textContent = idx + 1;
                card.querySelectorAll('[name^="narahubung["]').forEach(inp => {
                    inp.setAttribute('name', inp.getAttribute('name').replace(/narahubung\[\d+\]/,
                        `narahubung[${idx}]`));
                });
            });
            document.querySelectorAll('.btn-remove-narahubung').forEach(btn => {
                btn.disabled = cards.length <= 1;
            });
        }

        function addNarahubung() {
            const tpl = document.getElementById('narahubungTemplate');
            const idx = document.querySelectorAll('#narahubungContainer .narahubung-card').length;
            const wrapper = document.createElement('div');
            wrapper.innerHTML = tpl.innerHTML
                .replace(/__INDEX__/g, idx)
                .replace(/__NUMBER__/g, idx + 1);
            const card = wrapper.firstElementChild; // ← firstElementChild, bukan firstChild
            document.getElementById('narahubungContainer').appendChild(card);
            renumberNarahubung();
            attachPhoneFilter(card);
            card.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function removeNarahubung(btn) {
            if (document.querySelectorAll('#narahubungContainer .narahubung-card').length <= 1) return;
            if (confirm('Hapus narahubung ini?')) {
                btn.closest('.narahubung-card').remove();
                renumberNarahubung();
            }
        }

        /* ────── PHONE FILTER ────── */
        function attachPhoneFilter(scope = document) {
            scope.querySelectorAll('#telepon_ajudan, .nh-telepon').forEach(el => {
                if (el.dataset.pf) return;
                el.dataset.pf = '1';
                el.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9+]/g, '');
                });
            });
        }
        attachPhoneFilter();
        renumberNarahubung();

        /* ────── EVENT PICKER ────── */
        function onEventChange() {
            let n = 0;
            document.querySelectorAll('input[name="kegiatan[]"]').forEach(cb => {
                cb.closest('.event-check-item').classList.toggle('selected', cb.checked);
                if (cb.checked) n++;
            });
            document.getElementById('eventCountBadge').textContent = n;
        }

        function selectAllEvents() {
            document.querySelectorAll('input[name="kegiatan[]"]').forEach(cb => cb.checked = true);
            onEventChange();
        }

        function clearAllEvents() {
            document.querySelectorAll('input[name="kegiatan[]"]').forEach(cb => cb.checked = false);
            onEventChange();
        }
        onEventChange();

        /* ────── DAERAH TOGGLE ────── */
        function toggleDaerahLainnya() {
            const v = document.getElementById('nama_daerah').value;
            const w = document.getElementById('daerahLainnyaWrap');
            const i = document.getElementById('nama_daerah_lainnya');
            const isOther = v === '__lainnya__';
            w.style.display = isOther ? 'block' : 'none';
            i.required = isOther;
            if (!isOther) i.value = '';
        }
        document.addEventListener('DOMContentLoaded', toggleDaerahLainnya);

        /* ────── UKURAN PASANGAN ────── */
        function toggleUkuranPasangan() {
            const has = document.getElementById('nama_pasangan_kepala_daerah').value.trim() !== '';
            const sel = document.getElementById('ukuran_baju_pasangan');
            const req = document.getElementById('required_ukuran_pasangan');
            sel.required = has;
            req.style.display = has ? 'inline' : 'none';
            if (!has) sel.value = '';
        }
        document.addEventListener('DOMContentLoaded', toggleUkuranPasangan);

        /* ══════════════════════════════════════
           STEP NAVIGATION
           ══════════════════════════════════════ */

        /** Update step indicator circles + connectors */
        function applyStep(step) {
            [1, 2, 3].forEach(n => {
                const item = document.getElementById('si-' + n);
                const circle = document.getElementById('sc-circle-' + n);
                item.classList.remove('active', 'done');
                if (n < step) {
                    item.classList.add('done');
                    circle.innerHTML = '<i class="bi bi-check-lg"></i>';
                } else if (n === step) {
                    item.classList.add('active');
                    circle.textContent = String(n);
                } else {
                    circle.textContent = String(n);
                }
            });
            [1, 2].forEach(n => {
                document.getElementById('sc-' + n).classList.toggle('done', n < step);
            });
        }

        /** Scroll card top into view */
        function scrollTop() {
            const card = document.querySelector('.registration-card');
            const y = card.getBoundingClientRect().top + window.scrollY - 90;
            window.scrollTo({
                top: Math.max(y, 0),
                behavior: 'smooth'
            });
        }

        /** Show element with direction animation */
        function showEl(id, reverse) {
            const el = document.getElementById(id);
            el.style.display = 'block';
            el.classList.remove('anim-fwd', 'anim-back');
            void el.offsetWidth; // reflow
            el.classList.add(reverse ? 'anim-back' : 'anim-fwd');
        }

        /* ── pv helpers ── */
        function pvGet(sel) {
            return (document.querySelector(sel)?.value || '').trim();
        }

        function pvSet(id, text, empty = false) {
            const el = document.getElementById(id);
            if (!el) return;
            el.textContent = text;
            el.className = 'pv-field-value' + (empty ? ' is-empty' : '');
        }

        /* ── STEP 1 → 2 ── */
        function goToPreview() {
            const form = document.getElementById('registrationForm');
            if (!form.reportValidity()) return;
            /* Validasi: minimal 1 kegiatan harus dipilih */
            const checkedEvents = document.querySelectorAll('input[name="kegiatan[]"]:checked');
            if (checkedEvents.length === 0) {
                const bar = document.querySelector('.event-summary-bar');
                bar.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                // Tampilkan pesan error sementara
                let errEl = document.getElementById('event-required-msg');
                if (!errEl) {
                    errEl = document.createElement('div');
                    errEl.id = 'event-required-msg';
                    errEl.className = 'alert alert-danger mt-2 mb-2 d-flex align-items-center gap-2';
                    errEl.innerHTML =
                        '<i class="bi bi-exclamation-triangle-fill"></i> Silakan pilih <strong>minimal satu kegiatan</strong> sebelum melanjutkan.';
                    bar.after(errEl);
                }
                errEl.style.display = 'flex';
                setTimeout(() => {
                    if (errEl) errEl.style.display = 'none';
                }, 4000);
                return;
            }

            // Sembunyikan pesan error jika ada
            const errEl = document.getElementById('event-required-msg');
            if (errEl) errEl.style.display = 'none';
            /* Collect values */
            const daerahRaw = document.getElementById('nama_daerah').value;
            const namaDaerah = daerahRaw === '__lainnya__' ?
                (document.getElementById('nama_daerah_lainnya')?.value || '').trim() :
                daerahRaw;

            const jumlah = pvGet('[name="jumlah_rombongan"]');
            const namaKepala = pvGet('[name="nama_kepala_daerah"]');
            const namaPasangan = pvGet('[name="nama_pasangan_kepala_daerah"]');
            const ukuranBaju = pvGet('[name="ukuran_baju"]');
            const ukuranPasangan = pvGet('[name="ukuran_baju_pasangan"]');
            const plat = pvGet('[name="nomor_plat"]');
            const kedatangan = pvGet('[name="info_kedatangan"]');
            const kepulangan = pvGet('[name="info_kepulangan"]');
            const namaAjudan = pvGet('[name="nama_ajudan"]');
            const telAjudan = pvGet('[name="telepon_ajudan"]');

            /* Header chip */
            document.getElementById('pv-daerah-chip').textContent = namaDaerah ? `Daerah Anda : ${namaDaerah}` :
                'Daerah Anda : —';

            /* Populate fields */
            pvSet('pv-jumlah', jumlah ? jumlah + ' orang' : '—', !jumlah);
            pvSet('pv-nama-kepala', namaKepala || '—', !namaKepala);
            pvSet('pv-nama-pasangan', namaPasangan || '(tidak hadir)', !namaPasangan);
            pvSet('pv-ukuran-baju', ukuranBaju || '—', !ukuranBaju);
            pvSet('pv-ukuran-pasangan', namaPasangan ? (ukuranPasangan || '—') : '(tidak hadir)', !namaPasangan);
            pvSet('pv-plat', plat || '(tidak dicantumkan)', !plat);
            pvSet('pv-kedatangan', kedatangan || '—', !kedatangan);
            pvSet('pv-kepulangan', kepulangan || '—', !kepulangan);
            pvSet('pv-nama-ajudan', namaAjudan || '(tidak ada)', !namaAjudan);
            pvSet('pv-telepon-ajudan', telAjudan || '(tidak ada)', !telAjudan);

            /* Kegiatan */
            const events = [];
            document.querySelectorAll('input[name="kegiatan[]"]:checked').forEach(cb => events.push(cb.value));
            const kw = document.getElementById('pv-kegiatan-wrap');
            kw.innerHTML = events.length ?
                `<div class="pv-tags">${events.map(e => `<span class="pv-tag"><i class="bi bi-check-circle-fill"></i>${e}</span>`).join('')}</div>` :
                `<div class="pv-no-event"><i class="bi bi-exclamation-circle-fill"></i>Belum ada kegiatan dipilih</div>`;

            /* Narahubung */
            const nw = document.getElementById('pv-narahubung-wrap');
            const nhCards = document.querySelectorAll('#narahubungContainer .narahubung-card');
            nw.innerHTML = [...nhCards].map((card, i) => {
                const n = (card.querySelector('[name$="[nama]"]')?.value || '').trim();
                const t = (card.querySelector('[name$="[telepon]"]')?.value || '').trim();
                const e = (card.querySelector('[name$="[email]"]')?.value || '').trim();
                return `<div class="pv-nh-item">
                    <div class="pv-nh-head"><span class="pv-nh-badge">${i+1}</span>${n || '<em style="color:var(--muted);font-weight:400">nama belum diisi</em>'}</div>
                    <div class="pv-nh-grid">
                        <div class="pv-field"><div class="pv-field-label">Telepon</div><div class="pv-field-value${t?'':' is-empty'}">${t||'—'}</div></div>
                        <div class="pv-field"><div class="pv-field-label">Email</div><div class="pv-field-value${e?'':' is-empty'}">${e||'—'}</div></div>
                    </div>
                </div>`;
            }).join('');

            /* Reset confirm button */
            const btn = document.getElementById('btn-pv-confirm');
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-send-check"></i> Konfirmasi & Kirim Data';

            /* Transition */
            document.getElementById('step-form').style.display = 'none';
            showEl('step-preview', false);
            applyStep(2);
            scrollTop();
        }

        /* ── STEP 2 → 1 ── */
        function goBackToForm() {
            document.getElementById('step-preview').style.display = 'none';
            showEl('step-form', true);
            applyStep(1);
            scrollTop();
        }

        /* ── STEP 2 → 3 (submit) ── */
        function confirmSubmit() {
            const btn = document.getElementById('btn-pv-confirm');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Mengirim...';
            applyStep(3);
            document.getElementById('registrationForm').submit();
        }
    </script>
</body>

</html>
