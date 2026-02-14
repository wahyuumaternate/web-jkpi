@extends('layouts.main')

@section('title', 'Daftar Kuliner - Rakernas XII JKPI 2026 Kota Ternate')

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
            --red: #c0392b;
            --red-light: #fadbd8;
            --orange: #d68910;
            --orange-light: #fdebd0;
            --blue: #2874a6;
            --blue-light: #eaf2f8;
            --gray: #6c757d;
            --gray-light: #f8f9fa;
            --dark: #1a1a2e;
        }

        /* ========== HERO SECTION ========== */
        .kuliner-hero {
            position: relative;
            padding: 140px 0 80px;
            background: linear-gradient(135deg, #0a2a3c 0%, #0d4f5e 40%, #099aa7 100%);
            overflow: hidden;
            color: white;
        }

        .kuliner-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.6;
        }

        .kuliner-hero .container {
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
        .kuliner-content {
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

        /* ========== KULINER CARDS GRID ========== */
        .kuliner-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 20px;
        }

        .kuliner-card {
            background: #fff;
            border-radius: 14px;
            border: 2px solid #eef1f5;
            padding: 22px 24px;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }

        .kuliner-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #e0e0e0;
            transition: background 0.3s;
        }

        .kuliner-card:hover {
            border-color: var(--primary);
            box-shadow: 0 8px 28px rgba(9, 154, 167, 0.12);
            transform: translateY(-3px);
        }

        .kuliner-card:hover::before {
            background: var(--primary);
        }

        .kuliner-card.type-restoran::before {
            background: var(--red);
        }

        .kuliner-card.type-rumah-makan::before {
            background: var(--orange);
        }

        .kuliner-card.type-cafe::before {
            background: var(--blue);
        }

        .kuliner-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .kuliner-number {
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

        .kuliner-type-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .badge-restoran {
            background: var(--red-light);
            color: var(--red);
        }

        .badge-rumah-makan {
            background: var(--orange-light);
            color: var(--orange);
        }

        .badge-cafe {
            background: var(--blue-light);
            color: var(--blue);
        }

        .kuliner-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .kuliner-address {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.85rem;
            color: #888;
            line-height: 1.5;
        }

        .kuliner-address i {
            color: var(--primary);
            margin-top: 3px;
            flex-shrink: 0;
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

        .kuliner-table-wrap {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            border: 2px solid #eef1f5;
        }

        .kuliner-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .kuliner-table thead th {
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

        .kuliner-table thead th:first-child {
            width: 55px;
            text-align: center;
        }

        .kuliner-table tbody tr {
            border-bottom: 1px solid #f0f2f5;
            transition: background 0.2s;
        }

        .kuliner-table tbody tr:hover {
            background: var(--primary-light);
        }

        .kuliner-table tbody td {
            padding: 14px 18px;
            vertical-align: middle;
            color: #444;
        }

        .kuliner-table tbody td:first-child {
            text-align: center;
            font-weight: 700;
            color: #bbb;
        }

        .table-kuliner-name {
            font-weight: 700;
            color: var(--dark);
        }

        .table-kuliner-address {
            font-size: 0.82rem;
            color: #999;
            margin-top: 2px;
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
            .kuliner-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 16px;
            }
        }

        /* Tablets */
        @media (max-width: 992px) {
            .kuliner-hero {
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

            .kuliner-grid {
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
            .kuliner-hero {
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

            .kuliner-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .kuliner-card {
                padding: 18px 18px;
            }

            .kuliner-name {
                font-size: 1rem;
            }

            .kuliner-address {
                font-size: 0.82rem;
            }

            /* Table responsive: horizontal scroll */
            .kuliner-table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .kuliner-table {
                min-width: 600px;
                font-size: 0.82rem;
            }

            .kuliner-table thead th,
            .kuliner-table tbody td {
                padding: 10px 12px;
            }
        }

        /* Mobile phones */
        @media (max-width: 480px) {
            .kuliner-hero {
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

            .kuliner-card {
                padding: 16px 14px;
                border-radius: 12px;
            }

            .kuliner-card-header {
                margin-bottom: 10px;
            }

            .kuliner-number {
                width: 28px;
                height: 28px;
                font-size: 0.72rem;
            }

            .kuliner-type-badge {
                font-size: 0.7rem;
                padding: 3px 8px;
            }

            .kuliner-name {
                font-size: 0.95rem;
            }

            .kuliner-address {
                font-size: 0.78rem;
            }

            .kuliner-table {
                min-width: 540px;
                font-size: 0.78rem;
            }

            .kuliner-table thead th {
                padding: 10px 10px;
                font-size: 0.72rem;
            }

            .kuliner-table tbody td {
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

            .kuliner-card {
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

        .kuliner-card {
            animation: fadeInUp 0.4s ease forwards;
            opacity: 0;
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="kuliner-hero">
        <div class="container">
            <div class="hero-badge"><i class="bi bi-cup-hot me-2"></i>Kuliner Kota Ternate</div>
            <h1 class="hero-title text-white">Data Kuliner<br>Kota Ternate</h1>
            <p class="hero-subtitle">
                Daftar lengkap restoran, rumah makan, dan café di Kota Ternate
                untuk peserta Rakernas JKPI XII 2026.
            </p>
            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-number" id="statTotal">192</span>
                    <span class="hero-stat-label">Total Kuliner</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-number" id="statRestoran">31</span>
                    <span class="hero-stat-label">Restoran</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-number" id="statRumahMakan">114</span>
                    <span class="hero-stat-label">Rumah Makan</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-number" id="statCafe">47</span>
                    <span class="hero-stat-label">Café</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="kuliner-content">
        <div class="container">

            <!-- TOOLBAR -->
            <div class="toolbar-card">
                <div class="toolbar-row">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" id="kulinerSearch" placeholder="Cari nama tempat atau alamat...">
                    </div>
                    <div class="filter-group">
                        <button type="button" class="filter-pill active" data-filter="all">Semua</button>
                        <button type="button" class="filter-pill" data-filter="restoran"><i
                                class="bi bi-shop me-1"></i>Restoran</button>
                        <button type="button" class="filter-pill" data-filter="rumah-makan"><i
                                class="bi bi-house-door me-1"></i>Rumah Makan</button>
                        <button type="button" class="filter-pill" data-filter="cafe"><i
                                class="bi bi-cup-hot me-1"></i>Café</button>
                    </div>
                    <div class="view-toggle">
                        <button type="button" class="view-btn active" data-view="grid" title="Tampilan Grid"><i
                                class="bi bi-grid-3x3-gap-fill"></i></button>
                        <button type="button" class="view-btn" data-view="table" title="Tampilan Tabel"><i
                                class="bi bi-list-ul"></i></button>
                    </div>
                    <div class="result-count">Menampilkan <strong id="kulinerCount">192</strong> tempat</div>
                </div>
            </div>

            <!-- GRID VIEW -->
            <div class="kuliner-grid grid-view active" id="gridView"></div>

            <!-- TABLE VIEW -->
            <div class="table-view" id="tableView">
                <div class="kuliner-table-wrap">
                    <table class="kuliner-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tempat</th>
                                <th>Kategori</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody"></tbody>
                    </table>
                </div>
            </div>

            <!-- NO RESULTS -->
            <div class="no-results" id="noResults" style="display: none;">
                <i class="bi bi-shop-window"></i>
                <p>Tidak ada tempat kuliner yang sesuai pencarian Anda.</p>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // ========== DATA KULINER ==========
        const kulinerData = [
            // RESTORAN
            {no: 1, name: "ROYAL'S RESTO AND FUNCTION HALL", address: "Jln. Branjangan Kel. Santiong", type: "Restoran"},
            {no: 2, name: "PONDOK KATU", address: "Jln. Branjangan Kel. Kalumpang", type: "Restoran"},
            {no: 3, name: "GRAND FATMAH", address: "Kel. Moya", type: "Restoran"},
            {no: 4, name: "BAKSO LAPANGAN TEMBAK", address: "Jln. A.R Mononutu Kel. Stadion", type: "Restoran"},
            {no: 5, name: "SARI BUNDO", address: "Kel. Tanah Raja", type: "Restoran"},
            {no: 6, name: "BUKIT PELANGI", address: "Kel Dufa Dufa Belakang", type: "Restoran"},
            {no: 7, name: "PAPARONZ", address: "Mall Jatiland Kel. Gamalama", type: "Restoran"},
            {no: 8, name: "EXCELSO", address: "Mall Jatiland Kel. Gamalama", type: "Restoran"},
            {no: 9, name: "KFC", address: "Mall Jatiland Kel. Gamalama", type: "Restoran"},
            {no: 10, name: "SOLARIA", address: "Mall Jatiland Kel. Gamalama", type: "Restoran"},
            {no: 11, name: "SOLARIA", address: "Samping Mall Jatiland Kel. Gamalama", type: "Restoran"},
            {no: 12, name: "CFC", address: "Jln. Jati Kel. Mangga Dua Utara", type: "Restoran"},
            {no: 13, name: "BAKMI NAGA", address: "Jln. Jati Kel. Mangga Dua Utara", type: "Restoran"},
            {no: 14, name: "SS RESTO", address: "Kel. Mangga Dua", type: "Restoran"},
            {no: 15, name: "PIZZA HUT", address: "Jln A.R Mononutu Kel. Tanah Raja", type: "Restoran"},
            {no: 16, name: "MC DONALD", address: "Kel. Gamalama", type: "Restoran"},
            {no: 17, name: "RICHEESE FACTORY", address: "Jln A.R Mononutu Kel. Stadion", type: "Restoran"},
            {no: 18, name: "MOONLIGHT", address: "Jln. Pahlawan Revolusi Kel. Gamalama", type: "Restoran"},
            {no: 19, name: "MUARA RESTO", address: "Jln. Merdeka Kel. Gamalama", type: "Restoran"},
            {no: 20, name: "DAHAN MAS", address: "Batu Anteru Kel. Maliaro", type: "Restoran"},
            {no: 21, name: "K62", address: "Kel. Kalumpang", type: "Restoran"},
            {no: 22, name: "DAPUR NONA JO", address: "Kel. Gamalama", type: "Restoran"},
            {no: 23, name: "SYAMATIRAH", address: "Kel. Makassar Timur", type: "Restoran"},
            {no: 24, name: "ANOMALI", address: "Jln. Merdeka Kel. Santiong", type: "Restoran"},
            {no: 25, name: "RICA RICA", address: "Kel. Kota Baru", type: "Restoran"},
            {no: 26, name: "LILIAN BEACH RESORT", address: "Kel. Takome", type: "Restoran"},
            {no: 27, name: "D'CLIFF", address: "Kel. Kalumata", type: "Restoran"},
            {no: 28, name: "VILA RIA", address: "Kel. Sasa", type: "Restoran"},
            {no: 29, name: "ICHIBAN", address: "Jatiland Mall Kel. Gamalama", type: "Restoran"},
            {no: 30, name: "PADDOCK", address: "Kel. Toboko", type: "Restoran"},
            {no: 31, name: "WAKAME", address: "Kel. Soa Sio", type: "Restoran"},
            
            // RUMAH MAKAN
            {no: 32, name: "PASTEAK", address: "Kel. Sangaji (Siko)", type: "Rumah Makan"},
            {no: 33, name: "R.M MAJOR KITCHEN", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 34, name: "R.M SWADAYA", address: "Ruko Jatiland Kel. Gamalama", type: "Rumah Makan"},
            {no: 35, name: "R.M AL-HIKMAH", address: "Kel. Tanah Raja", type: "Rumah Makan"},
            {no: 36, name: "R.M SIMPANG RAYA", address: "Kel. Makassar Timur", type: "Rumah Makan"},
            {no: 37, name: "R.M PAPA KO", address: "Kel. Kalumpang", type: "Rumah Makan"},
            {no: 38, name: "R.M DAPUR CHEESY", address: "Kel. Kalumpang", type: "Rumah Makan"},
            {no: 39, name: "R.M AYAM BAKAR PAK RT 1", address: "Kel. Muhajirin", type: "Rumah Makan"},
            {no: 40, name: "R.M AYAM BAKAR PAK RT 2", address: "Jati Lurus Kel. Mangga Dua Utara", type: "Rumah Makan"},
            {no: 41, name: "R.M AYAM BAKAR MAS JA 1", address: "Kel. Kampung Pisang", type: "Rumah Makan"},
            {no: 42, name: "R.M AYAM BAKAR MAS JA 2", address: "Kel. Maliaro", type: "Rumah Makan"},
            {no: 43, name: "R.M AYAM BAKAR PAK RT 3", address: "Kel. Kasturian", type: "Rumah Makan"},
            {no: 44, name: "R.M AYAM BAKAR DABU DABU", address: "Kel. Santiong", type: "Rumah Makan"},
            {no: 45, name: "R.M DAPUR NONA JAWA", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 46, name: "R.M IJO ROYO ROYO 1", address: "Kel. Akehuda", type: "Rumah Makan"},
            {no: 47, name: "R.M IJO ROYO ROYO 2", address: "Kel. Tubo", type: "Rumah Makan"},
            {no: 48, name: "R.M OK CHIKEN", address: "Kel. Makassar Timur", type: "Rumah Makan"},
            {no: 49, name: "R.M DAPUR MA MENA", address: "Kel. Makassar Timur", type: "Rumah Makan"},
            {no: 50, name: "R.M ANAK MANDE", address: "Dufa-Dufa", type: "Rumah Makan"},
            {no: 51, name: "WM. 888", address: "Kel. Akehuda", type: "Rumah Makan"},
            {no: 52, name: "MIDJO 1947", address: "Kel. Tanah Raja", type: "Rumah Makan"},
            {no: 53, name: "SATE MADURA LANGGAR IJO", address: "Kel. Tanah Raja", type: "Rumah Makan"},
            {no: 54, name: "MAS BRO KREMES", address: "Kel. Kalumpang", type: "Rumah Makan"},
            {no: 55, name: "SOP SODARA", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 56, name: "R.M PANGKEP", address: "Kel. Kalumpang", type: "Rumah Makan"},
            {no: 57, name: "SAUNG ABA", address: "Kel. Sangaji", type: "Rumah Makan"},
            {no: 58, name: "R.M LILIAN", address: "Kel. Santiong", type: "Rumah Makan"},
            {no: 59, name: "BAKSO AMBIGU", address: "Kel. Santiong", type: "Rumah Makan"},
            {no: 60, name: "MINANG RAYA", address: "Kel. Muhajirin", type: "Rumah Makan"},
            {no: 61, name: "R.M JAILOLO", address: "Kel Muhajirin", type: "Rumah Makan"},
            {no: 62, name: "R.M ROHANI", address: "Kel. Muhajirin", type: "Rumah Makan"},
            {no: 63, name: "R.M TANAH WANGKO", address: "Jln. Sultan Iskandar Muhamad Djabir Sjah Kel. Gamalama", type: "Rumah Makan"},
            {no: 64, name: "WM. ABZ", address: "Kel Muhajirin", type: "Rumah Makan"},
            {no: 65, name: "R.M RESIDENCE", address: "Kel Muhajirin", type: "Rumah Makan"},
            {no: 66, name: "WM. JEPARA INDAH", address: "Kel. Makassar Timur", type: "Rumah Makan"},
            {no: 67, name: "R.M 3 PUTRA", address: "Kel. Dufa Dufa", type: "Rumah Makan"},
            {no: 68, name: "WM. TUBAN PUTRA", address: "Kel. Makassar Barat", type: "Rumah Makan"},
            {no: 69, name: "WARUNG SOLO BARU", address: "Kel. Makassar Barat", type: "Rumah Makan"},
            {no: 70, name: "WARUNG LAMONGAN", address: "Kel. Makassar Barat", type: "Rumah Makan"},
            {no: 71, name: "BURGER BANGER", address: "Kel. Makassar Barat", type: "Rumah Makan"},
            {no: 72, name: "DAPUR MANISO", address: "Kel. Kota Baru", type: "Rumah Makan"},
            {no: 73, name: "R.M SIDODADI (KOLONCUCU)", address: "Kel. Kota Baru", type: "Rumah Makan"},
            {no: 74, name: "R.M BAGHDAD", address: "Kel. Kota Baru", type: "Rumah Makan"},
            {no: 75, name: "KEDAI CAPILONG", address: "Kel. Kota Baru", type: "Rumah Makan"},
            {no: 76, name: "R.M QUEEN", address: "Kel. Kota Baru", type: "Rumah Makan"},
            {no: 77, name: "R.M DUA PUTRI", address: "Kel. Kota Baru", type: "Rumah Makan"},
            {no: 78, name: "R.M RISKA JAYA", address: "Kel. Kota Baru", type: "Rumah Makan"},
            {no: 79, name: "R.M MANDARIDA", address: "Kel. Kota Baru", type: "Rumah Makan"},
            {no: 80, name: "R.M ALULA", address: "Kel. Kampung Pisang", type: "Rumah Makan"},
            {no: 81, name: "COTO MAKASSAR KAMPUNG PISANG", address: "Kel. Kampung Pisang", type: "Rumah Makan"},
            {no: 82, name: "SERUNI", address: "Kel. Kampung Pisang", type: "Rumah Makan"},
            {no: 83, name: "SATE KAMPIS", address: "Kel. Kampung Pisang", type: "Rumah Makan"},
            {no: 84, name: "KEDAI KAMPIS BOWL", address: "Kel. Kampung Pisang", type: "Rumah Makan"},
            {no: 85, name: "R.M MITA JAYA", address: "Kel. Kampung Pisang", type: "Rumah Makan"},
            {no: 86, name: "SATE MARYAM GAMALAMA", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 87, name: "RUMAH MAKAN GAMALAMA", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 88, name: "R.M PONANG", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 89, name: "R.M DAPUR RAYA", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 90, name: "RUMAH MAKAN UNIX", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 91, name: "R.M PUPEDA TIGA PUTRA", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 92, name: "WARUNG MANALAGI", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 93, name: "LISA JAYA", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 94, name: "WARUNG PANGKEP HI ALI", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 95, name: "BOOM DONUT BAKERY AND CAKE", address: "Kel. Gamalama", type: "Rumah Makan"},
            {no: 96, name: "R.M BAKSO 4G", address: "Kel. Toboko", type: "Rumah Makan"},
            {no: 97, name: "HOLLAND FRIED CIKEN", address: "Kel. Tanah Tinggi", type: "Rumah Makan"},
            {no: 98, name: "R.M JUJUR BERSAMA", address: "Kel. Tanah Tinggi", type: "Rumah Makan"},
            {no: 99, name: "KHARISMA", address: "Kel. Sasa", type: "Rumah Makan"},
            {no: 100, name: "BAKSO ROSA", address: "Kel. Sasa", type: "Rumah Makan"},
            {no: 101, name: "NO & UTI", address: "Kel. Sasa", type: "Rumah Makan"},
            {no: 102, name: "KJA MANILA", address: "Kel. Ngade", type: "Rumah Makan"},
            {no: 103, name: "KEDAI RISA", address: "Kel. Mangga Dua Utara", type: "Rumah Makan"},
            {no: 104, name: "DAPUR SO MASAK", address: "Kel. Mangga Dua Utara", type: "Rumah Makan"},
            {no: 105, name: "RUMAH MAKAN REJO", address: "Kel. Mangga Dua Utara", type: "Rumah Makan"},
            {no: 106, name: "WARUNG BIRU LESTARI SOLO", address: "Kel. Mangga Dua Utara", type: "Rumah Makan"},
            {no: 107, name: "RUMAH MAKAN PARTON", address: "Kel. Mangga Dua Utara", type: "Rumah Makan"},
            {no: 108, name: "R.M YUSMAR", address: "Kel. Mangga Dua Utara", type: "Rumah Makan"},
            {no: 109, name: "KEDAI MAKANAN ARIS", address: "Kel. Mangga Dua Utara", type: "Rumah Makan"},
            {no: 110, name: "BAKSO SEMUT MERAH", address: "Kel. Mangga Dua Utara", type: "Rumah Makan"},
            {no: 111, name: "R.M PANGKEP CABANG MANGGA DUA", address: "Kel. Mangga Dua", type: "Rumah Makan"},
            {no: 112, name: "RUMAH MAKAN WANDAN", address: "Kel. Mangga Dua", type: "Rumah Makan"},
            {no: 113, name: "PELANGI SAFA", address: "Kel. Mangga Dua", type: "Rumah Makan"},
            {no: 114, name: "INDO GORENG", address: "Kel. Mangga Dua", type: "Rumah Makan"},
            {no: 115, name: "KEDAI CINTA", address: "Kel. Mangga Dua", type: "Rumah Makan"},
            {no: 116, name: "R.M ASSIFA BAROKAH", address: "Kel. Mangga Dua", type: "Rumah Makan"},
            {no: 117, name: "MUNIRA KULINER", address: "Kel. Kalumata", type: "Rumah Makan"},
            {no: 118, name: "WARUNG NASI KUNING AZIS", address: "Kel. Kalumata", type: "Rumah Makan"},
            {no: 119, name: "R.M YU SRI KLATEN", address: "Kel. Kalumata", type: "Rumah Makan"},
            {no: 120, name: "WARUNG SISIR", address: "Kel. Kalumata", type: "Rumah Makan"},
            {no: 121, name: "MEDINA", address: "Kel. Kalumata", type: "Rumah Makan"},
            {no: 122, name: "R.M MEDINA 12", address: "Kel. Kalumata", type: "Rumah Makan"},
            {no: 123, name: "RUMAH MAKAN INDAH JAYA", address: "Kel. Kalumata", type: "Rumah Makan"},
            {no: 124, name: "R.M TISSA", address: "Kel. Kalumata", type: "Rumah Makan"},
            {no: 125, name: "R.M KANJENG MAMI", address: "Kel. Kalumata", type: "Rumah Makan"},
            {no: 126, name: "RUMAH MAKAN CAK KATROK", address: "Kel. Jati", type: "Rumah Makan"},
            {no: 127, name: "KEDAI AR RAHMAH COTO MAKASSAR PUTRA GAMALAMA", address: "Kel. Jati", type: "Rumah Makan"},
            {no: 128, name: "WARUNG SOPO NYONO", address: "Kel. Jati", type: "Rumah Makan"},
            {no: 129, name: "RUMAH MAKAN INDRI", address: "Kel. Jati", type: "Rumah Makan"},
            {no: 130, name: "R.M RASTA", address: "Kel. Jati", type: "Rumah Makan"},
            {no: 131, name: "SARIAH", address: "Kel. Fitu", type: "Rumah Makan"},
            {no: 132, name: "LESEHAN RIFANI", address: "Kel. Fitu", type: "Rumah Makan"},
            {no: 133, name: "WARUNG SAHABAT", address: "Kel. Bastiong Talangame", type: "Rumah Makan"},
            {no: 134, name: "WARUNG MAKAN MBAK MINTEN", address: "Kel. Bastiong Talangame", type: "Rumah Makan"},
            {no: 135, name: "R.M AYAH", address: "Kel. Bastiong", type: "Rumah Makan"},
            {no: 136, name: "RUMAH MAKAN ISKILA BROTHERS", address: "Kel. Bastiong", type: "Rumah Makan"},
            {no: 137, name: "R.M LIFA", address: "Kel. Bastiong", type: "Rumah Makan"},
            {no: 138, name: "R.M NAURA", address: "Kel. Bastiong", type: "Rumah Makan"},
            {no: 139, name: "R.M DAPUR CITRA", address: "Kel. Bastiong", type: "Rumah Makan"},
            {no: 140, name: "R.M ALIFA", address: "Kel. Bastiong", type: "Rumah Makan"},
            {no: 141, name: "WARUNG AMALIA", address: "Kel. Bastiong", type: "Rumah Makan"},
            {no: 142, name: "DAP", address: "Kel. Maliaro", type: "Rumah Makan"},
            {no: 143, name: "KIMI SUSHI", address: "Kel. Tanah Raja", type: "Rumah Makan"},
            {no: 144, name: "KATAJI", address: "Kel. Kota Baru", type: "Rumah Makan"},
            {no: 145, name: "MIE AYAM BAKSO JAKARTA", address: "Kel. Santiong", type: "Rumah Makan"},

            // CAFÉ
            {no: 146, name: "JAROD", address: "Kel. Stadion", type: "Café"},
            {no: 147, name: "BOUGENVILE", address: "Jln. Nukila Kel. Gamalama", type: "Café"},
            {no: 148, name: "SHANGRI LA", address: "Jln. Nukila Kel. Gamalama", type: "Café"},
            {no: 149, name: "SINAR GEMILANG", address: "Kel. Jati", type: "Café"},
            {no: 150, name: "MOLUCAS CAFÉ AND EATERY", address: "Kel. Gamalama", type: "Café"},
            {no: 151, name: "ATAP MANDIRI", address: "Kel Muhajirin", type: "Café"},
            {no: 152, name: "TITIK NOL", address: "Kel. Tanah Tinggi", type: "Café"},
            {no: 153, name: "TIK NOL", address: "Kel. Salero", type: "Café"},
            {no: 154, name: "SUDUT HATI", address: "Kel. Stadion", type: "Café"},
            {no: 155, name: "MONOI KOFI", address: "Kel. Akehuda", type: "Café"},
            {no: 156, name: "ARCHIE", address: "Kel. Salero", type: "Café"},
            {no: 157, name: "SONGARA", address: "Kel. Ubo-Ubo", type: "Café"},
            {no: 158, name: "DEEPAA", address: "Kel. Makassar Barat", type: "Café"},
            {no: 159, name: "ROTOM", address: "Kel Gamalama", type: "Café"},
            {no: 160, name: "MARS ROOM", address: "Kel. Kalumpang", type: "Café"},
            {no: 161, name: "INDIS", address: "Kel. Tanah Raja", type: "Café"},
            {no: 162, name: "KABLAKANG", address: "Batu Anteru Kel. Maliaro", type: "Café"},
            {no: 163, name: "KANAN SPACE", address: "Batu Anteru Kel. Maliaro", type: "Café"},
            {no: 164, name: "DIPERTIGAAN", address: "Kel. Jati Perumnas", type: "Café"},
            {no: 165, name: "UP SALAH", address: "Kel. Torano", type: "Café"},
            {no: 166, name: "KANNEE", address: "Kel. Maliaro, BTN", type: "Café"},
            {no: 167, name: "SINI COFFEE", address: "Kel. Santiong", type: "Café"},
            {no: 168, name: "SERASA", address: "Kel. Stadion", type: "Café"},
            {no: 169, name: "GARASI MORASA", address: "Kel. Toboleu", type: "Café"},
            {no: 170, name: "FALA KANCI", address: "Kel. Soa Sio", type: "Café"},
            {no: 171, name: "POTENTIAL", address: "Kel. Kasturian", type: "Café"},
            {no: 172, name: "q'KECIL", address: "Kel. Makassar Timur", type: "Café"},
            {no: 173, name: "SYAMATIRA CAFÉ'", address: "Kel. Makassar Timur", type: "Café"},
            {no: 174, name: "MOZAIK", address: "Kel. Kalumata", type: "Café"},
            {no: 175, name: "ROTASI", address: "Kel. Kalumata", type: "Café"},
            {no: 176, name: "KELANA", address: "Kel. Kalumata", type: "Café"},
            {no: 177, name: "LAGUNA HILL", address: "Kel. Ngade", type: "Café"},
            {no: 178, name: "COCONUT KAI", address: "Jati Lurus Kel Mangga Dua Utara", type: "Café"},
            {no: 179, name: "DRUPADI", address: "Jati Kecil Kel. Mangga Dua Utara", type: "Café"},
            {no: 180, name: "KOPI SOE", address: "Kel. Toboko", type: "Café"},
            {no: 181, name: "TABADIKU", address: "Kel. Gambesi", type: "Café"},
            {no: 182, name: "FROM US", address: "Kel. Soa Sio", type: "Café"},
            {no: 183, name: "KOPI UYO", address: "Kel. Toboko", type: "Café"},
            {no: 184, name: "ISTANA CAFÉ", address: "Kel. Gamalama", type: "Café"},
            {no: 185, name: "ROSCO - KOHIKAN", address: "Jln. Jerebusua Kel. Tanah Tinggi Barat", type: "Café"},
            {no: 186, name: "THE COGAN", address: "Ngidi Kel. Makassar Barat", type: "Café"},
            {no: 187, name: "NATURAL", address: "Kel. Muhajirin", type: "Café"},
            {no: 188, name: "WARKOP JENGGALA", address: "Kel. Toboko", type: "Café"},
            {no: 189, name: "KEDAI KOFIA", address: "Kel. Sangaji", type: "Café"},
            {no: 190, name: "CAFÉ BASANOHI", address: "Kel. Kotabaru", type: "Café"},
            {no: 191, name: "FALA COFFEE", address: "Kel. Dufa Dufa", type: "Café"},
            {no: 192, name: "RUMAH KOPI NUKILA", address: "Jln. Nukila Kel. Gamalama", type: "Café"},
            {no: 193, name: "LEGEND", address: "Jln. Kapitan Pattimura, Kel. Kalumpang", type: "Café"},
            {no: 194, name: "ES TEH INDONESIA", address: "Jln. Sultan M. Djabir Sjah", type: "Café"}
        ];

        // ========== HELPERS ==========
        let currentFilter = 'all';
        let currentView = 'grid';

        function getCategory(type) {
            const t = type.toLowerCase();
            if (t.includes('restoran')) return 'restoran';
            if (t.includes('rumah makan')) return 'rumah-makan';
            if (t.includes('café') || t.includes('cafe')) return 'cafe';
            return 'other';
        }

        function getBadgeClass(cat) {
            return {
                'restoran': 'badge-restoran',
                'rumah-makan': 'badge-rumah-makan',
                'cafe': 'badge-cafe'
            }[cat] || 'badge-other';
        }

        function getBadgeIcon(cat) {
            return {
                'restoran': '<i class="bi bi-shop me-1"></i>',
                'rumah-makan': '<i class="bi bi-house-door me-1"></i>',
                'cafe': '<i class="bi bi-cup-hot me-1"></i>'
            }[cat] || '';
        }

        // ========== UPDATE STATS ==========
        function updateStats() {
            let restoran = 0, rumahMakan = 0, cafe = 0;
            kulinerData.forEach(k => {
                const c = getCategory(k.type);
                if (c === 'restoran') restoran++;
                else if (c === 'rumah-makan') rumahMakan++;
                else if (c === 'cafe') cafe++;
            });
            document.getElementById('statTotal').textContent = kulinerData.length;
            document.getElementById('statRestoran').textContent = restoran;
            document.getElementById('statRumahMakan').textContent = rumahMakan;
            document.getElementById('statCafe').textContent = cafe;
        }

        // ========== RENDER ==========
        function render() {
            const search = document.getElementById('kulinerSearch').value.toLowerCase();

            const filtered = kulinerData.filter(k => {
                const matchSearch = k.name.toLowerCase().includes(search) || 
                                  k.address.toLowerCase().includes(search);
                const cat = getCategory(k.type);
                const matchFilter = currentFilter === 'all' || cat === currentFilter;
                return matchSearch && matchFilter;
            });

            document.getElementById('kulinerCount').textContent = filtered.length;

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
            gridEl.innerHTML = filtered.map((k, i) => {
                const cat = getCategory(k.type);
                return `
                <div class="kuliner-card type-${cat}" style="animation-delay: ${Math.min(i * 0.03, 0.6)}s">
                    <div class="kuliner-card-header">
                        <div class="kuliner-number">${k.no}</div>
                        <span class="kuliner-type-badge ${getBadgeClass(cat)}">${getBadgeIcon(cat)}${k.type}</span>
                    </div>
                    <div class="kuliner-name">${k.name}</div>
                    <div class="kuliner-address">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>${k.address}</span>
                    </div>
                </div>
            `;
            }).join('');

            // Table view
            tableBody.innerHTML = filtered.map(k => {
                const cat = getCategory(k.type);
                return `
                <tr>
                    <td>${k.no}</td>
                    <td>
                        <div class="table-kuliner-name">${k.name}</div>
                    </td>
                    <td><span class="kuliner-type-badge ${getBadgeClass(cat)}">${getBadgeIcon(cat)}${k.type}</span></td>
                    <td class="table-kuliner-address">${k.address}</td>
                </tr>
            `;
            }).join('');
        }

        // ========== EVENT LISTENERS ==========
        document.getElementById('kulinerSearch').addEventListener('input', render);

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