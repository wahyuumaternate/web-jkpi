@extends('layouts.main')

@section('title', 'Buku Panduan - Rakernas XII JKPI 2026 Kota Ternate')

@push('styles')
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
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
        }

        html,
        body {
            background: #f4f1ec;
            color: var(--dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ========== HEADER ========== */
        .panduan-header {
            background: linear-gradient(135deg, #0a2a3c 0%, #0d4f5e 40%, #099aa7 100%);
            color: white;
            padding: 50px 0;
            position: relative;
            overflow: hidden;
        }

        .panduan-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.05;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .panduan-header-content {
            position: relative;
            z-index: 2;
        }

        .header-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
        }

        .header-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .header-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        /* ========== MAIN CONTENT ========== */
        .panduan-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* ========== VIEWER TOOLBAR ========== */
        .pdf-toolbar {
            background: white;
            border-radius: 12px 12px 0 0;
            border: 1px solid var(--border);
            border-bottom: none;
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .toolbar-group {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-right: 12px;
            border-right: 1px solid var(--border);
        }

        .toolbar-group:last-child {
            border-right: none;
            padding-right: 0;
        }

        .toolbar-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .toolbar-input {
            padding: 8px 12px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 0.9rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            width: 60px;
            text-align: center;
            transition: border-color 0.2s;
        }

        .toolbar-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(9, 154, 167, 0.1);
        }

        .toolbar-btn {
            padding: 10px 16px;
            border: 1.5px solid var(--border);
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--dark);
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .toolbar-btn:hover {
            border-color: var(--primary);
            background: var(--primary-light);
            color: var(--primary-dark);
        }

        .toolbar-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .toolbar-btn.primary {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .toolbar-btn.primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .toolbar-spacer {
            flex: 1;
        }

        .zoom-controls {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .zoom-slider {
            width: 120px;
            height: 4px;
            border-radius: 2px;
            background: var(--border);
            outline: none;
            -webkit-appearance: none;
            appearance: none;
        }

        .zoom-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--primary);
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(9, 154, 167, 0.3);
        }

        .zoom-slider::-moz-range-thumb {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--primary);
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 6px rgba(9, 154, 167, 0.3);
        }

        .zoom-percent {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--gray);
            min-width: 45px;
            text-align: right;
        }

        /* ========== PDF VIEWER ========== */
        .pdf-viewer-wrapper {
            background: white;
            border: 1px solid var(--border);
            border-radius: 0 0 12px 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .pdf-viewer-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            background: #f8f9fa;
            min-height: 500px;
            padding: 20px;
            overflow-y: auto;
            max-height: 85vh;
        }

        #pdfViewer {
            max-width: 100%;
            height: auto;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-radius: 4px;
        }

        .pdf-loading {
            display: none;
            text-align: center;
            padding: 40px 20px;
            color: var(--gray);
        }

        .pdf-loading.active {
            display: block;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--border);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto 16px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .pdf-error {
            display: none;
            background: #fdecec;
            border: 1px solid #f5c6c6;
            color: #9b2a2a;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .pdf-error.active {
            display: block;
        }

        /* ========== INFO PANEL ========== */
        .panduan-info {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .info-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--primary);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .info-item {
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-light) 0%, #f0fafb 100%);
            border-radius: 8px;
            border-left: 4px solid var(--primary);
        }

        .info-item-label {
            font-size: 0.8rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .info-item-value {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .header-title {
                font-size: 2rem;
            }

            .pdf-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .toolbar-group {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid var(--border);
                padding-right: 0;
                padding-bottom: 12px;
            }

            .toolbar-group:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }

            .toolbar-spacer {
                display: none;
            }

            .zoom-controls {
                width: 100%;
                justify-content: space-between;
            }

            .zoom-slider {
                flex: 1;
                margin: 0 12px;
            }

            .pdf-viewer-container {
                min-height: 400px;
                max-height: 70vh;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .panduan-container {
                padding: 20px 16px;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 1.5rem;
            }

            .toolbar-btn {
                padding: 8px 12px;
                font-size: 0.85rem;
            }

            .toolbar-label {
                font-size: 0.75rem;
            }

            .toolbar-input {
                width: 50px;
                font-size: 0.85rem;
            }

            .zoom-percent {
                font-size: 0.8rem;
                min-width: 40px;
            }

            .pdf-viewer-container {
                min-height: 300px;
                max-height: 60vh;
                padding: 16px;
            }

            .info-title {
                font-size: 1.3rem;
            }
        }

        /* ========== PRINT STYLES ========== */
        @media print {

            .panduan-header,
            .pdf-toolbar,
            .panduan-info {
                display: none !important;
            }

            .pdf-viewer-container {
                background: white;
                box-shadow: none;
                padding: 0;
                max-height: none;
            }

            #pdfViewer {
                box-shadow: none;
                max-width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    {{-- HEADER --}}
    <section class="panduan-header mt-5">
        <div class="container panduan-header-content mt-5">
            <div class="header-badge">
                <i class="bi bi-book-fill me-2"></i>Buku Panduan Lengkap
            </div>
            <h1 class="header-title text-white">Rakernas XII JKPI 2026</h1>
            <p class="header-subtitle">Jaringan Kota Pusaka Indonesia • Kota Ternate, Maluku Utara</p>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <div class="panduan-container">

        {{-- ERROR ALERT --}}
        <div class="pdf-error" id="pdfError">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Error:</strong> <span id="errorMessage"></span>
        </div>

        {{-- TOOLBAR --}}
        <div class="pdf-toolbar">
            <div class="toolbar-group">
                <button class="toolbar-btn" id="prevBtn" onclick="prevPage()" title="Halaman Sebelumnya">
                    <i class="bi bi-chevron-left"></i> Sebelumnya
                </button>
                <input type="number" class="toolbar-input" id="pageNum" value="1" min="1"
                    onchange="gotoPage()" title="Nomor Halaman">
                <span class="toolbar-label" id="pageCount">/ 0</span>
                <button class="toolbar-btn" id="nextBtn" onclick="nextPage()" title="Halaman Berikutnya">
                    Berikutnya <i class="bi bi-chevron-right"></i>
                </button>
            </div>

            <div class="toolbar-spacer"></div>

            <div class="toolbar-group">
                <span class="toolbar-label">Zoom</span>
                <button class="toolbar-btn" onclick="zoomOut()" title="Perkecil">
                    <i class="bi bi-zoom-out"></i>
                </button>
                <input type="range" class="zoom-slider" id="zoomSlider" min="50" max="200" value="100"
                    onchange="setZoom()">
                <span class="zoom-percent" id="zoomPercent">100%</span>
                <button class="toolbar-btn" onclick="zoomIn()" title="Perbesar">
                    <i class="bi bi-zoom-in"></i>
                </button>
            </div>

            <div class="toolbar-group">
                <a href="{{ asset('Buku-Panduan-Rakernas-JKPI-XI-Yogyakarta-2025_Batch-Compress.pdf') }}"
                    class="toolbar-btn primary" download title="Download PDF">
                    <i class="bi bi-download"></i> Download
                </a>
                <button class="toolbar-btn" onclick="window.print()" title="Cetak">
                    <i class="bi bi-printer"></i> Cetak
                </button>
            </div>
        </div>

        {{-- PDF VIEWER --}}
        <div class="pdf-viewer-wrapper">
            <div class="pdf-loading" id="pdfLoading">
                <div class="spinner"></div>
                <p>Memuat dokumen...</p>
            </div>
            <div class="pdf-viewer-container">
                <canvas id="pdfViewer"></canvas>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        // Setup PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        const pdfUrl = '{{ asset('Buku-Panduan-Rakernas-JKPI-XI-Yogyakarta-2025_Batch-Compress.pdf') }}';
        const canvas = document.getElementById('pdfViewer');
        const ctx = canvas.getContext('2d');

        let pdfDoc = null;
        let currentPage = 1;
        let currentZoom = 100;

        // Load PDF
        async function loadPDF() {
            try {
                showLoading(true);
                hideError();

                pdfDoc = await pdfjsLib.getDocument(pdfUrl).promise;
                document.getElementById('pageCount').textContent = '/ ' + pdfDoc.numPages;
                document.getElementById('pageNum').max = pdfDoc.numPages;

                await renderPage(currentPage);
                showLoading(false);
            } catch (error) {
                console.error('Error loading PDF:', error);
                showError('Gagal memuat dokumen PDF. Silakan coba lagi atau download file langsung.');
                showLoading(false);
            }
        }

        // Render Page
        async function renderPage(pageNum) {
            try {
                showLoading(true);

                if (pageNum < 1 || pageNum > pdfDoc.numPages) {
                    pageNum = 1;
                }

                currentPage = pageNum;
                document.getElementById('pageNum').value = pageNum;

                const page = await pdfDoc.getPage(pageNum);
                const scale = currentZoom / 100;
                const viewport = page.getViewport({
                    scale: scale
                });

                canvas.width = viewport.width;
                canvas.height = viewport.height;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                await page.render(renderContext).promise;

                // Update button states
                document.getElementById('prevBtn').disabled = pageNum === 1;
                document.getElementById('nextBtn').disabled = pageNum === pdfDoc.numPages;

                showLoading(false);
            } catch (error) {
                console.error('Error rendering page:', error);
                showError('Gagal menampilkan halaman. Silakan coba lagi.');
                showLoading(false);
            }
        }

        // Navigation
        function nextPage() {
            if (currentPage < pdfDoc.numPages) {
                renderPage(currentPage + 1);
            }
        }

        function prevPage() {
            if (currentPage > 1) {
                renderPage(currentPage - 1);
            }
        }

        function gotoPage() {
            const pageNum = parseInt(document.getElementById('pageNum').value);
            if (!isNaN(pageNum)) {
                renderPage(pageNum);
            }
        }

        // Zoom
        function zoomIn() {
            if (currentZoom < 200) {
                currentZoom += 10;
                setZoom();
            }
        }

        function zoomOut() {
            if (currentZoom > 50) {
                currentZoom -= 10;
                setZoom();
            }
        }

        function setZoom() {
            currentZoom = parseInt(document.getElementById('zoomSlider').value);
            document.getElementById('zoomPercent').textContent = currentZoom + '%';
            renderPage(currentPage);
        }

        // UI Helpers
        function showLoading(show) {
            const loadingEl = document.getElementById('pdfLoading');
            if (show) {
                loadingEl.classList.add('active');
            } else {
                loadingEl.classList.remove('active');
            }
        }

        function showError(message) {
            const errorEl = document.getElementById('pdfError');
            document.getElementById('errorMessage').textContent = message;
            errorEl.classList.add('active');
        }

        function hideError() {
            const errorEl = document.getElementById('pdfError');
            errorEl.classList.remove('active');
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') nextPage();
            if (e.key === 'ArrowLeft') prevPage();
            if (e.key === '+' || e.key === '=') zoomIn();
            if (e.key === '-') zoomOut();
        });

        // Load PDF on page load
        document.addEventListener('DOMContentLoaded', loadPDF);
    </script>
@endpush
