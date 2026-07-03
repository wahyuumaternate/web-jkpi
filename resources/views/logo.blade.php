@extends('layouts.main')

@section('title', 'Logo Resmi JKPI - Rakernas XII JKPI 2026 Kota Ternate')

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
        .oleholeh-hero {
            position: relative;
            padding: 140px 0 80px;
            background: linear-gradient(135deg, #0a2a3c 0%, #0d4f5e 40%, #099aa7 100%);
            overflow: hidden;
            color: white;
        }

        .oleholeh-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(45deg, rgba(255, 255, 255, 0.04) 0 1px, transparent 1px 18px),
                repeating-linear-gradient(-45deg, rgba(255, 255, 255, 0.03) 0 1px, transparent 1px 18px);
            opacity: 0.9;
            pointer-events: none;
        }

        .oleholeh-hero::after {
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

        .oleholeh-hero .container {
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
        .oleholeh-content {
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
        .oleholeh-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 20px;
        }

        .oleholeh-card {
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

        .oleholeh-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gold);
            transition: background 0.3s;
        }

        .oleholeh-card:hover {
            border-color: var(--primary);
            box-shadow: 0 8px 28px rgba(9, 154, 167, 0.12);
            transform: translateY(-3px);
        }

        .oleholeh-card:hover::before {
            background: var(--primary);
        }

        .oleholeh-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .oleholeh-number {
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

        .oleholeh-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            background: var(--gold-light);
            color: var(--gold);
        }

        .oleholeh-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .oleholeh-info {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .oleholeh-info-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.85rem;
            color: #888;
            line-height: 1.5;
        }

        .oleholeh-info-row i {
            color: var(--primary);
            margin-top: 3px;
            flex-shrink: 0;
            font-size: 0.9rem;
        }

        .oleholeh-info-row a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .oleholeh-info-row a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Multiple outlets styling */
        .outlet-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
            font-size: 0.82rem;
            color: #888;
        }

        .outlet-item {
            display: flex;
            align-items: flex-start;
            gap: 6px;
        }

        .outlet-label {
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 4px;
            padding: 1px 6px;
            font-size: 0.7rem;
            font-weight: 700;
            white-space: nowrap;
            flex-shrink: 0;
            margin-top: 2px;
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

        .oleholeh-table-wrap {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            border: 2px solid #eef1f5;
        }

        .oleholeh-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .oleholeh-table thead th {
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

        .oleholeh-table thead th:first-child {
            width: 55px;
            text-align: center;
        }

        .oleholeh-table tbody tr {
            border-bottom: 1px solid #f0f2f5;
            transition: background 0.2s;
        }

        .oleholeh-table tbody tr:hover {
            background: var(--primary-light);
        }

        .oleholeh-table tbody td {
            padding: 14px 18px;
            vertical-align: middle;
            color: #444;
        }

        .oleholeh-table tbody td:first-child {
            text-align: center;
            font-weight: 700;
            color: #bbb;
        }

        .table-oleholeh-name {
            font-weight: 700;
            color: var(--dark);
        }

        .table-oleholeh-phone {
            font-size: 0.82rem;
            color: var(--primary);
            font-weight: 600;
            margin-top: 2px;
        }

        .table-oleholeh-address {
            font-size: 0.82rem;
            color: #999;
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
            .oleholeh-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 16px;
            }
        }

        @media (max-width: 992px) {
            .oleholeh-hero {
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

            .oleholeh-grid {
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
            .oleholeh-hero {
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

            .oleholeh-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .oleholeh-card {
                padding: 18px;
            }

            .oleholeh-table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .oleholeh-table {
                min-width: 600px;
                font-size: 0.82rem;
            }

            .oleholeh-table thead th,
            .oleholeh-table tbody td {
                padding: 10px 12px;
            }
        }

        @media (max-width: 480px) {
            .oleholeh-hero {
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

            .oleholeh-card {
                padding: 16px 14px;
                border-radius: 12px;
            }

            .oleholeh-name {
                font-size: 0.95rem;
            }

            .oleholeh-info-row {
                font-size: 0.78rem;
            }

            .oleholeh-table {
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

        .nrr-cta-btn {
            display: inline-block;
            background: linear-gradient(135deg, #099aa7 0%, #05c9d9 100%);
            color: #fff;
            font-size: 1.15rem;
            font-weight: 700;
            padding: 18px 54px;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 10px 36px rgba(9, 154, 167, 0.38);
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }

        .nrr-cta-btn:hover {
            color: #fff;
            transform: translateY(-4px);
            box-shadow: 0 18px 50px rgba(9, 154, 167, 0.50);
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="oleholeh-hero">
        <div class="container">
            <div class="hero-badge"><i class="bi bi-image me-2"></i>Logo Resmi JKPI</div>
            <h1 class="hero-title text-white">
                Logo Resmi<br>Rakernas JKPI XII 2026
            </h1>

            <p class="hero-subtitle">
                Halaman ini menyediakan logo resmi Rakernas JKPI XII 2026
                yang dapat diunduh untuk kebutuhan publikasi, media, dan
                materi promosi. Silakan pilih logo sesuai kebutuhan Anda.
            </p>

        </div>
    </section>
    <!-- CONTENT -->
    <section class="oleholeh-content">
        <div class="container py-5">


            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 text-center h-100">
                        <div class="card-body">
                            <img src="{{ asset('logo/LOGO RAKERNAS JKPI TERNATE 2026 - BLACK.png') }}"
                                class="img-fluid mb-3" style="max-height:180px;">

                            <h5 class="fw-bold">Logo JKPI Monokrom</h5>

                            <a href="{{ asset('logo/LOGO RAKERNAS JKPI TERNATE 2026 - BLACK.png') }}"
                                class="nrr-cta-btn mt-3" download>
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 text-center h-100">
                        <div class="card-body">
                            <img src="{{ asset('logo/LOGO RAKERNAS JKPI TERNATE 2026 - CLOUR.png') }}"
                                class="img-fluid mb-3" style="max-height:180px;">

                            <h5 class="fw-bold">Logo JKPI Berwarna</h5>

                            <a href="{{ asset('logo/LOGO RAKERNAS JKPI TERNATE 2026 - CLOUR.png') }}"
                                class="nrr-cta-btn mt-3" download>
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 text-center h-100">
                        <div class="card-body ">
                            <img src="{{ asset('logo/LOGO RAKERNAS JKPI TERNATE 2026 - WHITE.png') }}"
                                class="img-fluid mb-3 bg-dark rounded-4" style="max-height:180px;">

                            <h5 class="fw-bold">Logo JKPI Putih</h5>

                            <a href="{{ asset('logo/LOGO RAKERNAS JKPI TERNATE 2026 - WHITE.png') }}"
                                class="nrr-cta-btn mt-3" download>
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // ========== DATA TOKO OLEH-OLEH ==========
        const oleholehData = [{
                no: 1,
                name: "Tara No Ate",
                phone: ["085256408438", "082241346428"],
                address: [{
                    label: null,
                    text: "Jl. Sultan M.Djabir Sjah, Kel. Gamalama"
                }]
            },
            {
                no: 2,
                name: "Pakesang",
                phone: ["082395762900"],
                address: [{
                        label: "Outlet 1",
                        text: "Jl. Kapitan Pattimura, Kalumpang"
                    },
                    {
                        label: "Outlet 2",
                        text: "Jl. Sultan M Djabir Sjah, Salero"
                    },
                    {
                        label: "Produksi",
                        text: "Kasturian"
                    }
                ]
            },
            {
                no: 3,
                name: "Falatanawan",
                phone: ["082196390277", "082191019173"],
                address: [{
                    label: null,
                    text: "Kel. Maliaro RT14/RW05"
                }]
            },
            {
                no: 4,
                name: "Ummi Habibie",
                phone: ["08114314483"],
                address: [{
                    label: null,
                    text: "Jl. Sayyid Abubakar Bin Salim Alhaddar No.09 RT03/RW03, Lingkungan Tabahawa, Kel. Salahuddin"
                }]
            },
            {
                no: 5,
                name: "Ne Gam Macahaya",
                phone: ["085241936764"],
                address: [{
                    label: null,
                    text: "Jl. Cengkeh Afo, Kel. Marikurubu"
                }]
            },
            {
                no: 6,
                name: "Depot Muhajirin",
                phone: ["081342078864"],
                address: [{
                    label: null,
                    text: "Kampung Kodok, Lingk Jl. Falajawa No.1 Muhajirin"
                }]
            },
            {
                no: 7,
                name: "Depot Utama",
                phone: [],
                address: [{
                    label: null,
                    text: "Jl. Nukila No.13 Gamalama"
                }]
            },
            {
                no: 8,
                name: "Depot Nukila",
                phone: ["081226104208"],
                address: [{
                    label: null,
                    text: "Gang Habib Abubakar Al Attas, Jl. Nukila, Gamalama"
                }]
            },
            {
                no: 9,
                name: "Ifamoy",
                phone: ["081340054052"],
                address: [{
                    label: null,
                    text: "Jl. Balibunga, RT006/RW002, Tabona"
                }]
            },
            {
                no: 10,
                name: "Serba Usaha",
                phone: ["081343946825"],
                address: [{
                    label: null,
                    text: "Jl. Kapitan Pattimura RT001/RW002, Lingkungan Fotododara, Kalumpang"
                }]
            },
            {
                no: 11,
                name: "Etnik Sablon",
                phone: ["081311124971"],
                address: [{
                    label: null,
                    text: "Gamalama"
                }]
            },
            {
                no: 12,
                name: "TH Oleh-oleh Ternate",
                phone: ["082190088770"],
                address: [{
                    label: null,
                    text: "Jalan Pemuda, Siko Lampu Merah (Depan Jalan Raya), Sangaji"
                }]
            }
        ];

        // ========== RENDER ==========
        function render() {
            const search = document.getElementById('oleholehSearch').value.toLowerCase();

            const filtered = oleholehData.filter(k => {
                const addrText = k.address.map(a => a.text).join(' ').toLowerCase();
                return k.name.toLowerCase().includes(search) || addrText.includes(search);
            });

            document.getElementById('oleholehCount').textContent = filtered.length;

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
                // Phone numbers
                const phonesHtml = k.phone.length > 0 ?
                    k.phone.map(p =>
                        `<div class="oleholeh-info-row">
                            <i class="bi bi-telephone-fill"></i>
                            <a href="tel:${p}">${p}</a>
                        </div>`
                    ).join('') :
                    '';

                // Address with optional outlet labels
                const multiOutlet = k.address.length > 1;
                const addrHtml = multiOutlet ?
                    `<div class="oleholeh-info-row" style="align-items:flex-start;">
                            <i class="bi bi-geo-alt-fill" style="margin-top:4px;"></i>
                            <div class="outlet-list">
                                ${k.address.map(a => `
                                                                                                            <div class="outlet-item">
                                                                                                                ${a.label ? `<span class="outlet-label">${a.label}</span>` : ''}
                                                                                                                <span>${a.text}</span>
                                                                                                            </div>
                                                                                                        `).join('')}
                            </div>
                        </div>` :
                    `<div class="oleholeh-info-row">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>${k.address[0].text}</span>
                        </div>`;

                return `
                    <div class="oleholeh-card" style="animation-delay: ${Math.min(i * 0.05, 0.6)}s">
                        <div class="oleholeh-card-header">
                            <div class="oleholeh-number">${k.no}</div>
                            <span class="oleholeh-badge"><i class="bi bi-bag-heart-fill me-1"></i>Oleh-Oleh</span>
                        </div>
                        <div class="oleholeh-name">${k.name}</div>
                        <div class="oleholeh-info">
                            ${phonesHtml}
                            ${addrHtml}
                        </div>
                    </div>
                `;
            }).join('');

            // Render table
            tableBody.innerHTML = filtered.map(k => {
                const phonesTable = k.phone.length > 0 ?
                    k.phone.map(p =>
                        `<div class="table-oleholeh-phone"><a href="tel:${p}" style="color:var(--primary);text-decoration:none;">${p}</a></div>`
                    ).join('') :
                    '<span style="color:#ccc;">-</span>';

                const addrTable = k.address.map(a =>
                    a.label ?
                    `<div class="table-oleholeh-address"><strong style="color:var(--primary);font-size:0.75rem;">[${a.label}]</strong> ${a.text}</div>` :
                    `<div class="table-oleholeh-address">${a.text}</div>`
                ).join('');

                return `
                    <tr>
                        <td>${k.no}</td>
                        <td><div class="table-oleholeh-name">${k.name}</div></td>
                        <td>${phonesTable}</td>
                        <td>${addrTable}</td>
                    </tr>
                `;
            }).join('');
        }

        // ========== EVENT LISTENERS ==========
        document.getElementById('oleholehSearch').addEventListener('input', render);

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
