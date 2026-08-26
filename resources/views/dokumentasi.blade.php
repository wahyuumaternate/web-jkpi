@extends('layouts.main')

@section('title', 'Dokumentasi - Rakernas XII JKPI 2026 Kota Ternate')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #099aa7;
            --primary-dark: #077b86;
            --primary-light: #e6f7f8;
            --gold: #099aa7;
            --gold-light: #fef9e7;
            --green: #1a8a4a;
            --green-light: #e8f5ee;
            --gray: #6c757d;
            --gray-light: #f8f9fa;
            --dark: #1a1a2e;
        }

        /* ========== HERO SECTION ========== */
        .dok-hero {
            position: relative;
            padding: 140px 0 80px;
            background: linear-gradient(135deg, #0a2a3c 0%, #0d4f5e 40%, #099aa7 100%);
            overflow: hidden;
            color: white;
        }

        .dok-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(45deg, rgba(255, 255, 255, 0.04) 0 1px, transparent 1px 18px),
                repeating-linear-gradient(-45deg, rgba(255, 255, 255, 0.03) 0 1px, transparent 1px 18px);
            opacity: 0.9;
            pointer-events: none;
        }

        .dok-hero::after {
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

        .dok-hero .container {
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

        .hero-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 18px;
            padding: 7px 16px 7px 10px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            background: rgba(255, 255, 255, 0.08);
            transition: all 0.2s;
        }

        .hero-back:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.16);
            border-color: rgba(255, 255, 255, 0.4);
        }

        /* ========== MAIN CONTENT ========== */
        .dok-content {
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

        /* ========== GRID ========== */
        .dok-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }

        .dok-card {
            background: #fff;
            border-radius: 14px;
            border: 2px solid #eef1f5;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.4s ease forwards;
            opacity: 0;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
        }

        .dok-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary);
            transition: background 0.3s;
            z-index: 2;
        }

        .dok-card--folder::before {
            background: var(--gold);
        }

        .dok-card:hover {
            border-color: var(--primary);
            box-shadow: 0 8px 28px rgba(9, 154, 167, 0.12);
            transform: translateY(-3px);
        }

        .dok-card--folder:hover {
            border-color: var(--gold);
            box-shadow: 0 8px 28px rgba(212, 160, 23, 0.16);
        }

        .dok-thumb {
            position: relative;
            aspect-ratio: 4 / 3;
            background: var(--primary-light);
            overflow: hidden;
        }

        .dok-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.35s ease;
        }

        .dok-card:hover .dok-thumb img {
            transform: scale(1.05);
        }

        .dok-thumb--icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dok-thumb--icon i {
            font-size: 2.6rem;
            opacity: 0.55;
            color: var(--primary);
        }

        .dok-thumb--folder {
            background: var(--gold-light);
        }

        .dok-thumb--folder i {
            color: var(--gold);
            font-size: 2.9rem;
            opacity: 0.75;
        }

        .dok-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 11px;
            border-radius: 20px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            background: rgba(9, 154, 167, 0.92);
            color: #fff;
        }

        .dok-badge--folder {
            background: #077b86;
        }

        .dok-body {
            padding: 16px 18px 18px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex: 1;
        }

        .dok-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.35;
            margin: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .dok-action {
            margin-top: auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 9px 16px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
            background: var(--primary);
            color: #fff;
        }

        .dok-action:hover {
            background: var(--primary-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .dok-action--folder {
            background: var(--gold);
            color: #fff;
        }

        .dok-action--folder:hover {
            background: #077b86;
        }

        /* ========== NO RESULTS / EMPTY ========== */
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

        /* ========== RESPONSIVE ========== */
        @media (max-width: 992px) {
            .dok-hero {
                padding: 120px 0 70px;
            }

            .hero-title {
                font-size: 2.4rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .dok-hero {
                padding: 110px 0 60px;
            }

            .hero-title {
                font-size: 2rem;
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

            .search-box {
                min-width: 100%;
            }

            .search-box input {
                padding: 12px 14px 12px 42px;
            }

            .result-count {
                text-align: center;
            }

            .dok-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
            }
        }

        @media (max-width: 480px) {
            .dok-hero {
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

            .dok-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="dok-hero">
        <div class="container">
            @unless ($isRoot)
                <a href="{{ route('dokumentasi', $parentFolderId) }}" class="hero-back">
                    <i class="bi bi-arrow-90deg-up"></i> Kembali ke folder sebelumnya
                </a>
            @endunless

            <div class="hero-badge"><i class="bi bi-images me-2"></i>Galeri Kegiatan</div>
            <h1 class="hero-title text-white">
                @unless ($isRoot)
                    <i class="bi bi-folder-fill" style="font-size:0.75em;"></i>
                @endunless
                {{ $folderName ?? 'Dokumentasi' }}
            </h1>
            <p class="hero-subtitle">
                Foto dan berkas kegiatan Rakernas XII JKPI 2026 di Kota Ternate.
            </p>
            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-number" id="statTotal">{{ count($files) }}</span>
                    <span class="hero-stat-label">Total Item</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="dok-content">
        <div class="container">

            <!-- TOOLBAR -->
            <div class="toolbar-card">
                <div class="toolbar-row">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" id="dokSearch" placeholder="Cari nama folder atau berkas...">
                    </div>
                    <div class="result-count">Menampilkan <strong id="dokCount">{{ count($files) }}</strong> item</div>
                </div>
            </div>

            <!-- GRID -->
            <div class="dok-grid" id="dokGrid">
                @foreach ($files as $i => $file)
                    @php
                        $isFolder = $file->getMimeType() === 'application/vnd.google-apps.folder';
                        $isImage = str_starts_with($file->getMimeType(), 'image/');
                        $ext = strtoupper(pathinfo($file->getName(), PATHINFO_EXTENSION)) ?: 'FILE';
                    @endphp

                    @if ($isFolder)
                        <a href="{{ route('dokumentasi', $file->getId()) }}" class="dok-card dok-card--folder"
                            data-name="{{ strtolower($file->getName()) }}"
                            style="animation-delay: {{ min($i * 0.05, 0.6) }}s">
                            <div class="dok-thumb dok-thumb--icon dok-thumb--folder">
                                <i class="bi bi-folder-fill"></i>
                                <span class="dok-badge dok-badge--folder">Folder</span>
                            </div>
                            <div class="dok-body">
                                <p class="dok-name">{{ $file->getName() }}</p>
                                <span class="dok-action dok-action--folder">
                                    <i class="bi bi-box-arrow-in-right"></i> Buka Folder
                                </span>
                            </div>
                        </a>
                    @else
                        <div class="dok-card" data-name="{{ strtolower($file->getName()) }}"
                            style="animation-delay: {{ min($i * 0.05, 0.6) }}s">
                            <div class="dok-thumb {{ $isImage ? '' : 'dok-thumb--icon' }}">
                                @if ($isImage)
                                    <img src="{{ $file->getThumbnailLink() }}" alt="{{ $file->getName() }}"
                                        loading="lazy">
                                @else
                                    <i class="bi bi-file-earmark-text"></i>
                                @endif
                                <span class="dok-badge">{{ $ext }}</span>
                            </div>
                            <div class="dok-body">
                                <p class="dok-name">{{ $file->getName() }}</p>
                                <a href="{{ route('dokumentasi.download', $file->getId()) }}" class="dok-action">
                                    <i class="bi bi-download"></i> Unduh File
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- NO RESULTS -->
            <div class="no-results" id="noResults" style="display:none;">
                <i class="bi bi-folder2-open"></i>
                <p>Tidak ada folder atau berkas yang sesuai pencarian Anda.</p>
            </div>

            {{-- Empty folder (no items at all) --}}
            @if (count($files) === 0)
                <div class="no-results">
                    <i class="bi bi-folder2-open"></i>
                    <p>Folder ini masih kosong.</p>
                </div>
            @endif

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const dokSearch = document.getElementById('dokSearch');
        const dokGrid = document.getElementById('dokGrid');
        const dokCount = document.getElementById('dokCount');
        const noResults = document.getElementById('noResults');
        const cards = dokGrid ? Array.from(dokGrid.querySelectorAll('.dok-card')) : [];

        function filterDok() {
            const term = dokSearch.value.toLowerCase().trim();
            let visible = 0;

            cards.forEach(card => {
                const match = card.dataset.name.includes(term);
                card.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            dokCount.textContent = visible;
            noResults.style.display = (visible === 0 && cards.length > 0) ? 'block' : 'none';
        }

        if (dokSearch) {
            dokSearch.addEventListener('input', filterDok);
        }
    </script>
@endpush
