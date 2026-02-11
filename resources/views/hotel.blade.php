@extends('layouts.main')

@section('title', 'Daftar Akomodasi - Rakernas XII JKPI 2026 Kota Ternate')

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
            --green: #1a8a5c;
            --green-light: #e8f5ee;
            --blue: #2874a6;
            --blue-light: #eaf2f8;
            --purple: #7d3c98;
            --purple-light: #f4ecf7;
            --gray: #6c757d;
            --gray-light: #f8f9fa;
            --dark: #1a1a2e;
        }

        /* ========== HERO SECTION ========== */
        .akomodasi-hero {
            position: relative;
            padding: 140px 0 80px;
            background: linear-gradient(135deg, #0a2a3c 0%, #0d4f5e 40%, #099aa7 100%);
            overflow: hidden;
            color: white;
        }

        .akomodasi-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.6;
        }

        .akomodasi-hero .container {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.85rem;
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
            font-size: 1.15rem;
            opacity: 0.85;
            max-width: 600px;
            line-height: 1.6;
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 36px;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat-number {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            display: block;
        }

        .hero-stat-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.7;
        }

        /* ========== MAIN CONTENT ========== */
        .akomodasi-content {
            padding: 0 0 80px;
            background: #f5f7fa;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .toolbar-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            padding: 24px 28px;
            margin-top: -40px;
            position: relative;
            z-index: 10;
            margin-bottom: 30px;
        }

        .toolbar-row {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
        }

        .search-box {
            flex: 1;
            min-width: 280px;
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            font-size: 1.1rem;
        }

        .search-box input {
            width: 100%;
            padding: 13px 18px 13px 46px;
            border: 2px solid #e8eef2;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s;
            background: var(--gray-light);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(9, 154, 167, 0.1);
        }

        .filter-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-pill {
            padding: 10px 18px;
            border-radius: 50px;
            border: 2px solid #e8eef2;
            background: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #666;
            white-space: nowrap;
        }

        .filter-pill:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .filter-pill.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .result-count {
            font-size: 0.9rem;
            color: #999;
            font-weight: 600;
            white-space: nowrap;
        }

        .result-count strong {
            color: var(--primary);
        }

        /* ========== HOTEL CARDS GRID ========== */
        .hotel-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 20px;
        }

        .hotel-card {
            background: #fff;
            border-radius: 14px;
            border: 2px solid #eef1f5;
            padding: 22px 24px;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }

        .hotel-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #e0e0e0;
            transition: background 0.3s;
        }

        .hotel-card:hover {
            border-color: var(--primary);
            box-shadow: 0 8px 28px rgba(9, 154, 167, 0.12);
            transform: translateY(-3px);
        }

        .hotel-card:hover::before {
            background: var(--primary);
        }

        .hotel-card.type-bintang::before {
            background: var(--gold);
        }

        .hotel-card.type-melati::before {
            background: var(--green);
        }

        .hotel-card.type-villa::before {
            background: var(--blue);
        }

        .hotel-card.type-pondok::before {
            background: var(--purple);
        }

        .hotel-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .hotel-number {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--gray-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            color: #999;
            flex-shrink: 0;
        }

        .hotel-type-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .badge-bintang {
            background: var(--gold-light);
            color: var(--gold);
        }

        .badge-melati {
            background: var(--green-light);
            color: var(--green);
        }

        .badge-villa {
            background: var(--blue-light);
            color: var(--blue);
        }

        .badge-pondok {
            background: var(--purple-light);
            color: var(--purple);
        }

        .badge-other {
            background: var(--gray-light);
            color: var(--gray);
        }

        .hotel-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .hotel-address {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.85rem;
            color: #888;
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .hotel-address i {
            color: var(--primary);
            margin-top: 3px;
            flex-shrink: 0;
        }

        .hotel-contact-box {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: var(--primary-light);
            border-radius: 10px;
            transition: background 0.2s;
        }

        .hotel-contact-box:hover {
            background: #d0f0f3;
        }

        .hotel-contact-box i {
            color: var(--primary);
            font-size: 1.1rem;
        }

        .hotel-contact-box a {
            color: var(--primary-dark);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .hotel-contact-box a:hover {
            text-decoration: underline;
        }

        /* ========== TABLE VIEW ========== */
        .view-toggle {
            display: flex;
            gap: 4px;
            background: var(--gray-light);
            border-radius: 10px;
            padding: 4px;
        }

        .view-btn {
            padding: 8px 14px;
            border: none;
            border-radius: 8px;
            background: transparent;
            cursor: pointer;
            font-size: 1rem;
            color: #999;
            transition: all 0.2s;
        }

        .view-btn.active {
            background: #fff;
            color: var(--primary);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .table-view {
            display: none;
        }

        .table-view.active {
            display: block;
        }

        .grid-view.active {
            display: grid;
        }

        .akomodasi-table-wrap {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            border: 2px solid #eef1f5;
        }

        .akomodasi-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .akomodasi-table thead th {
            background: var(--primary);
            color: #fff;
            padding: 14px 18px;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 5;
        }

        .akomodasi-table thead th:first-child {
            width: 55px;
            text-align: center;
        }

        .akomodasi-table tbody tr {
            border-bottom: 1px solid #f0f2f5;
            transition: background 0.2s;
        }

        .akomodasi-table tbody tr:hover {
            background: var(--primary-light);
        }

        .akomodasi-table tbody td {
            padding: 14px 18px;
            vertical-align: middle;
            color: #444;
        }

        .akomodasi-table tbody td:first-child {
            text-align: center;
            font-weight: 700;
            color: #bbb;
        }

        .table-hotel-name {
            font-weight: 700;
            color: var(--dark);
        }

        .table-hotel-address {
            font-size: 0.82rem;
            color: #999;
            margin-top: 2px;
        }

        .table-contact {
            font-weight: 600;
            color: var(--primary);
        }

        .table-contact a {
            color: var(--primary);
            text-decoration: none;
        }

        .table-contact a:hover {
            text-decoration: underline;
        }

        /* ========== NO RESULTS ========== */
        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #bbb;
        }

        .no-results i {
            font-size: 3rem;
            margin-bottom: 16px;
            display: block;
        }

        .no-results p {
            font-size: 1rem;
            font-weight: 500;
        }

        /* ========== RESPONSIVE ========== */

        /* Large tablets / small desktops */
        @media (max-width: 1200px) {
            .hotel-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 16px;
            }
        }

        /* Tablets */
        @media (max-width: 992px) {
            .akomodasi-hero {
                padding: 120px 0 70px;
            }

            .hero-title {
                font-size: 2.4rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-stats {
                gap: 28px;
            }

            .hero-stat-number {
                font-size: 1.8rem;
            }

            .hotel-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .toolbar-row {
                flex-wrap: wrap;
            }

            .search-box {
                min-width: 100%;
            }

            .filter-group {
                width: 100%;
                overflow-x: auto;
                flex-wrap: nowrap;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                -ms-overflow-style: none;
                padding-bottom: 4px;
            }

            .filter-group::-webkit-scrollbar {
                display: none;
            }
        }

        /* Small tablets / large phones */
        @media (max-width: 768px) {
            .akomodasi-hero {
                padding: 110px 0 60px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-stats {
                gap: 16px;
                flex-wrap: wrap;
            }

            .hero-stat {
                min-width: 45%;
            }

            .hero-stat-number {
                font-size: 1.6rem;
            }

            .hero-stat-label {
                font-size: 0.72rem;
            }

            .toolbar-card {
                padding: 16px 14px;
                margin-top: -30px;
                border-radius: 14px;
            }

            .toolbar-row {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            .search-box input {
                padding: 12px 14px 12px 42px;
            }

            .view-toggle {
                align-self: flex-end;
            }

            .result-count {
                text-align: center;
            }

            .hotel-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .hotel-card {
                padding: 18px 18px;
            }

            .hotel-name {
                font-size: 1rem;
            }

            .hotel-address {
                font-size: 0.82rem;
            }

            /* Table responsive: horizontal scroll */
            .akomodasi-table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .akomodasi-table {
                min-width: 600px;
                font-size: 0.82rem;
            }

            .akomodasi-table thead th,
            .akomodasi-table tbody td {
                padding: 10px 12px;
            }
        }

        /* Mobile phones */
        @media (max-width: 480px) {
            .akomodasi-hero {
                padding: 100px 0 50px;
            }

            .hero-badge {
                font-size: 0.75rem;
                padding: 6px 14px;
            }

            .hero-title {
                font-size: 1.6rem;
            }

            .hero-subtitle {
                font-size: 0.9rem;
            }

            .hero-stats {
                gap: 12px;
                margin-top: 24px;
            }

            .hero-stat {
                min-width: calc(50% - 12px);
            }

            .hero-stat-number {
                font-size: 1.4rem;
            }

            .toolbar-card {
                padding: 14px 12px;
                margin-top: -24px;
                border-radius: 12px;
            }

            .filter-pill {
                padding: 8px 14px;
                font-size: 0.78rem;
            }

            .hotel-card {
                padding: 16px 14px;
                border-radius: 12px;
            }

            .hotel-card-header {
                margin-bottom: 10px;
            }

            .hotel-number {
                width: 28px;
                height: 28px;
                font-size: 0.72rem;
            }

            .hotel-type-badge {
                font-size: 0.7rem;
                padding: 3px 8px;
            }

            .hotel-name {
                font-size: 0.95rem;
            }

            .hotel-address {
                font-size: 0.78rem;
                margin-bottom: 12px;
            }

            .hotel-contact-box {
                padding: 9px 12px;
                border-radius: 8px;
            }

            .hotel-contact-box a {
                font-size: 0.82rem;
            }

            .akomodasi-table {
                min-width: 540px;
                font-size: 0.78rem;
            }

            .akomodasi-table thead th {
                padding: 10px 10px;
                font-size: 0.72rem;
            }

            .akomodasi-table tbody td {
                padding: 10px 10px;
            }
        }

        /* Very small phones */
        @media (max-width: 360px) {
            .hero-title {
                font-size: 1.4rem;
            }

            .hero-subtitle {
                font-size: 0.85rem;
            }

            .hero-stat-number {
                font-size: 1.2rem;
            }

            .hotel-card {
                padding: 14px 12px;
            }

            .filter-pill {
                padding: 7px 12px;
                font-size: 0.74rem;
            }
        }

        /* ========== ANIMATIONS ========== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hotel-card {
            animation: fadeInUp 0.4s ease forwards;
            opacity: 0;
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="akomodasi-hero">
        <div class="container">
            <div class="hero-badge"><i class="bi bi-building me-2"></i>Informasi Akomodasi</div>
            <h1 class="hero-title text-white">Data Akomodasi<br>Kota Ternate</h1>
            <p class="hero-subtitle">
                Daftar lengkap hotel, wisma, villa, dan pondok wisata di Kota Ternate
                untuk peserta Rakernas XII JKPI 2026.
            </p>
            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-number" id="statTotal">107</span>
                    <span class="hero-stat-label">Total Akomodasi</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-number" id="statBintang">0</span>
                    <span class="hero-stat-label">Hotel Bintang</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-number" id="statMelati">0</span>
                    <span class="hero-stat-label">Hotel Melati</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-number" id="statPondok">0</span>
                    <span class="hero-stat-label">Pondok / Villa</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="akomodasi-content">
        <div class="container">

            <!-- TOOLBAR -->
            <div class="toolbar-card">
                <div class="toolbar-row">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" id="hotelSearch" placeholder="Cari nama hotel, alamat, atau kontak...">
                    </div>
                    <div class="filter-group">
                        <button type="button" class="filter-pill active" data-filter="all">Semua</button>
                        <button type="button" class="filter-pill" data-filter="bintang"><i
                                class="bi bi-star-fill me-1"></i>Hotel Bintang</button>
                        <button type="button" class="filter-pill" data-filter="melati">Hotel Melati</button>
                        <button type="button" class="filter-pill" data-filter="villa">Villa</button>
                        <button type="button" class="filter-pill" data-filter="pondok">Pondok Wisata</button>
                    </div>
                    <div class="view-toggle">
                        <button type="button" class="view-btn active" data-view="grid" title="Tampilan Grid"><i
                                class="bi bi-grid-3x3-gap-fill"></i></button>
                        <button type="button" class="view-btn" data-view="table" title="Tampilan Tabel"><i
                                class="bi bi-list-ul"></i></button>
                    </div>
                    <div class="result-count">Menampilkan <strong id="hotelCount">107</strong> akomodasi</div>
                </div>
            </div>

            <!-- GRID VIEW -->
            <div class="hotel-grid grid-view active" id="gridView"></div>

            <!-- TABLE VIEW -->
            <div class="table-view" id="tableView">
                <div class="akomodasi-table-wrap">
                    <table class="akomodasi-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Hotel / Penginapan</th>
                                <th>Kategori</th>
                                <th>Kontak Reservasi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody"></tbody>
                    </table>
                </div>
            </div>

            <!-- NO RESULTS -->
            <div class="no-results" id="noResults" style="display: none;">
                <i class="bi bi-building-slash"></i>
                <p>Tidak ada akomodasi yang sesuai pencarian Anda.</p>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // ========== DATA 107 AKOMODASI ==========
        const hotelData = [{
                no: 1,
                name: "Bela Hotel",
                address: "Jln. Raya Jati No.500, Kel. Jati",
                type: "Hotel Bintang",
                contact: "0921-3121800"
            },
            {
                no: 2,
                name: "Muara Hotel",
                address: "Jln. Merdeka No.19, Kel. Gamalama",
                type: "Hotel Bintang",
                contact: "0821-9500-1919"
            },
            {
                no: 3,
                name: "Emerald Hotel",
                address: "Kel. Santiong",
                type: "Hotel Bintang",
                contact: "0852-4180-6283"
            },
            {
                no: 4,
                name: "Gwen Hotel",
                address: "Jln. Sultan Iskandar Muhamad Jabir Sjah, Kel. Gamalama",
                type: "Hotel Bintang",
                contact: "0811-433-446"
            },
            {
                no: 5,
                name: "Batik Hotel",
                address: "Jln. Kapitan Pattimura No.16, Kel. Stadion",
                type: "Hotel Bintang",
                contact: "0811-4343-343 / 0812-4297-7800"
            },
            {
                no: 6,
                name: "Grand Majang Hotel",
                address: "Jln. Arnold Mononutu, Kel. Kampung Pisang",
                type: "Hotel Bintang",
                contact: "0812-3127-0968 / 0812-4174-3311"
            },
            {
                no: 7,
                name: "Miranty Inn",
                address: "Jln. MT Habib Abubakar Al-Attas No.12, Kel. Gamalama",
                type: "Pondok Wisata",
                contact: "0812-4192-1513"
            },
            {
                no: 8,
                name: "Belson",
                address: "Jln. Rambutan, Kel. Makassar Barat",
                type: "Hotel Melati",
                contact: "0822-3644-7778"
            },
            {
                no: 9,
                name: "Austine Hotel",
                address: "Kel. Gamalama",
                type: "Hotel Bintang",
                contact: "0921-3110815"
            },
            {
                no: 10,
                name: "Safirna Golden Hotel",
                address: "Kel. Stadion",
                type: "Hotel Melati",
                contact: "081244264425"
            },
            {
                no: 11,
                name: "New El-Shinta Hotel",
                address: "Jln. Pahlawan Revolusi No.58-60, Kel. Gamalama",
                type: "Hotel Bintang",
                contact: "0852-1789-9888"
            },
            {
                no: 12,
                name: "Neraca Golden Hotel",
                address: "Kel. Gamalama",
                type: "Hotel Melati",
                contact: "0821-9115-1000"
            },
            {
                no: 13,
                name: "Vila Marasai",
                address: "Kel. Fitu",
                type: "Villa",
                contact: "085218180937"
            },
            {
                no: 14,
                name: "Red Budget Hotel",
                address: "Jln. Branjangan No.9, Santiong",
                type: "Hotel Melati",
                contact: "0921-6208241"
            },
            {
                no: 15,
                name: "Hotel Jati",
                address: "Kel. Jati",
                type: "Hotel Melati",
                contact: "0852-4900-0964"
            },
            {
                no: 16,
                name: "Safirna Transito",
                address: "Jln. Anggrek, Kel. Kota Baru",
                type: "Hotel Melati",
                contact: "0812-4200-0243"
            },
            {
                no: 17,
                name: "D'Wantys Hotel",
                address: "Jerbus, Kel. Tanah Tinggi Barat",
                type: "Hotel Melati",
                contact: "0921-6203046 / 081280249646"
            },
            {
                no: 18,
                name: "Hotel Dragon Palace",
                address: "Kel. Maliaro",
                type: "Hotel Melati",
                contact: "081340503311"
            },
            {
                no: 19,
                name: "Hotel Forum",
                address: "Jln. Pahlawan Revolusi, Kel. Gamalama",
                type: "Hotel Melati",
                contact: "0811-4319-122"
            },
            {
                no: 20,
                name: "Neraca Golden Hotel",
                address: "Kel. Gamalama",
                type: "Hotel Melati",
                contact: "0821-9115-1000"
            },
            {
                no: 21,
                name: "Surya Pagi",
                address: "Kel. Stadion",
                type: "Hotel Melati",
                contact: "0821-8706-5052"
            },
            {
                no: 22,
                name: "Losmen Kita",
                address: "Kel. Stadion",
                type: "Hotel Melati",
                contact: "081244616424"
            },
            {
                no: 23,
                name: "Boulevard Hotel",
                address: "Jln. Sultan Iskandar Muhamad Djabir Sjah No.1-5, Kel. Gamalama",
                type: "Hotel Bintang",
                contact: "0921-3110666"
            },
            {
                no: 24,
                name: "Gamalama Indah",
                address: "Jln. Sultan Iskandar Muhamad Jabir Sjah, Kel. Gamalama",
                type: "Hotel Melati",
                contact: "082114437660"
            },
            {
                no: 25,
                name: "Hotel Archie",
                address: "Jl. Nuku 6, Kel. Muhajirin",
                type: "Hotel Bintang",
                contact: "0813-5636-3383 / 0921-3110555"
            },
            {
                no: 26,
                name: "Hotel Archie 2",
                address: "Jln. Nuku 100, Kel. Muhajirin",
                type: "Hotel Bintang",
                contact: "0813-5636-3383"
            },
            {
                no: 27,
                name: "Hotel Menara Archie",
                address: "Jln. Nuku 101, Kel. Muhajirin",
                type: "Hotel Bintang",
                contact: "0813-5636-3383"
            },
            {
                no: 28,
                name: "Ternate City Hotel",
                address: "Jln. Nuku, Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "0813-2782-4005"
            },
            {
                no: 29,
                name: "Ayu Lestari",
                address: "Jln. Raya Bastiong",
                type: "Hotel Bintang",
                contact: "0812-4456-326"
            },
            {
                no: 30,
                name: "Corner Palace Hotel",
                address: "Jln. Stadion, Kel. Kampung Pisang",
                type: "Hotel Bintang",
                contact: "0813-4362-6106"
            },
            {
                no: 31,
                name: "Nirwana Hotel",
                address: "Kel. Gamalama",
                type: "Hotel Melati",
                contact: "082192226300"
            },
            {
                no: 32,
                name: "Hotel Nusantara",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "(0921) 3126154 / 081244986182"
            },
            {
                no: 33,
                name: "Aranis Transit Motel",
                address: "Kel. Mangga Dua Utara",
                type: "Hotel Melati",
                contact: "085394088579"
            },
            {
                no: 34,
                name: "Aranis Pondok Wisata",
                address: "Kel. Mangga Dua Utara",
                type: "Hotel Melati",
                contact: "0821-8846-2210"
            },
            {
                no: 35,
                name: "KBI Hostel Syariah",
                address: "Kel. Mangga Dua",
                type: "Hotel Melati",
                contact: "0822-5015-13862"
            },
            {
                no: 36,
                name: "Ananda Hotel",
                address: "Jln. Raya Bastiong Karance, Kec. Ternate Selatan",
                type: "Hotel Melati",
                contact: "0813-3576-5265"
            },
            {
                no: 37,
                name: "Tiara Inn",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "081269644950"
            },
            {
                no: 38,
                name: "Lemon Inn",
                address: "Kel. Gamalama",
                type: "Hotel Melati",
                contact: "0813-4033-6999"
            },
            {
                no: 39,
                name: "Penginapan Semangat 3",
                address: "Jln. Rawa Bening, Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "0822-9103-0556 / 081243638377"
            },
            {
                no: 40,
                name: "Wisma Aira",
                address: "Kel. Soasio",
                type: "Hotel Melati",
                contact: "0812-4363-8377"
            },
            {
                no: 41,
                name: "Wisma D'Boss",
                address: "Kel. Mangga Dua",
                type: "Hotel Melati",
                contact: "0811-4322-356"
            },
            {
                no: 42,
                name: "Wisma Holiday",
                address: "Kel. Gamalama",
                type: "Hotel Melati",
                contact: "0853-4974-9842"
            },
            {
                no: 43,
                name: "Shari Inn 1",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "0812-4313-2654"
            },
            {
                no: 44,
                name: "Shari Inn 2",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "0812-4313-2654"
            },
            {
                no: 45,
                name: "Losmen Anggrek A",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "0821-9856-1209"
            },
            {
                no: 46,
                name: "Anggrek Homestay",
                address: "Kel. Kota Baru",
                type: "Hotel Melati",
                contact: "0813-8540-9040"
            },
            {
                no: 47,
                name: "Losmen Anggrek B",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "081385409040"
            },
            {
                no: 48,
                name: "Losmen Anggrek C",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "081385409040"
            },
            {
                no: 49,
                name: "Romantika Losmen",
                address: "Kel. Kayu Merah",
                type: "Pondok Wisata",
                contact: "0853-1517-7733"
            },
            {
                no: 50,
                name: "Penginapan Vista",
                address: "Kel. Gamalama",
                type: "Hotel Melati",
                contact: "0921-3122-070"
            },
            {
                no: 51,
                name: "Falajawa Residence",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "081341028175"
            },
            {
                no: 52,
                name: "Guest House Villa Java",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "082195555522"
            },
            {
                no: 53,
                name: "Tidore Indah Guest House",
                address: "Kel. Kampung Pisang",
                type: "Hotel Melati",
                contact: "0823-5283-0305"
            },
            {
                no: 54,
                name: "Saqavia Guest House",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "082291360007"
            },
            {
                no: 55,
                name: "Guesthouse Takoma Indah",
                address: "Kel. Takoma",
                type: "Hotel Melati",
                contact: "0812-4583-5054"
            },
            {
                no: 56,
                name: "CV. Villajava",
                address: "Kel. Kampung Pisang",
                type: "Pondok Wisata",
                contact: "0821-1113-2123"
            },
            {
                no: 57,
                name: "Rumah Ngade",
                address: "Kel. Ngade",
                type: "Hotel Melati",
                contact: "0895-4173-0072"
            },
            {
                no: 58,
                name: "Penginapan Tri Mujur Jaya",
                address: "Kel. Kota Baru",
                type: "Hotel Melati",
                contact: "0813-5628-6857"
            },
            {
                no: 59,
                name: "Penginapan Cahaya Baru",
                address: "Kel. Tanah Tinggi",
                type: "Hotel Melati",
                contact: "0812-4402-9753"
            },
            {
                no: 60,
                name: "Penginapan Yamin 1",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "0812-5986-2832"
            },
            {
                no: 61,
                name: "Penginapan Yamin 2",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "0812-5986-2832"
            },
            {
                no: 62,
                name: "Penginapan Nusahulawano",
                address: "Kel. Kota Baru",
                type: "Hotel Melati",
                contact: "0813-5502-1986"
            },
            {
                no: 63,
                name: "Penginapan Kembar Mas",
                address: "Kel. Bastiong",
                type: "Hotel Melati",
                contact: "0821-9256-9274"
            },
            {
                no: 64,
                name: "Penginapan Nusa Ina",
                address: "Kel. Tanah Tinggi",
                type: "Hotel Melati",
                contact: "0813-4204-2007"
            },
            {
                no: 65,
                name: "Penginapan Rahmat",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "0821-9008-0663"
            },
            {
                no: 66,
                name: "Penginapan Sidar",
                address: "Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "0813-4121-1483"
            },
            {
                no: 67,
                name: "Penginapan Sulawesi",
                address: "Kel. Bastiong",
                type: "Hotel Melati",
                contact: "0812-9887-9877"
            },
            {
                no: 68,
                name: "Penginapan H. Khan",
                address: "Kel. Tanah Raja",
                type: "Hotel Melati",
                contact: "0813-5566-0674"
            },
            {
                no: 69,
                name: "Penginapan R&D 01 Ternate",
                address: "Kel. Maliaro",
                type: "Hotel Melati",
                contact: "081342006862"
            },
            {
                no: 70,
                name: "Penginapan Sinar",
                address: "Kel. Takoma",
                type: "Pondok Wisata",
                contact: "0813-4029-8795"
            },
            {
                no: 71,
                name: "Penginapan Sentosa",
                address: "Kel. Muhajirin",
                type: "Pondok Wisata",
                contact: "0813-8435-7019"
            },
            {
                no: 72,
                name: "Penginapan Adi",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "0813-4037-4473"
            },
            {
                no: 73,
                name: "Penginapan Tamasa",
                address: "Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "0813-5034-6266"
            },
            {
                no: 74,
                name: "Penginapan Semangat 1",
                address: "Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "0812-3638-377"
            },
            {
                no: 75,
                name: "Penginapan Semangat 2",
                address: "Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "0812-4363-8377"
            },
            {
                no: 76,
                name: "Penginapan Rahman 01",
                address: "Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "0812-4430-4186 / 0823-3793-7897"
            },
            {
                no: 77,
                name: "Penginapan Rahman 02",
                address: "Kel. Bastiong",
                type: "Hotel Melati",
                contact: "082191011005"
            },
            {
                no: 78,
                name: "Pondok Wisata Andi Bella",
                address: "Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "0813-1224-9577"
            },
            {
                no: 79,
                name: "Penginapan 46",
                address: "Kel. Bastiong Karance",
                type: "Hotel Melati",
                contact: "0823-9911-2270"
            },
            {
                no: 80,
                name: "Penginapan Syariah",
                address: "Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "082296566410"
            },
            {
                no: 81,
                name: "Penginapan Syariah Senang 2",
                address: "Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "082296566410"
            },
            {
                no: 82,
                name: "Penginapan Ampera",
                address: "Kel. Makassar Timur",
                type: "Hotel Melati",
                contact: "085145757999"
            },
            {
                no: 83,
                name: "Penginapan Nania",
                address: "Kel. Bastiong",
                type: "Hotel Melati",
                contact: "081243358001"
            },
            {
                no: 84,
                name: "Penginapan Simpatik",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "081244875340"
            },
            {
                no: 85,
                name: "Penginapan Mandiri 1",
                address: "Kel. Stadion",
                type: "Pondok Wisata",
                contact: "0821-8888-3145"
            },
            {
                no: 86,
                name: "Penginapan Mandiri 2",
                address: "Kel. Stadion",
                type: "Pondok Wisata",
                contact: "0821-8888-3145"
            },
            {
                no: 87,
                name: "Penginapan Bahari",
                address: "Kel. Muhajirin",
                type: "Hotel Melati",
                contact: "0821-4736-1987"
            },
            {
                no: 88,
                name: "Penginapan Naniah",
                address: "Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "081243358001"
            },
            {
                no: 89,
                name: "Penginapan Sehati",
                address: "Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "081341174000"
            },
            {
                no: 90,
                name: "Penginapan Fatma",
                address: "Kel. Bastiong Talangame",
                type: "Hotel Melati",
                contact: "085299975777"
            },
            {
                no: 91,
                name: "Rekreasi Pantai Bobane Ici",
                address: "Kel. Dorpedu",
                type: "Pondok Wisata",
                contact: "082194551685"
            },
            {
                no: 92,
                name: "Kurnia Home Stay",
                address: "Kel. Maliaro",
                type: "Pondok Wisata",
                contact: "082188887379"
            },
            {
                no: 93,
                name: "Meizar Home Stay",
                address: "Kel. Ubo Ubo",
                type: "Pondok Wisata",
                contact: "0822-8295-7958"
            },
            {
                no: 94,
                name: "Pipi Kado Home Stay",
                address: "Kel. Bastiong",
                type: "Pondok Wisata",
                contact: "0813-1985-7115"
            },
            {
                no: 95,
                name: "Hiri Homestay",
                address: "Kel. Togolobe (Pulau Hiri)",
                type: "Pondok Wisata",
                contact: "0822-3958-0612"
            },
            {
                no: 96,
                name: "Abimanyu Homestay",
                address: "Kel. Kayu Merah",
                type: "Hotel Melati",
                contact: "0813-4356-2522"
            },
            {
                no: 97,
                name: "Homestay Alaika",
                address: "Kel. Maliaro (Belakang Kesbangpol)",
                type: "Pondok Wisata",
                contact: "081211918388"
            },
            {
                no: 98,
                name: "Penginapan Elcopa",
                address: "Kel. Bastiong Talangame",
                type: "Pondok Wisata",
                contact: "082395220198"
            },
            {
                no: 99,
                name: "Aini Homestay",
                address: "Kel. Toboleu",
                type: "Pondok Wisata",
                contact: "0812-4752-595"
            },
            {
                no: 100,
                name: "Riswan Homestay",
                address: "Kel. Sangaji",
                type: "Pondok Wisata",
                contact: "085146130048"
            },
            {
                no: 101,
                name: "ABZ",
                address: "Kel. Muhajirin",
                type: "Pondok Wisata",
                contact: "0813-4102-8175"
            },
            {
                no: 102,
                name: "Clarissa Homestay",
                address: "Kel. Tanah Tinggi",
                type: "Pondok Wisata",
                contact: "081340357145"
            },
            {
                no: 103,
                name: "Riswan Homestay 2",
                address: "Kel. Salero",
                type: "Pondok Wisata",
                contact: "08124015457"
            },
            {
                no: 104,
                name: "Lilian Beach Resort",
                address: "Kel. Takome",
                type: "Villa",
                contact: "0813-5688-8806 / 0821-9265-5655"
            },
            {
                no: 105,
                name: "Penginapan Rizki Maba",
                address: "Kel. Bastiong",
                type: "Hotel Melati",
                contact: "0813-4240-8909"
            },
            {
                no: 106,
                name: "Muara Inn",
                address: "Kel. Kampung Pisang",
                type: "Hotel Melati",
                contact: "082199389325"
            },
            {
                no: 107,
                name: "Anda Baru Corner Hotel",
                address: "Kel. Gamalama",
                type: "Hotel Melati",
                contact: "0811439428"
            },
        ];

        // ========== HELPERS ==========
        let currentFilter = 'all';
        let currentView = 'grid';

        function getCategory(type) {
            const t = type.toLowerCase();
            if (t.includes('bintang')) return 'bintang';
            if (t.includes('melati')) return 'melati';
            if (t.includes('villa') || t.includes('vila')) return 'villa';
            if (t.includes('pondok') || t.includes('home stay') || t.includes('homestay')) return 'pondok';
            return 'other';
        }

        function getBadgeClass(cat) {
            return {
                bintang: 'badge-bintang',
                melati: 'badge-melati',
                villa: 'badge-villa',
                pondok: 'badge-pondok'
            } [cat] || 'badge-other';
        }

        function getBadgeIcon(cat) {
            return {
                bintang: '<i class="bi bi-star-fill me-1"></i>',
                melati: '<i class="bi bi-flower1 me-1"></i>',
                villa: '<i class="bi bi-house-heart me-1"></i>',
                pondok: '<i class="bi bi-house-door me-1"></i>'
            } [cat] || '';
        }

        function toWhatsApp(phone) {
            // Bersihkan nomor, ambil nomor pertama jika ada multiple
            let num = phone.split('/')[0].trim();
            num = num.replace(/[^0-9]/g, '');
            // Konversi 08xx ke 628xx
            if (num.startsWith('0')) {
                num = '62' + num.substring(1);
            }
            // Jika sudah 62xxx, biarkan
            if (!num.startsWith('62')) {
                num = '62' + num;
            }
            return 'https://wa.me/' + num;
        }

        function formatContacts(contact) {
            // Split multiple contacts
            const phones = contact.split('/').map(p => p.trim()).filter(Boolean);
            return phones.map(p => {
                const waLink = toWhatsApp(p);
                return `<a href="${waLink}" target="_blank" rel="noopener"><i class="bi bi-whatsapp me-1"></i>${p}</a>`;
            }).join('<span class="contact-divider"> / </span>');
        }

        // ========== UPDATE STATS ==========
        function updateStats() {
            let bintang = 0,
                melati = 0,
                pondok = 0;
            hotelData.forEach(h => {
                const c = getCategory(h.type);
                if (c === 'bintang') bintang++;
                else if (c === 'melati') melati++;
                else pondok++;
            });
            document.getElementById('statTotal').textContent = hotelData.length;
            document.getElementById('statBintang').textContent = bintang;
            document.getElementById('statMelati').textContent = melati;
            document.getElementById('statPondok').textContent = pondok;
        }

        // ========== RENDER ==========
        function render() {
            const search = document.getElementById('hotelSearch').value.toLowerCase();

            const filtered = hotelData.filter(h => {
                const matchSearch = h.name.toLowerCase().includes(search) || h.address.toLowerCase().includes(
                    search) || h.contact.toLowerCase().includes(search);
                const cat = getCategory(h.type);
                const matchFilter = currentFilter === 'all' || cat === currentFilter;
                return matchSearch && matchFilter;
            });

            document.getElementById('hotelCount').textContent = filtered.length;

            const gridEl = document.getElementById('gridView');
            const tableBody = document.getElementById('tableBody');
            const noResults = document.getElementById('noResults');

            if (filtered.length === 0) {
                gridEl.innerHTML = '';
                tableBody.innerHTML = '';
                noResults.style.display = 'block';
                return;
            }

            noResults.style.display = 'none';

            // Grid view
            gridEl.innerHTML = filtered.map((h, i) => {
                const cat = getCategory(h.type);
                return `
                <div class="hotel-card type-${cat}" style="animation-delay: ${Math.min(i * 0.03, 0.6)}s">
                    <div class="hotel-card-header">
                        <div class="hotel-number">${h.no}</div>
                        <span class="hotel-type-badge ${getBadgeClass(cat)}">${getBadgeIcon(cat)}${h.type}</span>
                    </div>
                    <div class="hotel-name">${h.name}</div>
                    <div class="hotel-address">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>${h.address}</span>
                    </div>
                    <div class="hotel-contact-box">
                        <i class="bi bi-whatsapp"></i>
                        ${formatContacts(h.contact)}
                    </div>
                </div>
            `;
            }).join('');

            // Table view
            tableBody.innerHTML = filtered.map(h => {
                const cat = getCategory(h.type);
                return `
                <tr>
                    <td>${h.no}</td>
                    <td>
                        <div class="table-hotel-name">${h.name}</div>
                        <div class="table-hotel-address">${h.address}</div>
                    </td>
                    <td><span class="hotel-type-badge ${getBadgeClass(cat)}">${h.type}</span></td>
                    <td class="table-contact">${formatContacts(h.contact)}</td>
                </tr>
            `;
            }).join('');
        }

        // ========== EVENT LISTENERS ==========
        document.getElementById('hotelSearch').addEventListener('input', render);

        document.querySelectorAll('.filter-pill').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentFilter = this.dataset.filter;
                render();
            });
        });

        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentView = this.dataset.view;

                const gridEl = document.getElementById('gridView');
                const tableEl = document.getElementById('tableView');

                if (currentView === 'grid') {
                    gridEl.classList.add('active');
                    gridEl.style.display = 'grid';
                    tableEl.classList.remove('active');
                    tableEl.style.display = 'none';
                } else {
                    gridEl.classList.remove('active');
                    gridEl.style.display = 'none';
                    tableEl.classList.add('active');
                    tableEl.style.display = 'block';
                }
            });
        });

        // ========== INIT ==========
        document.addEventListener('DOMContentLoaded', function() {
            updateStats();
            render();
        });
    </script>
@endpush
