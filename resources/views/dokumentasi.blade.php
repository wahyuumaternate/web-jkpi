@extends('layouts.main')

@section('title', ($folderName ?? 'Dokumentasi') . ' - Rakernas XII JKPI 2026 Kota Ternate')
@section('meta_description',
    'Dokumentasi foto dan berkas kegiatan Rakernas XII JKPI 2026 di Kota Ternate. Galeri
    lengkap Jaringan Kota Pusaka Indonesia.')
@section('meta_robots', 'noindex, follow')
@section('og_title', ($folderName ?? 'Dokumentasi') . ' - Rakernas XII JKPI 2026')
@section('og_description', 'Galeri dokumentasi foto dan berkas kegiatan Rakernas XII JKPI 2026 di Kota Ternate.')

@push('schema')
    @php
        $breadcrumbSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Beranda',
                    'item' => url('/'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Dokumentasi',
                    'item' => url()->current(),
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

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
            border: none;
            cursor: pointer;
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
            grid-column: 1 / -1;
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

        .dok-modal {
            position: fixed;
            inset: 0;
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .dok-modal.active {
            display: flex;
        }

        .dok-modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(10, 20, 30, 0.85);
        }

        .dok-modal-content {
            position: relative;
            z-index: 1;
            max-width: 90vw;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .dok-modal-content img {
            max-width: 100%;
            max-height: 75vh;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        .dok-modal-footer {
            margin-top: 14px;
            display: flex;
            align-items: center;
            gap: 16px;
            color: #fff;
            font-weight: 600;
        }

        .dok-modal-close {
            position: absolute;
            top: -40px;
            right: -10px;
            background: none;
            border: none;
            color: #fff;
            font-size: 2rem;
            line-height: 1;
            cursor: pointer;
        }

        @media (max-width: 480px) {
            .dok-modal-close {
                top: -36px;
                right: 0;
            }
        }

        .dok-modal-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.25);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(6px);
            color: #fff;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }

        .dok-modal-nav:hover {
            background: rgba(255, 255, 255, 0.22);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .dok-modal-nav:disabled {
            opacity: 0.3;
            cursor: default;
            pointer-events: none;
        }

        .dok-modal-prev {
            left: 20px;
        }

        .dok-modal-next {
            right: 20px;
        }

        .dok-modal-pos {
            font-size: 0.8rem;
            opacity: 0.7;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .dok-modal-nav {
                width: 42px;
                height: 42px;
                font-size: 1.1rem;
            }

            .dok-modal-prev {
                left: 8px;
            }

            .dok-modal-next {
                right: 8px;
            }
        }

        @media (max-width: 480px) {
            .dok-modal-footer {
                flex-wrap: wrap;
                justify-content: center;
                text-align: center;
            }
        }

        /* ===== SELECT (hanya untuk gambar) ===== */
        .dok-select {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 3;
            width: 24px;
            height: 24px;
            display: none;
        }

        .dok-grid.select-mode .dok-card--image .dok-select {
            display: block;
        }

        .dok-card.selected {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(9, 154, 167, 0.18);
        }

        .dok-select-checkbox {
            width: 22px;
            height: 22px;
            cursor: pointer;
            accent-color: var(--primary);
        }
    </style>
@endpush

@section('content')
    <!-- HERO -->
    <section class="dok-hero">
        <div class="container">
            @unless ($isRoot)
                <a href="{{ route('dokumentasi', $parentFolderId) }}" class="hero-back" id="heroBackLink">
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

            @php
                $hasImages = collect($files)->contains(fn($f) => str_starts_with($f->getMimeType(), 'image/'));
            @endphp

            <!-- TOOLBAR -->
            <div class="toolbar-card">
                <div class="toolbar-row">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" id="dokSearch" placeholder="Cari nama folder atau berkas...">
                    </div>
                    <div class="result-count">Menampilkan <strong id="dokCount">{{ count($files) }}</strong> item</div>

                    @if ($hasImages)
                        <button type="button" id="dokSelectModeBtn" class="dok-action" style="background:#6c757d;">
                            <i class="bi bi-check2-square"></i> Pilih Gambar
                        </button>
                    @endif
                </div>

                @if ($hasImages)
                    <div class="toolbar-row" id="dokSelectionBar" style="display:none; margin-top:12px;">
                        <label style="display:flex; align-items:center; gap:6px; font-weight:600; font-size:0.9rem;">
                            <input type="checkbox" id="dokSelectAll"> Pilih Semua
                        </label>
                        <span class="result-count"><strong id="dokSelectedCount">0</strong> dipilih</span>
                        <button type="button" id="dokDownloadSelectedBtn" class="dok-action" disabled>
                            <i class="bi bi-download"></i> Unduh Terpilih (ZIP)
                        </button>
                        <button type="button" id="dokCancelSelectBtn" class="dok-action" style="background:#adb5bd;">
                            Batal
                        </button>
                    </div>
                @endif
            </div>

            <!-- GRID (satu level saja) -->
            <div class="dok-grid" id="dokGrid" data-folder-id="{{ $currentFolderId }}">
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
                        <div class="dok-card {{ $isImage ? 'dok-card--image' : '' }}"
                            data-name="{{ strtolower($file->getName()) }}" data-file-id="{{ $file->getId() }}"
                            style="animation-delay: {{ min($i * 0.05, 0.6) }}s">
                            <div class="dok-thumb {{ $isImage ? '' : 'dok-thumb--icon' }}"
                                @if ($isImage) data-preview
     data-full="{{ $file->getThumbnailLink() }}"
     data-name="{{ $file->getName() }}"
     data-download="{{ route('dokumentasi.download', $file->getId()) }}"
     style="cursor:pointer" @endif>
                                @if ($isImage)
                                    <label class="dok-select" onclick="event.stopPropagation()">
                                        <input type="checkbox" class="dok-select-checkbox" value="{{ $file->getId() }}">
                                    </label>
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

                <!-- NO RESULTS (pencarian) -->
                <div class="no-results" id="noResults" style="display:none;">
                    <i class="bi bi-folder2-open"></i>
                    <p>Tidak ada folder atau berkas yang sesuai pencarian Anda.</p>
                </div>

                {{-- Folder kosong (tidak ada item sama sekali) --}}
                @if (count($files) === 0)
                    <div class="no-results">
                        <i class="bi bi-folder2-open"></i>
                        <p>Folder ini masih kosong.</p>
                    </div>
                @endif
            </div>

            <!-- MODAL PREVIEW GAMBAR -->
            <div class="dok-modal" id="dokModal">
                <div class="dok-modal-backdrop" id="dokModalBackdrop"></div>

                <button type="button" class="dok-modal-nav dok-modal-prev" id="dokModalPrev" aria-label="Sebelumnya">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="dok-modal-content">
                    <button type="button" class="dok-modal-close" id="dokModalClose"
                        aria-label="Tutup">&times;</button>
                    <img id="dokModalImg" src="" alt="">
                    <div class="dok-modal-footer">
                        <span id="dokModalName"></span>
                        <span id="dokModalPos" class="dok-modal-pos"></span>
                        <a id="dokModalDownload" href="#" class="dok-action">
                            <i class="bi bi-download"></i> Unduh File
                        </a>
                    </div>
                </div>

                <button type="button" class="dok-modal-nav dok-modal-next" id="dokModalNext" aria-label="Berikutnya">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>

        </div>
    </section>
@endsection
@push('scripts')
    <script>
        // ===== SEARCH =====
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
        if (dokSearch) dokSearch.addEventListener('input', filterDok);

        // ===== NAVIGASI BERBASIS URL (tidak bergantung ke field "parents" Drive) =====
        (function() {
            const pathParts = window.location.pathname.split('/').filter(Boolean);
            const baseIndex = pathParts.indexOf('dokumentasi');
            if (baseIndex === -1) return;

            const basePath = '/' + pathParts.slice(0, baseIndex + 1).join('/'); // ex: /dokumentasi
            const currentId = pathParts.length > baseIndex + 1 ? pathParts[baseIndex + 1] : null;

            const params = new URLSearchParams(window.location.search);
            const trail = (params.get('trail') || '').split(',').filter(Boolean);

            // --- Perbaiki tombol "Kembali" ---
            const backLink = document.getElementById('heroBackLink');
            if (backLink) {
                const newTrail = trail.slice();
                const parentId = newTrail.length ? newTrail.pop() : null;
                let url = parentId ? `${basePath}/${parentId}` : basePath;
                if (newTrail.length) url += '?trail=' + encodeURIComponent(newTrail.join(','));
                backLink.setAttribute('href', url);
            }

            // --- Tambahkan jejak (trail) ke setiap link folder anak ---
            const nextTrail = currentId ? trail.concat([currentId]) : trail;
            if (nextTrail.length) {
                document.querySelectorAll('.dok-card--folder').forEach(card => {
                    const href = card.getAttribute('href');
                    if (!href) return;
                    const sep = href.includes('?') ? '&' : '?';
                    card.setAttribute('href', href + sep + 'trail=' + encodeURIComponent(nextTrail.join(',')));
                });
            }
        })();

        // ===== PREVIEW GAMBAR (MODAL) DENGAN NAVIGASI SEBELUM/SESUDAH =====
        (function() {
            const modal = document.getElementById('dokModal');
            const modalImg = document.getElementById('dokModalImg');
            const modalName = document.getElementById('dokModalName');
            const modalPos = document.getElementById('dokModalPos');
            const modalDownload = document.getElementById('dokModalDownload');
            const closeBtn = document.getElementById('dokModalClose');
            const backdrop = document.getElementById('dokModalBackdrop');
            const prevBtn = document.getElementById('dokModalPrev');
            const nextBtn = document.getElementById('dokModalNext');
            if (!modal) return;

            const thumbs = Array.from(document.querySelectorAll('.dok-thumb[data-preview]'));
            let currentIndex = -1;

            function toLarge(url) {
                return url.replace(/=s\d+(-c)?$/, '=s1600');
            }

            function renderAt(index) {
                if (index < 0 || index >= thumbs.length) return;
                currentIndex = index;
                const thumb = thumbs[currentIndex];
                modalImg.src = toLarge(thumb.dataset.full);
                modalName.textContent = thumb.dataset.name;
                modalDownload.href = thumb.dataset.download;
                modalPos.textContent = `${currentIndex + 1} / ${thumbs.length}`;

                prevBtn.style.display = thumbs.length > 1 ? '' : 'none';
                nextBtn.style.display = thumbs.length > 1 ? '' : 'none';
            }

            function openModal(index) {
                renderAt(index);
                modal.classList.add('active');
            }

            function closeModal() {
                modal.classList.remove('active');
                modalImg.src = '';
                currentIndex = -1;
            }

            function showPrev() {
                if (thumbs.length === 0) return;
                const next = (currentIndex - 1 + thumbs.length) % thumbs.length;
                renderAt(next);
            }

            function showNext() {
                if (thumbs.length === 0) return;
                const next = (currentIndex + 1) % thumbs.length;
                renderAt(next);
            }

            thumbs.forEach((thumb, index) => {
                thumb.addEventListener('click', (e) => {
                    if (dokGrid.classList.contains('select-mode')) {
                        e.stopImmediatePropagation();
                        e.preventDefault();
                        return;
                    }
                    openModal(index);
                });
            });

            closeBtn.addEventListener('click', closeModal);
            backdrop.addEventListener('click', closeModal);
            prevBtn.addEventListener('click', showPrev);
            nextBtn.addEventListener('click', showNext);

            document.addEventListener('keydown', (e) => {
                if (!modal.classList.contains('active')) return;
                if (e.key === 'Escape') closeModal();
                if (e.key === 'ArrowLeft') showPrev();
                if (e.key === 'ArrowRight') showNext();
            });
        })();

        // ===== MULTI-SELECT (HANYA GAMBAR) & DOWNLOAD ZIP TERPILIH =====
        (function() {
            const grid = document.getElementById('dokGrid');
            const selectModeBtn = document.getElementById('dokSelectModeBtn');
            if (!grid || !selectModeBtn) return;

            const cancelBtn = document.getElementById('dokCancelSelectBtn');
            const selectionBar = document.getElementById('dokSelectionBar');
            const selectAllCb = document.getElementById('dokSelectAll');
            const selectedCountEl = document.getElementById('dokSelectedCount');
            const downloadSelectedBtn = document.getElementById('dokDownloadSelectedBtn');

            function checkboxes() {
                // Hanya checkbox pada kartu gambar yang ikut terhitung.
                return Array.from(grid.querySelectorAll('.dok-card--image .dok-select-checkbox'));
            }

            function updateSelectedUI() {
                const boxes = checkboxes();
                const selected = boxes.filter(cb => cb.checked);
                selectedCountEl.textContent = selected.length;
                downloadSelectedBtn.disabled = selected.length === 0;
                selectAllCb.checked = boxes.length > 0 && selected.length === boxes.length;

                boxes.forEach(cb => {
                    cb.closest('.dok-card').classList.toggle('selected', cb.checked);
                });
            }

            function setSelectMode(on) {
                grid.classList.toggle('select-mode', on);
                selectionBar.style.display = on ? 'flex' : 'none';
                selectModeBtn.style.display = on ? 'none' : '';
                if (!on) {
                    checkboxes().forEach(cb => (cb.checked = false));
                    updateSelectedUI();
                }
            }

            selectModeBtn.addEventListener('click', () => setSelectMode(true));
            cancelBtn.addEventListener('click', () => setSelectMode(false));

            grid.addEventListener('change', (e) => {
                if (e.target.classList.contains('dok-select-checkbox')) {
                    updateSelectedUI();
                }
            });

            selectAllCb.addEventListener('change', () => {
                checkboxes().forEach(cb => (cb.checked = selectAllCb.checked));
                updateSelectedUI();
            });

            function getCsrfToken() {
                const meta = document.querySelector('meta[name="csrf-token"]');
                return meta ? meta.getAttribute('content') : '';
            }

            async function triggerZipDownload(url, options, fallbackName) {
                const originalLabel = options.buttonEl ? options.buttonEl.innerHTML : null;
                if (options.buttonEl) {
                    options.buttonEl.disabled = true;
                    options.buttonEl.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyiapkan ZIP...';
                }

                try {
                    const res = await fetch(url, options.fetchInit);
                    if (!res.ok) {
                        throw new Error('Gagal mengunduh ZIP (' + res.status + ')');
                    }
                    const blob = await res.blob();

                    let filename = fallbackName;
                    const disposition = res.headers.get('Content-Disposition');
                    if (disposition) {
                        const match = disposition.match(/filename="?([^"]+)"?/);
                        if (match) filename = match[1];
                    }

                    const link = document.createElement('a');
                    const objectUrl = URL.createObjectURL(blob);
                    link.href = objectUrl;
                    link.download = filename;
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                    URL.revokeObjectURL(objectUrl);
                } catch (err) {
                    alert('Gagal mengunduh ZIP: ' + err.message);
                } finally {
                    if (options.buttonEl) {
                        options.buttonEl.disabled = false;
                        options.buttonEl.innerHTML = originalLabel;
                    }
                }
            }

            downloadSelectedBtn.addEventListener('click', () => {
                const ids = checkboxes().filter(cb => cb.checked).map(cb => cb.value);
                if (ids.length === 0) return;

                triggerZipDownload(
                    '{{ route('dokumentasi.download-zip') }}', {
                        buttonEl: downloadSelectedBtn,
                        fetchInit: {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': getCsrfToken(),
                                'Accept': 'application/zip',
                            },
                            body: JSON.stringify({
                                ids
                            }),
                        },
                    },
                    'dokumentasi-terpilih.zip'
                );
            });
        })();
    </script>
@endpush
