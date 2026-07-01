@extends('layouts.main')

@section('title', 'Rent Car - Rakernas XII JKPI 2026 Kota Ternate')

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
            --green: #1a8a4a;
            --green-light: #e8f5ee;
            --gray: #6c757d;
            --gray-light: #f8f9fa;
            --dark: #1a1a2e;
        }

        /* ========== HERO SECTION ========== */
        .rentcar-hero {
            position: relative;
            padding: 140px 0 80px;
            background: linear-gradient(135deg, #0a2a3c 0%, #0d4f5e 40%, #099aa7 100%);
            overflow: hidden;
            color: white;
        }

        .rentcar-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(45deg, rgba(255, 255, 255, 0.04) 0 1px, transparent 1px 18px),
                repeating-linear-gradient(-45deg, rgba(255, 255, 255, 0.03) 0 1px, transparent 1px 18px);
            opacity: 0.9;
            pointer-events: none;
        }

        .rentcar-hero::after {
            content: "";
            position: absolute;
            right: -120px;
            top: -120px;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: radial-gradient(closest-side, rgba(212, 160, 23, 0.35), transparent 70%);
            pointer-events: none;
        }

        .rentcar-hero .container {
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
        .rentcar-content {
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

        .result-count {
            font-size: 0.9rem;
            color: #999;
            font-weight: 600;
            white-space: nowrap;
        }

        .result-count strong {
            color: var(--primary);
        }

        /* ========== VIEW TOGGLE ========== */
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

        /* ========== GRID VIEW ========== */
        .rentcar-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 20px;
        }

        .rentcar-card {
            background: #fff;
            border-radius: 14px;
            border: 2px solid #eef1f5;
            padding: 22px 24px;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.4s ease forwards;
            opacity: 0;
        }

        .rentcar-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gold);
            transition: background 0.3s;
        }

        .rentcar-card:hover {
            border-color: var(--primary);
            box-shadow: 0 8px 28px rgba(9, 154, 167, 0.12);
            transform: translateY(-3px);
        }

        .rentcar-card:hover::before {
            background: var(--primary);
        }

        .rentcar-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .rentcar-number {
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

        .rentcar-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            background: var(--primary-light);
            color: var(--primary);
        }

        .rentcar-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .rentcar-info {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .rentcar-info-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.85rem;
            color: #888;
            line-height: 1.5;
        }

        .rentcar-info-row i {
            color: var(--primary);
            margin-top: 3px;
            flex-shrink: 0;
            font-size: 0.9rem;
        }

        .rentcar-info-row a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .rentcar-info-row a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .contact-name-label {
            display: inline-block;
            background: var(--gold-light);
            color: var(--gold);
            border-radius: 4px;
            padding: 1px 7px;
            font-size: 0.72rem;
            font-weight: 700;
            margin-right: 4px;
        }

        /* ========== TABLE VIEW ========== */
        .table-view {
            display: none;
        }

        .table-view.active {
            display: block;
        }

        .grid-view.active {
            display: grid;
        }

        .rentcar-table-wrap {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            border: 2px solid #eef1f5;
        }

        .rentcar-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .rentcar-table thead th {
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

        .rentcar-table thead th:first-child {
            width: 55px;
            text-align: center;
        }

        .rentcar-table tbody tr {
            border-bottom: 1px solid #f0f2f5;
            transition: background 0.2s;
        }

        .rentcar-table tbody tr:hover {
            background: var(--primary-light);
        }

        .rentcar-table tbody td {
            padding: 14px 18px;
            vertical-align: middle;
            color: #444;
        }

        .rentcar-table tbody td:first-child {
            text-align: center;
            font-weight: 700;
            color: #bbb;
        }

        .table-rentcar-name {
            font-weight: 700;
            color: var(--dark);
        }

        .table-rentcar-contact {
            font-size: 0.82rem;
            color: #666;
            margin-top: 2px;
        }

        .table-rentcar-phone {
            font-size: 0.82rem;
            color: var(--primary);
            font-weight: 600;
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
        @media (max-width: 1200px) {
            .rentcar-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 16px;
            }
        }

        @media (max-width: 992px) {
            .rentcar-hero {
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

            .rentcar-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .toolbar-row {
                flex-wrap: wrap;
            }

            .search-box {
                min-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .rentcar-hero {
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

            .rentcar-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .rentcar-card {
                padding: 18px;
            }

            .rentcar-table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .rentcar-table {
                min-width: 600px;
                font-size: 0.82rem;
            }

            .rentcar-table thead th,
            .rentcar-table tbody td {
                padding: 10px 12px;
            }
        }

        @media (max-width: 480px) {
            .rentcar-hero {
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

            .rentcar-card {
                padding: 16px 14px;
                border-radius: 12px;
            }

            .rentcar-name {
                font-size: 0.95rem;
            }

            .rentcar-info-row {
                font-size: 0.78rem;
            }

            .rentcar-table {
                min-width: 540px;
                font-size: 0.78rem;
            }
        }

        @media (max-width: 360px) {
            .hero-title {
                font-size: 1.4rem;
            }

            .hero-stat-number {
                font-size: 1.2rem;
            }
        }

        /* ========== WHATSAPP BUTTON ========== */
        .wa-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 14px;
            padding: 8px 16px;
            background: #25d366;
            color: #fff;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
            width: 100%;
            justify-content: center;
        }

        .wa-btn:hover {
            background: #1ebe5d;
            color: #fff;
            transform: translateY(-1px);
            text-decoration: none;
        }

        .wa-btn i {
            font-size: 1rem;
        }

        .table-wa-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            background: #25d366;
            color: #fff;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .table-wa-btn:hover {
            background: #1ebe5d;
            color: #fff;
            text-decoration: none;
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
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="rentcar-hero">
        <div class="container">
            <div class="hero-badge"><i class="bi bi-car-front me-2"></i>Transportasi Kota Ternate</div>
            <h1 class="hero-title text-white">Rent Car<br>Kota Ternate</h1>
            <p class="hero-subtitle">
                Daftar lengkap penyedia jasa sewa kendaraan di Kota Ternate
                untuk peserta Rakernas JKPI XII 2026.
            </p>
            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-number" id="statTotal">10</span>
                    <span class="hero-stat-label">Total Penyedia</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="rentcar-content">
        <div class="container">

            <!-- TOOLBAR -->
            <div class="toolbar-card">
                <div class="toolbar-row">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" id="rentcarSearch" placeholder="Cari nama atau kontak...">
                    </div>
                    <div class="view-toggle">
                        <button type="button" class="view-btn active" data-view="grid" title="Tampilan Grid"><i
                                class="bi bi-grid-3x3-gap-fill"></i></button>
                        <button type="button" class="view-btn" data-view="table" title="Tampilan Tabel"><i
                                class="bi bi-list-ul"></i></button>
                    </div>
                    <div class="result-count">Menampilkan <strong id="rentcarCount">10</strong> penyedia</div>
                </div>
            </div>

            <!-- GRID VIEW -->
            <div class="rentcar-grid grid-view active" id="gridView"></div>

            <!-- TABLE VIEW -->
            <div class="table-view" id="tableView">
                <div class="rentcar-table-wrap">
                    <table class="rentcar-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Usaha</th>
                                <th>Nama Kontak</th>
                                <th>No. Telepon</th>
                                <th>WhatsApp</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody"></tbody>
                    </table>
                </div>
            </div>

            <!-- NO RESULTS -->
            <div class="no-results" id="noResults" style="display: none;">
                <i class="bi bi-car-front"></i>
                <p>Tidak ada penyedia rent car yang sesuai pencarian Anda.</p>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // ========== DATA RENT CAR ==========
        const rentcarData = [{
                no: 1,
                name: "Gapura Santiong Rental",
                contactName: "Maco",
                phone: ["081340249516"]
            },
            {
                no: 2,
                name: "Neraca Rental",
                contactName: "Koce",
                phone: ["081348686450"]
            },
            {
                no: 3,
                name: "Salahudin Rental",
                contactName: "Doken",
                phone: ["085211120810"]
            },
            {
                no: 4,
                name: "Kebayoran Kompi Rental",
                contactName: "Yus",
                phone: ["081355706346"]
            },
            {
                no: 5,
                name: "Rental Stadion",
                contactName: "Dino",
                phone: ["085242428111"]
            },
            {
                no: 6,
                name: "Putra Salahudin Rent Car",
                contactName: "Pak War",
                phone: ["082347766686"]
            },
            {
                no: 7,
                name: "Pratama Rent Car",
                contactName: "Pak Shaif",
                phone: ["082194967472"]
            },
            {
                no: 8,
                name: "Aditya Sport Rent Car",
                contactName: "Pak Aziz",
                phone: ["081340215789"]
            },
            {
                no: 9,
                name: "Resident Transport Rent Car",
                contactName: "Pak Fathur",
                phone: ["085343618792"]
            },
            {
                no: 10,
                name: "Cyberternate Rental",
                contactName: "Pak Rustam",
                phone: ["081242717630"]
            }

        ];

        // ========== HELPER ==========
        function toWaNumber(phone) {
            // Strip non-digits, replace leading 0 with 62
            let num = phone.replace(/\D/g, '');
            if (num.startsWith('0')) num = '62' + num.slice(1);
            return num;
        }

        // ========== RENDER ==========
        function render() {
            const search = document.getElementById('rentcarSearch').value.toLowerCase();

            const filtered = rentcarData.filter(k => {
                return (
                    k.name.toLowerCase().includes(search) ||
                    k.contactName.toLowerCase().includes(search) ||
                    k.phone.some(p => p.includes(search))
                );
            });

            document.getElementById('rentcarCount').textContent = filtered.length;

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

            // Render grid
            gridEl.innerHTML = filtered.map((k, i) => {
                const phonesHtml = k.phone.map(p =>
                    `<div class="rentcar-info-row">
                        <i class="bi bi-telephone-fill"></i>
                        <a href="tel:${p}">${p}</a>
                    </div>`
                ).join('');

                // WA button uses first phone number
                const waNum = toWaNumber(k.phone[0]);
                const waMsg = encodeURIComponent(
                    `Halo ${k.contactName}, saya ingin menyewa kendaraan dari ${k.name}.`);
                const waBtn = `<a href="https://wa.me/${waNum}?text=${waMsg}" target="_blank" rel="noopener noreferrer" class="wa-btn">
                    <i class="bi bi-whatsapp"></i> Chat via WhatsApp
                </a>`;

                return `
                    <div class="rentcar-card" style="animation-delay: ${Math.min(i * 0.05, 0.6)}s">
                        <div class="rentcar-card-header">
                            <div class="rentcar-number">${k.no}</div>
                            <span class="rentcar-badge"><i class="bi bi-car-front-fill me-1"></i>Rent Car</span>
                        </div>
                        <div class="rentcar-name">${k.name}</div>
                        <div class="rentcar-info">
                            <div class="rentcar-info-row">
                                <i class="bi bi-person-fill"></i>
                                <span><span class="contact-name-label">Kontak</span>${k.contactName}</span>
                            </div>
                            ${phonesHtml}
                        </div>
                        ${waBtn}
                    </div>
                `;
            }).join('');

            // Render table
            tableBody.innerHTML = filtered.map(k => {
                const phonesTable = k.phone.map(p =>
                    `<div class="table-rentcar-phone"><a href="tel:${p}" style="color:var(--primary);text-decoration:none;">${p}</a></div>`
                ).join('');

                const waNum = toWaNumber(k.phone[0]);
                const waMsg = encodeURIComponent(
                    `Halo ${k.contactName}, saya ingin menyewa kendaraan dari ${k.name}.`);

                return `
                    <tr>
                        <td>${k.no}</td>
                        <td><div class="table-rentcar-name">${k.name}</div></td>
                        <td><div class="table-rentcar-contact">${k.contactName}</div></td>
                        <td>${phonesTable}</td>
                        <td><a href="https://wa.me/${waNum}?text=${waMsg}" target="_blank" rel="noopener noreferrer" class="table-wa-btn"><i class="bi bi-whatsapp"></i> WhatsApp</a></td>
                    </tr>
                `;
            }).join('');
        }

        // ========== EVENT LISTENERS ==========
        document.getElementById('rentcarSearch').addEventListener('input', render);

        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const view = this.dataset.view;

                const gridEl = document.getElementById('gridView');
                const tableEl = document.getElementById('tableView');

                if (view === 'grid') {
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
            render();
        });
    </script>
@endpush
