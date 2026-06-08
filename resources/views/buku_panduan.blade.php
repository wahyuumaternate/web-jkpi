@extends('layouts.main')

@section('title', 'Buku Panduan - Rakernas XII JKPI 2026 Kota Ternate')

@push('styles')
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #099aa7;
            --primary-dark: #077b86;
            --primary-light: #e6f7f8;
            --dark: #1a1a2e;
            --gray: #6c757d;
            --border: #e3e7ec;
        }

        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            box-sizing: border-box;
        }

        html,
        body {
            background: #f4f1ec;
            color: var(--dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* ================= HEADER ================= */

        .panduan-header {
            background:
                linear-gradient(135deg,
                    #0a2a3c 0%,
                    #0d4f5e 40%,
                    #099aa7 100%);
            color: white;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .panduan-header::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(45deg, rgba(255, 255, 255, 0.04) 0 1px, transparent 1px 18px),
                repeating-linear-gradient(-45deg, rgba(255, 255, 255, 0.03) 0 1px, transparent 1px 18px);
            opacity: 0.9;
            pointer-events: none;
        }

        .panduan-header::after {
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

        .panduan-header-content {
            position: relative;
            z-index: 2;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .12);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .2);
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .header-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 10px;
            color: white;
        }

        .header-subtitle {
            font-size: 1.1rem;
            opacity: .9;
        }

        /* ================= CONTAINER ================= */

        .panduan-container {
            max-width: 1400px;
            margin: auto;
            padding: 40px 20px;
        }

        /* ================= TOOLBAR ================= */

        .pdf-toolbar {
            background: white;
            border-radius: 18px 18px 0 0;
            border: 1px solid var(--border);
            border-bottom: none;
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .toolbar-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .toolbar-spacer {
            flex: 1;
        }

        .toolbar-btn {
            border: none;
            background: #f8fafc;
            color: var(--dark);
            padding: 10px 16px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: .25s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .toolbar-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-1px);
        }

        .toolbar-btn.primary {
            background: var(--primary);
            color: white;
        }

        .toolbar-btn.primary:hover {
            background: var(--primary-dark);
        }

        .toolbar-input {
            width: 70px;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            font-weight: 600;
        }

        .toolbar-label {
            font-weight: 600;
            color: var(--gray);
        }

        .zoom-percent {
            min-width: 55px;
            font-weight: 700;
            color: var(--gray);
        }

        /* ================= VIEWER ================= */

        .pdf-viewer-wrapper {
            background: white;
            border: 1px solid var(--border);
            border-radius: 0 0 20px 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        /* Container scales with flipbook height + padding */
        .pdf-viewer-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            overflow: auto;
            position: relative;
            background:
                radial-gradient(circle at center,
                    #34495e 0%,
                    #1e293b 100%);
            /* min-height ditentukan JS setelah tahu dimensi PDF */
            min-height: 60vh;
        }

        /* ================= FLIPBOOK ================= */

        /* Ukuran di-set oleh JS, bukan CSS */
        #flipbook {
            margin: auto;
            flex-shrink: 0;
            transition: transform .3s ease;
            transform-origin: center center;
        }

        .page {
            background: white;
            overflow: hidden;
        }

        .page canvas {
            display: block;
            width: 100%;
            height: 100%;
        }

        .stf__parent {
            margin: auto;
        }

        .stf__block {
            box-shadow: 0 15px 40px rgba(0, 0, 0, .35);
        }

        /* ================= LOADING ================= */

        .pdf-loading {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, .7);
            z-index: 50;
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            backdrop-filter: blur(4px);
        }

        .pdf-loading.active {
            display: flex;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, .2);
            border-top-color: white;
            border-radius: 50%;
            animation: spin .7s linear infinite;
            margin-bottom: 16px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 768px) {
            .header-title {
                font-size: 2.2rem;
            }

            .pdf-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .toolbar-group {
                justify-content: center;
                flex-wrap: wrap;
            }

            .pdf-viewer-container {
                padding: 12px;
                min-height: 55vh;
            }
        }
    </style>
@endpush

