@extends('layouts.main')

@section('title', 'PIC Event - Rakernas XII JKPI 2026 Kota Ternate')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #099aa7;
            --primary-dark: #077b86;
            --primary-light: #e6f7f8;
            --gold: #d4a017;
            --gold-light: #fef9e7;
            --dark: #1a1a2e;
            --gray: #6c757d;
            --gray-light: #f8f9fa;
            --border: #eef1f5;

            /* Event colors — matching the infographic palette */
            --color-makan:      #f5a623;
            --color-masterclass:#6abf3e;
            --color-pawai:      #3abf6e;
            --color-heritage:   #4db3e6;
            --color-nusantara:  #9b59b6;
            --color-ladies:     #f5a623;
            --color-pasar:      #6abf3e;
            --color-simposium:  #3abf6e;
            --color-gelar:      #4db3e6;
            --color-penjemputan:#9b59b6;
        }

        /* ========== HERO ========== */
        .pic-hero {
            position: relative;
            padding: 140px 0 80px;
            background: linear-gradient(135deg, #0a2a3c 0%, #0d4f5e 40%, #099aa7 100%);
            overflow: hidden;
            color: white;
        }

        .pic-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(45deg, rgba(255,255,255,.04) 0 1px, transparent 1px 18px),
                repeating-linear-gradient(-45deg, rgba(255,255,255,.03) 0 1px, transparent 1px 18px);
            pointer-events: none;
        }

        .pic-hero::after {
            content: "";
            position: absolute;
            right: -120px;
            top: -120px;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: radial-gradient(closest-side, rgba(212,160,23,.35), transparent 70%);
            pointer-events: none;
        }

        .pic-hero .container { position: relative; z-index: 2; }

        .hero-badge {
            display: inline-block;
            background: rgba(255,255,255,.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.2);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: .85rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .hero-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 16px;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            opacity: .85;
            max-width: 560px;
            line-height: 1.6;
        }

        /* ========== CONTENT ========== */
        .pic-content {
            padding: 0 0 80px;
            background: #f5f7fa;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ========== COORDINATOR CARD ========== */
        .coordinator-strip {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,.08);
            padding: 32px 36px;
            margin-top: -48px;
            position: relative;
            z-index: 10;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .coordinator-strip-label {
            font-size: .7rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 4px;
        }

        .coordinator-pair {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            flex: 1;
        }

        .coordinator-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--gray-light);
            border-radius: 14px;
            padding: 16px 20px;
            flex: 1;
            min-width: 240px;
            border: 2px solid var(--border);
            transition: border-color .25s, box-shadow .25s;
        }

        .coordinator-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 16px rgba(9,154,167,.12);
        }

        .coordinator-avatar {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #e81b7e, #c0195f);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .coordinator-avatar.blue {
            background: linear-gradient(135deg, #4db3e6, #2a8bbf);
        }

        .coordinator-avatar i { color: white; font-size: 1.3rem; }

        .coordinator-info { flex: 1; }

        .coordinator-role {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--gray);
            margin-bottom: 2px;
        }

        .coordinator-name {
            font-size: 1rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .coordinator-phone a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .82rem;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
        }

        .coordinator-phone a:hover { color: var(--primary-dark); text-decoration: underline; }

        /* ========== SECTION LABEL ========== */
        .section-label {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .section-label h2 {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--dark);
            margin: 0;
        }

        .section-label-line {
            flex: 1;
            height: 2px;
            background: var(--border);
            border-radius: 2px;
        }

        /* ========== EVENT GRID ========== */
        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 18px;
        }

        /* ========== EVENT CARD ========== */
        .event-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid var(--border);
            transition: transform .3s, box-shadow .3s, border-color .3s;
            animation: fadeInUp .4s ease forwards;
            opacity: 0;
        }

        .event-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,.1);
            border-color: var(--event-color, var(--primary));
        }

        .event-card-header {
            padding: 18px 22px 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid var(--border);
        }

        .event-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--event-color, var(--primary));
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .event-icon i { color: white; font-size: 1.15rem; }

        .event-name {
            font-size: 1rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.2;
        }

        .event-badge {
            margin-left: auto;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
            background: var(--event-bg, #e6f7f8);
            color: var(--event-color, var(--primary));
            flex-shrink: 0;
        }

        .event-contacts {
            padding: 14px 22px 18px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .pic-person {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--gray-light);
            border-radius: 10px;
            padding: 10px 14px;
            transition: background .2s;
        }

        .pic-person:hover { background: var(--primary-light); }

        .pic-person-avatar {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--event-color, var(--primary));
            opacity: .15;
            flex-shrink: 0;
            position: relative;
        }

        .pic-person-avatar-icon {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pic-person-avatar-icon i {
            font-size: .95rem;
            color: var(--event-color, var(--primary));
            opacity: 1;
        }

        .pic-person-wrap {
            position: relative;
            width: 34px;
            height: 34px;
            flex-shrink: 0;
        }

        .pic-person-info { flex: 1; min-width: 0; }

        .pic-person-name {
            font-size: .88rem;
            font-weight: 700;
            color: var(--dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .pic-person-phone a {
            font-size: .78rem;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .pic-person-phone a:hover { text-decoration: underline; }

        .wa-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #25D366;
            color: white;
            font-size: .85rem;
            text-decoration: none;
            flex-shrink: 0;
            transition: opacity .2s, transform .2s;
        }

        .wa-btn:hover { opacity: .85; transform: scale(1.1); color: white; }

        /* ========== NO RESULTS ========== */
        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #bbb;
        }

        .no-results i { font-size: 3rem; margin-bottom: 16px; display: block; }

        /* ========== SEARCH BAR ========== */
        .toolbar-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,.06);
            padding: 20px 24px;
            margin-bottom: 28px;
        }

        .toolbar-row {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 240px;
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
        }

        .search-box input {
            width: 100%;
            padding: 12px 18px 12px 44px;
            border: 2px solid #e8eef2;
            border-radius: 12px;
            font-size: .92rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--gray-light);
            transition: border-color .2s, box-shadow .2s;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(9,154,167,.1);
        }

        .result-count {
            font-size: .88rem;
            font-weight: 600;
            color: #999;
            white-space: nowrap;
        }

        .result-count strong { color: var(--primary); }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 992px) {
            .hero-title { font-size: 2.4rem; }
            .event-grid { grid-template-columns: repeat(2, 1fr); }
            .coordinator-strip { gap: 24px; padding: 24px; }
        }

        @media (max-width: 768px) {
            .pic-hero { padding: 110px 0 60px; }
            .hero-title { font-size: 2rem; }
            .coordinator-strip {
                flex-direction: column;
                margin-top: -30px;
                border-radius: 14px;
                padding: 20px;
                gap: 16px;
            }
            .coordinator-pair { gap: 12px; }
            .coordinator-card { min-width: 100%; }
            .event-grid { grid-template-columns: 1fr; gap: 14px; }
            .toolbar-card { padding: 14px 16px; }
        }

        @media (max-width: 480px) {
            .hero-title { font-size: 1.65rem; }
            .event-card-header { padding: 14px 16px 12px; }
            .event-contacts { padding: 12px 16px 16px; }
        }

        /* ========== ANIMATIONS ========== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
@endpush

@section('content')

    <!-- HERO -->
    <section class="pic-hero">
        <div class="container">
            <div class="hero-badge"><i class="bi bi-person-lines-fill me-2"></i>Kontak Panitia</div>
            <h1 class="hero-title text-white">PIC Event<br>Rakernas XII JKPI</h1>
            <p class="hero-subtitle">
                Daftar Person In Charge setiap rangkaian acara Rakernas JKPI XII 2026 Kota Ternate.
                Hubungi langsung PIC terkait untuk informasi lebih lanjut.
            </p>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="pic-content">
        <div class="container">

            <!-- KOORDINATOR STRIP -->
            <div class="coordinator-strip">
                <div>
                    <div class="coordinator-strip-label">Koordinator Panitia Daerah</div>
                </div>
                <div class="coordinator-pair">

                    <div class="coordinator-card">
                        <div class="coordinator-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="coordinator-info">
                            <div class="coordinator-role">Wakil Ketua</div>
                            <div class="coordinator-name">Rukmini A. Rahman</div>
                            <div class="coordinator-phone">
                                <a href="https://wa.me/62081340228346" target="_blank">
                                    <i class="bi bi-whatsapp" style="color:#25D366;"></i>
                                    081340228346
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="coordinator-card">
                        <div class="coordinator-avatar blue">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="coordinator-info">
                            <div class="coordinator-role">Sekretaris</div>
                            <div class="coordinator-name">Ronny Aries</div>
                            <div class="coordinator-phone">
                                <a href="https://wa.me/6282290056150" target="_blank">
                                    <i class="bi bi-whatsapp" style="color:#25D366;"></i>
                                    082290056150
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- SEARCH -->
            <div class="toolbar-card">
                <div class="toolbar-row">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" id="picSearch" placeholder="Cari nama event atau PIC...">
                    </div>
                    <div class="result-count">Menampilkan <strong id="picCount">10</strong> event</div>
                </div>
            </div>

            <!-- SECTION HEADING -->
            <div class="section-label">
                <h2>Daftar PIC per Event</h2>
                <div class="section-label-line"></div>
            </div>

            <!-- EVENT GRID -->
            <div class="event-grid" id="eventGrid"></div>

            <!-- NO RESULTS -->
            <div class="no-results" id="noResults" style="display:none;">
                <i class="bi bi-person-x"></i>
                <p>Tidak ada event yang sesuai pencarian Anda.</p>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>
// ========== DATA PIC ==========
const eventData = [
    {
        name: "Makan Bersama",
        icon: "bi-cup-hot-fill",
        color: "#f5a623",
        bg: "#fef9e7",
        pics: [
            { name: "Agus Fian",  phone: "081340867714" },
            { name: "Fahrudin",   phone: "082393030000" },
        ]
    },
    {
        name: "Master Class",
        icon: "bi-mortarboard-fill",
        color: "#6abf3e",
        bg: "#eef9e8",
        pics: [
            { name: "Zandri Aldrin", phone: "082290057007" },
            { name: "Nanda Ade",     phone: "082292967024" },
        ]
    },
    {
        name: "Pawai Budaya & Karnaval",
        icon: "bi-flag-fill",
        color: "#3abf6e",
        bg: "#e8f9f0",
        pics: [
            { name: "Adhy",   phone: "081380341986" },
            { name: "Arjuna", phone: "081341946665" },
        ]
    },
    {
        name: "Heritage City Tour",
        icon: "bi-geo-alt-fill",
        color: "#4db3e6",
        bg: "#e8f4fb",
        pics: [
            { name: "Ridwan", phone: "082395664443" },
            { name: "Cut",    phone: "081340396699" },
        ]
    },
    {
        name: "Nusantara Raya Run Fort to Fort",
        icon: "bi-lightning-charge-fill",
        color: "#9b59b6",
        bg: "#f5eefb",
        pics: [
            { name: "Mario",  phone: "08122011982"  },
            { name: "Sutopo", phone: "082114415823" },
        ]
    },
    {
        name: "Ladies Program",
        icon: "bi-heart-fill",
        color: "#f5a623",
        bg: "#fef9e7",
        pics: [
            { name: "Atun",          phone: "082191534125" },
            { name: "Suryaningsih",  phone: "082290056161" },
        ]
    },
    {
        name: "Pasar Malam, Pentas Budaya, Festival Gastronomi",
        icon: "bi-shop-window",
        color: "#6abf3e",
        bg: "#eef9e8",
        pics: [
            { name: "Zandri",  phone: "082290057007" },
            { name: "Mokthar", phone: "085240659917" },
        ]
    },
    {
        name: "Simposium Internasional & Rakernas JKPI",
        icon: "bi-mic-fill",
        color: "#3abf6e",
        bg: "#e8f9f0",
        pics: [
            { name: "Maulana", phone: "081328386512" },
            { name: "Thamrin", phone: "085255225322" },
        ]
    },
    {
        name: "Gelar Budaya & Penyerahan Pataka",
        icon: "bi-award-fill",
        color: "#4db3e6",
        bg: "#e8f4fb",
        pics: [
            { name: "Nuryadin", phone: "082346955379" },
            { name: "Zandri",   phone: "082290057007" },
        ]
    },
    {
        name: "Penjemputan & Kepulangan",
        icon: "bi-airplane-fill",
        color: "#9b59b6",
        bg: "#f5eefb",
        pics: [
            { name: "Adi Said",  phone: "081383612069" },
            { name: "Eko Fauzi", phone: "081380570875" },
        ]
    },
];

// ========== RENDER ==========
function render() {
    const search = document.getElementById('picSearch').value.toLowerCase().trim();

    const filtered = eventData.filter(ev => {
        const picNames = ev.pics.map(p => p.name).join(' ').toLowerCase();
        return ev.name.toLowerCase().includes(search) || picNames.includes(search);
    });

    document.getElementById('picCount').textContent = filtered.length;
    const gridEl   = document.getElementById('eventGrid');
    const noResult = document.getElementById('noResults');

    if (filtered.length === 0) {
        gridEl.innerHTML = '';
        noResult.style.display = 'block';
        return;
    }

    noResult.style.display = 'none';

    gridEl.innerHTML = filtered.map((ev, i) => {
        const picsHtml = ev.pics.map(p => {
            const waNum = '62' + p.phone.replace(/^0/, '');
            return `
                <div class="pic-person">
                    <div class="pic-person-wrap">
                        <div class="pic-person-avatar" style="background:${ev.color};"></div>
                        <div class="pic-person-avatar-icon"><i class="bi bi-person-fill" style="color:${ev.color};"></i></div>
                    </div>
                    <div class="pic-person-info">
                        <div class="pic-person-name">${p.name}</div>
                        <div class="pic-person-phone">
                            <a href="tel:${p.phone}">
                                <i class="bi bi-telephone-fill"></i>${p.phone}
                            </a>
                        </div>
                    </div>
                    <a href="https://wa.me/${waNum}" target="_blank" class="wa-btn" title="Chat WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            `;
        }).join('');

        return `
            <div class="event-card" style="--event-color:${ev.color}; --event-bg:${ev.bg}; animation-delay:${Math.min(i * 0.06, 0.5)}s;">
                <div class="event-card-header">
                    <div class="event-icon" style="background:${ev.color};">
                        <i class="bi ${ev.icon}"></i>
                    </div>
                    <div class="event-name">${ev.name}</div>
                    <span class="event-badge" style="background:${ev.bg}; color:${ev.color};">PIC</span>
                </div>
                <div class="event-contacts">${picsHtml}</div>
            </div>
        `;
    }).join('');
}

// ========== EVENTS ==========
document.getElementById('picSearch').addEventListener('input', render);

document.addEventListener('DOMContentLoaded', render);
</script>
@endpush