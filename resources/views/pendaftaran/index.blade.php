<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - Rakernas XII JKPI 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --jkpi-teal: #099aa7;
            --jkpi-dark: #077b86;
            --card-blue: #1B4D85;
            --card-dark-blue: #0F2A4A;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .page-wrap {
            padding: 80px 0 60px;
        }

        .preview-col {
            position: sticky;
            top: 20px;
            height: fit-content;
        }

        /* ===== FORM CARD ===== */
        .registration-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .registration-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .registration-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--jkpi-teal);
        }

        .registration-header p {
            font-size: 1rem;
            color: #666;
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--jkpi-teal);
            margin: 24px 0 14px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--jkpi-teal);
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .required {
            color: #dc3545;
            margin-left: 3px;
        }

        .form-control,
        .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--jkpi-teal);
            box-shadow: 0 0 0 0.2rem rgba(9, 154, 167, 0.15);
        }

        .custom-file-upload {
            border: 2px dashed var(--jkpi-teal);
            border-radius: 10px;
            padding: 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #f8f9fa;
        }

        .custom-file-upload:hover {
            background: #e9ecef;
        }

        .custom-file-upload i {
            font-size: 1.6rem;
            color: var(--jkpi-teal);
            display: block;
            margin-bottom: 4px;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--jkpi-teal) 0%, var(--jkpi-dark) 100%);
            color: #fff;
            padding: 13px 40px;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(9, 154, 167, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(9, 154, 167, 0.4);
            color: #fff;
        }

        /* ===== FLAT EVENT LIST ===== */
        .events-list-wrap {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 4px;
        }

        /* Summary counter */
        .event-summary-bar {
            background: linear-gradient(135deg, #e6f7f8, #f0fafb);
            border: 2px solid var(--jkpi-teal);
            border-radius: 12px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .event-count-label {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--jkpi-dark);
        }

        .event-count-badge {
            background: var(--jkpi-teal);
            color: #fff;
            font-size: 0.95rem;
            font-weight: 800;
            padding: 4px 14px;
            border-radius: 20px;
        }

        .select-all-btn {
            font-size: 0.78rem;
            padding: 4px 12px;
            border: 1.5px solid var(--jkpi-teal);
            border-radius: 20px;
            background: transparent;
            color: var(--jkpi-teal);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .select-all-btn:hover {
            background: var(--jkpi-teal);
            color: #fff;
        }

        /* Custom checkbox event item */
        .event-check-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
            border: 1.5px solid #e8ecf0;
            background: #fafbfc;
        }

        .event-check-item:hover {
            background: #f0fafb;
            border-color: #b8e9ec;
        }

        .event-check-item.selected {
            background: #e6f7f8;
            border-color: var(--jkpi-teal);
        }

        .event-check-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            min-width: 18px;
            margin-top: 3px;
            accent-color: var(--jkpi-teal);
            cursor: pointer;
        }

        .event-check-content {
            flex: 1;
        }

        .event-check-title {
            font-weight: 700;
            color: #1a1a1a;
            font-size: 0.88rem;
            line-height: 1.3;
        }

        .event-check-meta {
            font-size: 0.75rem;
            color: #888;
            margin-top: 3px;
        }

        .event-check-meta i {
            margin-right: 4px;
            color: var(--jkpi-teal);
        }

        /* Date chip */
        .event-date-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            color: #fff;
            white-space: nowrap;
            margin-bottom: 4px;
        }

        .chip-d1 {
            background: #1B4D85;
        }

        .chip-d2 {
            background: #0e6b74;
        }

        .chip-d24 {
            background: #0b5e6e;
        }

        .chip-d4 {
            background: #7b5e00;
        }

        .chip-d5 {
            background: #7b1f00;
        }

        .chip-multi {
            background: #555;
        }

        /* ===== PREVIEW PANEL ===== */
        .preview-panel {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .preview-label {
            text-align: center;
            font-weight: 700;
            color: var(--jkpi-teal);
            font-size: 1rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .live-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #28a745;
            animation: pulse 1.5s infinite;
            display: inline-block;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(1.3);
            }
        }

        /* ===== ID CARD ===== */
        .id-card-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .id-card {
            width: 256px;
            height: 340px;
            position: relative;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(0, 0, 0, 0.06);
            font-family: Arial, sans-serif;
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .id-card {
            width: 256px;
            height: 340px;
            position: relative;
            border-radius: 12px;
            overflow: hidden;

            background-image: url('{{ asset('culture3.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .id-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            /* bikin isi tetap kebaca */
            z-index: 0;
        }

        .id-card>* {
            position: relative;
            z-index: 1;
        }

        .id-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
        }

        .id-card:hover {
            transform: scale(1.02) rotate(0.5deg);
        }

        .card-top {
            width: 100%;
            height: 112px;
            background: var(--card-blue);
            position: relative;
            flex-shrink: 0;
            overflow: hidden;
        }

        .card-geo-1 {
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 78px 92px 0;
            border-color: transparent #163D6B transparent transparent;
            opacity: 0.6;
        }

        .card-geo-2 {
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 52px 65px 0;
            border-color: transparent #1B4D85 transparent transparent;
            opacity: 0.4;
        }

        .card-geo-3 {
            position: absolute;
            top: 30px;
            left: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 70px 0 0 58px;
            border-color: transparent transparent transparent #163D6B;
            opacity: 0.5;
        }

        .card-circle-1 {
            position: absolute;
            top: -18px;
            left: -18px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .card-circle-2 {
            position: absolute;
            bottom: 10px;
            right: -20px;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
        }

        .card-logo {
            position: absolute;
            top: 8px;
            left: 0;
            width: 100%;
            text-align: center;
            z-index: 10;
        }

        .card-logo-text {
            font-size: 19px;
            font-weight: 900;
            color: #fff;
            letter-spacing: 5px;
            display: block;
        }

        .card-logo-sub {
            font-size: 5px;
            color: #8BAFD0;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            line-height: 1.3;
            display: block;
            margin-top: 2px;
        }

        .card-event-name {
            font-size: 5.5px;
            color: #fff;
            margin-top: 3px;
            font-weight: 700;
            letter-spacing: 0.6px;
            opacity: 0.9;
            display: block;
        }

        .card-photo-wrap {
            position: absolute;
            top: 60px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 15;
        }

        .card-photo-ring {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #fff;
            overflow: hidden;
            background: #d0d8e4;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.22);
        }

        .card-photo-ring img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-initial {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 900;
            color: #fff;
            background: var(--card-blue);
        }

        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 44px 12px 10px;
            min-height: 0;
        }

        .card-info {
            width: 100%;
            text-align: center;
        }

        .card-name {
            font-size: 12.5px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.25;
            margin-bottom: 3px;
            transition: all 0.2s;
        }

        .card-institution {
            font-size: 8.5px;
            color: #ffffff;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 2px;
            transition: all 0.2s;
        }

        .card-jabatan {
            font-size: 6.5px;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
            transition: all 0.2s;
        }

        .card-badge {
            display: inline-block;
            background: var(--card-dark-blue);
            color: #fff;
            font-size: 6.5px;
            font-weight: 800;
            letter-spacing: 0.5px;
            padding: 4px 12px;
            border-radius: 8px;
        }

        .card-qr {
            text-align: center;
            width: 100%;
        }

        .card-qr-border {
            display: inline-block;
            padding: 3px;
            border: 1.5px solid #ddd;
            background: #fff;
            border-radius: 6px;
        }

        .card-qr-border img {
            width: 52px;
            height: 52px;
            display: block;
        }

        .card-qr-label {
            font-size: 5px;
            color: #bbb;
            margin-top: 3px;
            font-weight: 500;
            display: block;
        }

        .card-bottom-line {
            height: 3px;
            background: var(--card-dark-blue);
            flex-shrink: 0;
        }

        .placeholder-text {
            color: #ffffff !important;
            font-style: italic;
        }

        @keyframes cardPop {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.03);
            }

            100% {
                transform: scale(1);
            }
        }

        .card-pop {
            animation: cardPop 0.25s ease;
        }

        .preview-tip {
            margin-top: 16px;
            background: #f0fafb;
            border-left: 3px solid var(--jkpi-teal);
            border-radius: 0 8px 8px 0;
            padding: 10px 14px;
            font-size: 0.8rem;
            color: #555;
        }

        /* Selected events in preview */
        .selected-events-preview {
            margin-top: 16px;
            background: #fff;
            border: 2px solid #e0f4f5;
            border-radius: 12px;
            padding: 14px;
        }

        .sep-title {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--jkpi-teal);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .sep-item {
            display: flex;
            align-items: flex-start;
            gap: 6px;
            font-size: 0.76rem;
            color: #444;
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .sep-item i {
            color: var(--jkpi-teal);
            margin-top: 1px;
            flex-shrink: 0;
        }

        .sep-empty {
            font-size: 0.8rem;
            color: #bbb;
            font-style: italic;
            text-align: center;
            padding: 8px 0;
        }
    </style>
</head>

<body>
    <div class="page-wrap">
        <div class="container-xl">
            <div class="row g-4">

                <!-- ===== FORM ===== -->
                <div class="col-lg-7 form-col">
                    <div class="registration-card">
                        <div class="registration-header">
                            <h1><i class="bi bi-pencil-square me-2"></i>Formulir Pendaftaran</h1>
                            <p>Rakernas JKPI XII 2026 – Kota Ternate</p>
                        </div>
                        {{-- ===== FLASH MESSAGES — letakkan di atas form ===== --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('info'))
                            <div class="alert alert-info alert-dismissible fade show rounded-3 mb-4" role="alert">
                                <i class="bi bi-info-circle-fill me-2"></i>{{ session('info') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Ringkasan error validasi (opsional tapi sangat membantu) --}}
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-3 mb-4">
                                <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Mohon
                                    periksa kembali isian berikut:</div>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="registrationForm" enctype="multipart/form-data" method="POST"
                            action="{{ route('pendaftaran.store') }}">
                            @csrf
                            <!-- Data Pribadi -->
                            <h3 class="form-section-title"><i class="bi bi-person-fill me-2"></i>Data Pribadi</h3>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                        placeholder="Nama Lengkap">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jabatan <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                                        placeholder="Contoh : Kepala Dinas Kebudayaan">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Instansi/Organisasi <span
                                            class="required">*</span></label>
                                    <input type="text" class="form-control" id="instansi_organisasi"
                                        name="instansi_organisasi" placeholder="Contoh : Pemerintah Kota Ternate">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota/Kabupaten <span class="required">*</span></label>
                                    <select class="form-select" id="kota_kabupaten" name="kota_kabupaten">
                                        <option value="">Pilih Kota/Kabupaten</option>
                                        <optgroup label="Anggota JKPI">
                                            <option>Kota Ambon</option>
                                            <option>Kota Banda Aceh</option>
                                            <option>Kota Bengkulu</option>
                                            <option>Kota Bukittinggi</option>
                                            <option>Kota Baubau</option>
                                            <option>Kota Blitar</option>
                                            <option>Kota Banjarmasin</option>
                                            <option>Kota Bontang</option>
                                            <option>Kota Bogor</option>
                                            <option>Kota Cirebon</option>
                                            <option>Kota Jakarta Pusat</option>
                                            <option>Kota Langsa</option>
                                            <option>Kota Medan</option>
                                            <option>Kota Madiun</option>
                                            <option>Kota Malang</option>
                                            <option>Kota Palembang</option>
                                            <option>Kota Pekalongan</option>
                                            <option>Kota Padang</option>
                                            <option>Kota Palopo</option>
                                            <option>Kota Pontianak</option>
                                            <option>Kota Sawahlunto</option>
                                            <option>Kota Semarang</option>
                                            <option>Kota Surakarta</option>
                                            <option selected>Kota Ternate</option>
                                            <option>Kota Tegal</option>
                                            <option>Kota Yogyakarta</option>
                                            <option>Kota Surabaya</option>
                                            <option>Kota Denpasar</option>
                                            <option>Kota Bandung</option>
                                            <option>Kota Magelang</option>
                                            <option>Kota Kupang</option>
                                            <option>Kota Tidore</option>
                                            <option>Kota Tangerang</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <!-- Kontak -->
                            <h3 class="form-section-title"><i class="bi bi-telephone-fill me-2"></i>Informasi Kontak
                            </h3>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Telepon <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                                        placeholder="08xxxxxxxxxx">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email <span class="required">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="email@domain.com">
                                </div>
                            </div>

                            <!-- Foto -->
                            <h3 class="form-section-title"><i class="bi bi-camera-fill me-2"></i>Upload Foto Profil</h3>
                            <div class="mb-3">
                                <label class="form-label">Foto Profil <span
                                        class="text-muted">(Opsional)</span></label>
                                <div class="custom-file-upload" onclick="document.getElementById('foto').click()">
                                    <i class="bi bi-camera-fill"></i>
                                    <p class="mb-0 small">Klik untuk upload foto</p>
                                    <small class="text-muted">Format: JPG, PNG (Max: 2MB)</small>
                                </div>
                                <input type="file" class="d-none" id="foto" name="foto"
                                    accept="image/jpeg,image/jpg,image/png" onchange="handlePhotoUpload(this)">
                            </div>

                            <!-- ===== PILIHAN KEGIATAN (flat per-activity) ===== -->
                            <h3 class="form-section-title">
                                <i class="bi bi-calendar2-check-fill me-2"></i>Pilihan Kegiatan
                                <span class="required">*</span>
                            </h3>

                            <div class="event-summary-bar">
                                <div class="event-count-label">
                                    <i class="bi bi-check2-square me-2"></i>
                                    Kegiatan dipilih: <span class="event-count-badge" id="eventCountBadge">0</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="select-all-btn" onclick="selectAllEvents()">Pilih
                                        Semua</button>
                                    <button type="button" class="select-all-btn"
                                        style="border-color:#dc3545;color:#dc3545;"
                                        onmouseover="this.style.background='#dc3545';this.style.color='#fff'"
                                        onmouseout="this.style.background='transparent';this.style.color='#dc3545'"
                                        onclick="clearAllEvents()">Bersihkan</button>
                                </div>
                            </div>

                            <!-- Flat event list — satu checkbox per kegiatan unik -->
                            <div class="events-list-wrap">

                                <!-- 26 Agustus -->
                                <label class="event-check-item" id="item-1">
                                    <input type="checkbox" name="kegiatan[]" value="Welcome Dinner"
                                        onchange="onEventChange()">
                                    <div class="event-check-content">
                                        <span class="event-date-chip chip-d1">25 Agustus</span>
                                        <div class="event-check-title">Welcome Dinner</div>
                                        <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i>Pendopo
                                            Kediaman Wali Kota Ternate
                                        </div>
                                    </div>
                                </label>

                                <label class="event-check-item" id="item-2">
                                    <input type="checkbox" name="kegiatan[]"
                                        value="Simposium Internasional – Pulau-Pulau Penghasil Rempah"
                                        onchange="onEventChange()">
                                    <div class="event-check-content">
                                        <span class="event-date-chip chip-d1">26 Agustus</span>
                                        <div class="event-check-title">Simposium Internasional – "Pulau-Pulau Penghasil
                                            Rempah"</div>
                                        <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i>Bela Hotel
                                        </div>
                                    </div>
                                </label>

                                <label class="event-check-item" id="item-3">
                                    <input type="checkbox" name="kegiatan[]" value="Rapat Kerja Nasional"
                                        onchange="onEventChange()">
                                    <div class="event-check-content">
                                        <span class="event-date-chip chip-d1">26 Agustus</span>
                                        <div class="event-check-title">Rapat Kerja Nasional</div>
                                        <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i>Bela Hotel
                                        </div>
                                    </div>
                                </label>

                                <label class="event-check-item" id="item-4">
                                    <input type="checkbox" name="kegiatan[]"
                                        value="Pentas Budaya, Expo & Pameran Booth Kota JKPI"
                                        onchange="onEventChange()">
                                    <div class="event-check-content">
                                        <span class="event-date-chip chip-multi">26–29 Agustus</span>
                                        <div class="event-check-title">Pentas Budaya, Expo & Pameran Booth Kota JKPI
                                        </div>
                                        <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i>Lapangan
                                            Ngaralamo Salero</div>
                                    </div>
                                </label>

                                <!-- 27 Agustus -->
                                <label class="event-check-item" id="item-5">
                                    <input type="checkbox" name="kegiatan[]"
                                        value="Master Class (Economic Culture & Museum, Living Museum, Gastronomi, Bambu, Grafis)"
                                        onchange="onEventChange()">
                                    <div class="event-check-content">
                                        <span class="event-date-chip chip-d2">27 Agustus</span>
                                        <div class="event-check-title">Master Class</div>
                                        <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i>Berbagai Titik
                                            Cagar Budaya</div>
                                        <div class="event-check-meta" style="margin-top:3px;color:#666;">
                                            Economic Culture & Museum · Living Museum · Gastronomi Rempah · Pengolahan
                                            Bambu · Residensi Grafis
                                        </div>
                                    </div>
                                </label>

                                <label class="event-check-item" id="item-6">
                                    <input type="checkbox" name="kegiatan[]" value="Festival Gastronomi"
                                        onchange="onEventChange()">
                                    <div class="event-check-content">
                                        <span class="event-date-chip chip-d24">27–28 Agustus</span>
                                        <div class="event-check-title">Festival Gastronomi</div>
                                        <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i>Benteng Oranje
                                        </div>
                                    </div>
                                </label>

                                <label class="event-check-item" id="item-7">
                                    <input type="checkbox" name="kegiatan[]" value="Ladies Program"
                                        onchange="onEventChange()">
                                    <div class="event-check-content">
                                        <span class="event-date-chip chip-d24">27–28 Agustus</span>
                                        <div class="event-check-title">Ladies Program</div>
                                        <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i>Benteng Oranje
                                            & Pusat Kreatif</div>
                                    </div>
                                </label>

                                <!-- 29 Agustus -->
                                <label class="event-check-item" id="item-8">
                                    <input type="checkbox" name="kegiatan[]" value="Heritage City Tour"
                                        onchange="onEventChange()">
                                    <div class="event-check-content">
                                        <span class="event-date-chip chip-d4">29 Agustus</span>
                                        <div class="event-check-title">Heritage City Tour</div>
                                        <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i>Kadaton
                                            Kesultanan & Kawasan Cagar Budaya</div>
                                    </div>
                                </label>

                                <label class="event-check-item" id="item-9">
                                    <input type="checkbox" name="kegiatan[]" value="Pawai Budaya dan Karnaval"
                                        onchange="onEventChange()">
                                    <div class="event-check-content">
                                        <span class="event-date-chip chip-d4">29 Agustus</span>
                                        <div class="event-check-title">Pawai Budaya dan Karnaval</div>
                                        <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i>Benteng Oranje
                                            – Lapangan Ngaralamo Salero</div>
                                    </div>
                                </label>

                                <!-- 30 Agustus -->
                                <label class="event-check-item" id="item-10">
                                    <input type="checkbox" name="kegiatan[]" value="Nusantara Raya Run"
                                        onchange="onEventChange()">
                                    <div class="event-check-content">
                                        <span class="event-date-chip chip-d5">30 Agustus</span>
                                        <div class="event-check-title">Nusantara Raya Run</div>
                                        <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i>Fort to Fort
                                        </div>
                                    </div>
                                </label>

                                <label class="event-check-item" id="item-11">
                                    <input type="checkbox" name="kegiatan[]"
                                        value="Gelar Budaya dan Penyerahan Pataka" onchange="onEventChange()">
                                    <div class="event-check-content">
                                        <span class="event-date-chip chip-d5">30 Agustus</span>
                                        <div class="event-check-title">Gelar Budaya dan Penyerahan Pataka</div>
                                        <div class="event-check-meta"><i class="bi bi-geo-alt-fill"></i>Landmark
                                            Ternate</div>
                                    </div>
                                </label>



                            </div><!-- /events-list-wrap -->

                            <!-- Perjalanan -->
                            <h3 class="form-section-title"><i class="bi bi-airplane-fill me-2"></i>Perjalanan &
                                Akomodasi</h3>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Kedatangan <span
                                            class="required">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_kedatangan"
                                        name="tanggal_kedatangan">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Kepulangan <span
                                            class="required">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_kepulangan"
                                        name="tanggal_kepulangan">
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="agree">
                                    <label class="form-check-label small" for="agree">
                                        Saya menyetujui bahwa data yang saya berikan adalah benar dan dapat
                                        dipertanggungjawabkan.
                                        <span class="required">*</span>
                                    </label>
                                </div>
                            </div>

                            <div class="text-center">
                                <a href="/" class="btn btn-secondary me-2 rounded-pill px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="button" class="btn btn-secondary me-2 rounded-pill px-4"
                                    onclick="resetForm()">
                                    <i class="bi bi-x-circle me-2"></i>Batal
                                </button>
                                <button type="submit" class="btn btn-submit">
                                    <i class="bi bi-check-circle me-2"></i>Daftar Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ===== PREVIEW ===== -->
                <div class="col-lg-5 preview-col">
                    <div class="preview-panel">
                        <div class="preview-label">
                            <span class="live-dot"></span>
                            Preview ID Card – Real-time
                        </div>

                        <div class="id-card-container">
                            <div class="id-card" id="idCard">
                                <div class="card-top">
                                    <div class="card-geo-1"></div>
                                    <div class="card-geo-2"></div>
                                    <div class="card-geo-3"></div>
                                    <div class="card-circle-1"></div>
                                    <div class="card-circle-2"></div>
                                    <div class="card-logo">
                                        <span class="card-logo-text">JKPI</span>
                                        <span class="card-logo-sub">JARINGAN KOTA PUSAKA INDONESIA</span>
                                        <span class="card-event-name">RAKERNAS XII 2026 • TERNATE</span>
                                    </div>
                                </div>

                                <div class="card-photo-wrap">
                                    <div class="card-photo-ring" id="cardPhotoRing">
                                        <div class="card-initial">?</div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="card-info">
                                        <div class="card-name" id="cardName"><span class="placeholder-text">Nama
                                                Lengkap</span></div>
                                        <div class="card-institution" id="cardInstitution"><span
                                                class="placeholder-text">Instansi / Organisasi</span></div>
                                        <span class="card-jabatan" id="cardJabatan">JABATAN</span>
                                        <span class="card-badge" id="cardId">ID: JKPI2026-000</span>
                                    </div>

                                    <div class="card-qr">
                                        <div class="card-qr-border">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=104x104&data=JKPI2026-000&bgcolor=ffffff&color=0F2A4A"
                                                id="cardQr" alt="QR Code">
                                        </div>
                                        <span class="card-qr-label">Scan untuk verifikasi</span>
                                    </div>
                                </div>

                                <div class="card-bottom-line"></div>
                            </div>
                        </div>

                        <!-- Selected events summary below card -->
                        <div class="selected-events-preview" id="selectedEventsPreview">
                            <div class="sep-title"><i class="bi bi-calendar2-check"></i> Kegiatan yang Dipilih</div>
                            <div id="sepList">
                                <div class="sep-empty">Belum ada kegiatan yang dipilih</div>
                            </div>
                        </div>

                        <div class="preview-tip">
                            <i class="bi bi-info-circle me-1 text-teal"></i>
                            ID card ini adalah <strong>preview visual</strong>. Nomor ID resmi akan dihasilkan setelah
                            pendaftaran berhasil disubmit.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let photoDataUrl = null;

        function getInitials(name) {
            if (!name || !name.trim()) return '?';
            return name.trim().split(/\s+/).map(w => w[0]).join('').toUpperCase().slice(0, 2);
        }

        function popCard() {
            const card = document.getElementById('idCard');
            card.classList.remove('card-pop');
            void card.offsetWidth;
            card.classList.add('card-pop');
            card.addEventListener('animationend', () => card.classList.remove('card-pop'), {
                once: true
            });
        }

        function updateCard() {
            const nama = document.getElementById('nama_lengkap').value.trim();
            const jabatan = document.getElementById('jabatan').value.trim();
            const instansi = document.getElementById('instansi_organisasi').value.trim();

            document.getElementById('cardName').innerHTML = nama || '<span class="placeholder-text">Nama Lengkap</span>';
            document.getElementById('cardInstitution').innerHTML = instansi ||
                '<span class="placeholder-text">Instansi / Organisasi</span>';
            document.getElementById('cardJabatan').textContent = jabatan ? jabatan.toUpperCase() : 'JABATAN';

            const ring = document.getElementById('cardPhotoRing');
            if (photoDataUrl) {
                ring.innerHTML = `<img src="${photoDataUrl}" alt="Foto">`;
            } else {
                ring.innerHTML = `<div class="card-initial">${getInitials(nama)}</div>`;
            }

            const stableId = nama ?
                'JKPI2026-' + btoa(nama).replace(/[^A-Z0-9]/gi, '').slice(0, 8).toUpperCase() :
                'JKPI2026-000';
            document.getElementById('cardId').textContent = `ID: ${stableId}`;
            document.getElementById('cardQr').src =
                `https://api.qrserver.com/v1/create-qr-code/?size=104x104&data=${encodeURIComponent(stableId)}&bgcolor=ffffff&color=0F2A4A`;

            popCard();
        }

        // ─── Event Checkbox Logic ────────────────────────────────────
        function onEventChange() {
            const checkboxes = document.querySelectorAll('input[name="kegiatan[]"]');
            let count = 0;
            const selected = [];

            checkboxes.forEach(cb => {
                const item = cb.closest('.event-check-item');
                if (cb.checked) {
                    count++;
                    item.classList.add('selected');
                    const title = item.querySelector('.event-check-title').textContent;
                    selected.push(title);
                } else {
                    item.classList.remove('selected');
                }
            });

            document.getElementById('eventCountBadge').textContent = count;

            // Update preview list
            const sepList = document.getElementById('sepList');
            if (selected.length === 0) {
                sepList.innerHTML = '<div class="sep-empty">Belum ada kegiatan yang dipilih</div>';
            } else {
                sepList.innerHTML = selected.map(t =>
                    `<div class="sep-item"><i class="bi bi-check-circle-fill"></i><span><strong>${t}</strong></span></div>`
                ).join('');
            }
        }

        function selectAllEvents() {
            document.querySelectorAll('input[name="kegiatan[]"]').forEach(cb => cb.checked = true);
            document.querySelectorAll('.event-check-item').forEach(el => el.classList.add('selected'));
            onEventChange();
        }

        function clearAllEvents() {
            document.querySelectorAll('input[name="kegiatan[]"]').forEach(cb => cb.checked = false);
            document.querySelectorAll('.event-check-item').forEach(el => el.classList.remove('selected'));
            onEventChange();
        }

        // ─── Debounce ────────────────────────────────────────────────
        let debounceTimer;

        function debounceUpdate() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(updateCard, 180);
        }

        // ─── Photo Upload ─────────────────────────────────────────────
        function handlePhotoUpload(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    photoDataUrl = e.target.result;
                    const box = input.previousElementSibling;
                    box.innerHTML =
                        `<img src="${photoDataUrl}" style="height:60px;border-radius:8px;margin-bottom:4px;"><p class="mb-0 small text-success"><i class="bi bi-check-circle me-1"></i>Foto siap diupload</p>`;
                    debounceUpdate();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // ─── Reset ───────────────────────────────────────────────────
        function resetForm() {
            document.getElementById('registrationForm').reset();
            photoDataUrl = null;
            clearAllEvents();
            updateCard();
        }

        // ─── Event Listeners ─────────────────────────────────────────
        ['nama_lengkap', 'jabatan', 'instansi_organisasi'].forEach(id => {
            document.getElementById(id).addEventListener('input', debounceUpdate);
        });

        document.getElementById('nomor_telepon').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });

        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal_kedatangan').setAttribute('min', today);
        document.getElementById('tanggal_kedatangan').addEventListener('change', function() {
            document.getElementById('tanggal_kepulangan').setAttribute('min', this.value);
        });

        // Init
        updateCard();
        onEventChange();
    </script>
</body>

</html>