@section('content')

    {{-- HEADER --}}
    <section class="panduan-header mt-5">
        <div class="container panduan-header-content mt-5">

            <div class="header-badge">
                <i class="bi bi-book-fill"></i>
                Buku Panduan Lengkap
            </div>

            <h1 class="header-title">
                Rakernas XII JKPI 2026
            </h1>

            <p class="header-subtitle">
                Jaringan Kota Pusaka Indonesia • Kota Ternate
            </p>

        </div>
    </section>

    {{-- CONTENT --}}
    <div class="panduan-container">

        {{-- TOOLBAR --}}
        <div class="pdf-toolbar">

            <div class="toolbar-group">

                <button class="toolbar-btn" onclick="prevPage()">
                    <i class="bi bi-chevron-left"></i>
                    Prev
                </button>

                <input type="number" class="toolbar-input" id="pageNum" value="1" min="1"
                    onchange="gotoPage()">

                <span class="toolbar-label" id="pageCount">/ 0</span>

                <button class="toolbar-btn" onclick="nextPage()">
                    Next
                    <i class="bi bi-chevron-right"></i>
                </button>

            </div>

            <div class="toolbar-spacer"></div>

            <div class="toolbar-group">

                <button class="toolbar-btn" onclick="zoomOut()">
                    <i class="bi bi-zoom-out"></i>
                </button>

                <span class="zoom-percent" id="zoomPercent">100%</span>

                <button class="toolbar-btn" onclick="zoomIn()">
                    <i class="bi bi-zoom-in"></i>
                </button>

            </div>

            <div class="toolbar-group">

                <a href="{{ asset('buku_panduan.pdf') }}" download class="toolbar-btn primary">
                    <i class="bi bi-download"></i>
                    Download
                </a>

                <button class="toolbar-btn" onclick="toggleFullscreen()">
                    <i class="bi bi-arrows-fullscreen"></i>
                    Fullscreen
                </button>

            </div>

        </div>

        {{-- VIEWER --}}
        <div class="pdf-viewer-wrapper">

            <div class="pdf-viewer-container" id="viewerContainer">

                <div class="pdf-loading active" id="pdfLoading">
                    <div class="spinner"></div>
                    <p>Memuat buku panduan...</p>
                </div>

                <div id="flipbook"></div>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    {{-- PDF JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    {{-- PAGE FLIP --}}
    <script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script>

    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        const pdfUrl = "{{ asset('buku_panduan.pdf') }}";

        let pdfDoc = null;
        let pageFlip = null;
        let currentZoom = 1;

        // ═══════════════════════════════════════════
        //  LOAD PDF — dimensi mengikuti ukuran PDF
        // ═══════════════════════════════════════════

        async function loadPDF() {
            try {
                showLoading(true);

                pdfDoc = await pdfjsLib.getDocument(pdfUrl).promise;

                document.getElementById('pageCount').innerText =
                    '/ ' + pdfDoc.numPages;

                // ── 1. Ambil dimensi asli halaman pertama ──
                const firstPage = await pdfDoc.getPage(1);
                const rawViewport = firstPage.getViewport({
                    scale: 1
                });
                const pdfW = rawViewport.width; // lebar 1 halaman (pts)
                const pdfH = rawViewport.height; // tinggi 1 halaman (pts)

                // ── 2. Tentukan mode tampilan ──
                const isMobile = window.innerWidth < 768;
                const usePortrait = true; // mobile: 1 halaman | desktop: spread 2 halaman

                // ── 3. Hitung ruang yang tersedia ──
                const container = document.getElementById('viewerContainer');
                const padding = isMobile ? 24 : 80; // kiri + kanan
                const availW = container.clientWidth - padding;
                const availH = Math.max(window.innerHeight * 0.82, 400);

                // ── 4. Hitung ukuran display 1 halaman ──
                //    Aspect ratio dipertahankan dari PDF asli
                let pageDispW, pageDispH;

                // if (usePortrait) {
                //     // Muat 1 halaman → fit ke availW / availH
                //     pageDispH = availH;
                //     pageDispW = pageDispH * (pdfW / pdfH);
                //     if (pageDispW > availW) {
                //         pageDispW = availW;
                //         pageDispH = pageDispW * (pdfH / pdfW);
                //     }
                // } else {
                //     // Spread 2 halaman → total lebar = 2 × pageDispW
                //     pageDispH = availH;
                //     pageDispW = pageDispH * (pdfW / pdfH);
                //     if (2 * pageDispW > availW) {
                //         pageDispW = availW / 2;
                //         pageDispH = pageDispW * (pdfH / pdfW);
                //     }
                // }
                pageDispH = availH;

                pageDispW = pageDispH * (pdfW / pdfH);

                if (pageDispW > availW) {

                    pageDispW = availW;

                    pageDispH = pageDispW * (pdfH / pdfW);
                }
                pageDispW = Math.round(pageDispW);
                pageDispH = Math.round(pageDispH);

                // ── 5. Atur tinggi container agar pas ──
                container.style.minHeight = (pageDispH + padding) + 'px';

                // ── 6. Render scale — 2× untuk kualitas tajam ──
                const renderScale = (pageDispW / pdfW) * 2;

                // ── 7. Render semua halaman ke canvas ──
                const pages = [];

                for (let n = 1; n <= pdfDoc.numPages; n++) {

                    const page = await pdfDoc.getPage(n);
                    const viewport = page.getViewport({
                        scale: renderScale
                    });

                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;

                    await page.render({
                        canvasContext: ctx,
                        viewport
                    }).promise;

                    const div = document.createElement('div');
                    div.classList.add('page');
                    div.style.width = pageDispW + 'px';
                    div.style.height = pageDispH + 'px';
                    div.appendChild(canvas);

                    pages.push(div);
                }

                // ── 8. Ukuran elemen flipbook ──
                const flipbookEl = document.getElementById('flipbook');
                const totalFlipW = pageDispW;
                flipbookEl.style.width = totalFlipW + 'px';
                flipbookEl.style.height = pageDispH + 'px';

                // ── 9. Init PageFlip ──
                pageFlip = new St.PageFlip(flipbookEl, {
                    width: pageDispW, // lebar 1 halaman
                    height: pageDispH, // tinggi 1 halaman

                    size: 'fixed',

                    minWidth: 100,
                    maxWidth: 3000,
                    minHeight: 100,
                    maxHeight: 5000,

                    showCover: false,

                    usePortrait: usePortrait, // false = spread horizontal

                    startZIndex: 0,

                    autoSize: false,

                    maxShadowOpacity: 0.3,

                    mobileScrollSupport: false,

                    swipeDistance: 30,

                    clickEventForward: true,

                    useMouseEvents: true,

                    flippingTime: 700,

                    drawShadow: true,

                    showPageCorners: true,

                    disableFlipByClick: false,
                });

                // loadFromHTML saja — tidak perlu updateFromHtml
                pageFlip.loadFromHTML(pages);

                // ── EVENT FLIP ──
                pageFlip.on('flip', (e) => {
                    document.getElementById('pageNum').value = e.data + 1;
                    playFlipSound();
                });

                showLoading(false);

            } catch (error) {
                console.error(error);
                alert('Gagal memuat PDF');
                showLoading(false);
            }
        }

        // ═══════════════════════════════════════════
        //  NAVIGASI
        // ═══════════════════════════════════════════

        function nextPage() {
            if (pageFlip) pageFlip.flipNext();
        }

        function prevPage() {
            if (pageFlip) pageFlip.flipPrev();
        }

        function gotoPage() {
            const page = parseInt(document.getElementById('pageNum').value);
            if (pageFlip) pageFlip.flip(page - 1);
        }

        // ═══════════════════════════════════════════
        //  ZOOM
        // ═══════════════════════════════════════════

        function zoomIn() {
            currentZoom = Math.min(currentZoom + 0.1, 3);
            applyZoom();
        }

        function zoomOut() {
            currentZoom = Math.max(currentZoom - 0.1, 0.4);
            applyZoom();
        }

        function applyZoom() {
            document.getElementById('flipbook').style.transform =
                `scale(${currentZoom})`;
            document.getElementById('zoomPercent').innerText =
                Math.round(currentZoom * 100) + '%';
        }

        // ═══════════════════════════════════════════
        //  FULLSCREEN
        // ═══════════════════════════════════════════

        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                document.exitFullscreen();
            }
        }

        // ═══════════════════════════════════════════
        //  LOADING
        // ═══════════════════════════════════════════

        function showLoading(show) {
            const loading = document.getElementById('pdfLoading');
            loading.classList.toggle('active', show);
        }

        // ═══════════════════════════════════════════
        //  SOUND
        // ═══════════════════════════════════════════

        function playFlipSound() {
            const sounds = [
                '/sounds/page-flip-1.mp3',
                '/sounds/page-flip-2.mp3',
                '/sounds/page-flip-3.mp3',
            ];
            const audio = new Audio(sounds[Math.floor(Math.random() * sounds.length)]);
            audio.volume = 0.35;
            audio.play().catch(() => {}); // abaikan jika browser blokir autoplay
        }

        // ═══════════════════════════════════════════
        //  KEYBOARD
        // ═══════════════════════════════════════════

        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') nextPage();
            if (e.key === 'ArrowLeft') prevPage();
            if (e.key === '+') zoomIn();
            if (e.key === '-') zoomOut();
        });

        // ═══════════════════════════════════════════
        //  INIT
        // ═══════════════════════════════════════════

        document.addEventListener('DOMContentLoaded', loadPDF);
    </script>
@endpush
