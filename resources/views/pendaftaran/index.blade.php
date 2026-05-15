<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi JKPI - Rakernas XII JKPI 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --jkpi-teal: #099aa7;
            --jkpi-dark: #077b86;
            --kdh-navy: #0F2A4A;
            --kdh-navy-hover: #143a64;
            --border-color: #d8dde3;
            --label-color: #1a1a1a;
            --muted: #6b7280;
        }

        body {
            background: #f3f4f6;
            min-height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            color: #111;
        }

        .page-wrap {
            padding: 60px 0;
        }

        .registration-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            padding: 36px 40px;
        }

        .registration-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 30px;
            gap: 16px;
        }

        .registration-header h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #111;
            margin-bottom: 4px;
        }

        .registration-header p {
            font-size: 0.95rem;
            color: var(--muted);
            margin: 0;
        }

        .btn-back {
            border: 1.5px solid var(--border-color);
            background: #fff;
            color: #333;
            padding: 8px 22px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-back:hover {
            background: #f9fafb;
            border-color: #c4c9d0;
            color: #111;
        }

        .form-label {
            font-weight: 600;
            color: var(--label-color);
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .required {
            color: #dc3545;
            margin-left: 3px;
        }

        .form-control,
        .form-select {
            border: 1.5px solid var(--border-color);
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: #fff;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--jkpi-teal);
            box-shadow: 0 0 0 0.2rem rgba(9, 154, 167, 0.15);
        }

        .form-control:disabled,
        .form-control[readonly] {
            background: #f9fafb;
            color: #6b7280;
            cursor: not-allowed;
        }

        .field-help {
            font-size: 0.82rem;
            color: var(--muted);
            margin-top: 6px;
            display: block;
        }

        .form-section-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--kdh-navy);
            margin: 28px 0 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-title i {
            color: var(--jkpi-teal);
        }

        /* ===== FOTO UPLOAD ===== */
        .photo-upload-wrap {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .photo-preview {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: #f3f4f6;
            border: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-preview .ph-icon {
            font-size: 2.5rem;
            color: #c4c9d0;
        }

        .custom-file-upload {
            flex: 1;
            min-width: 240px;
            border: 2px dashed var(--jkpi-teal);
            border-radius: 10px;
            padding: 18px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #f0fafb;
        }

        .custom-file-upload:hover {
            background: #e0f4f5;
        }

        .custom-file-upload i {
            font-size: 1.6rem;
            color: var(--jkpi-teal);
            display: block;
            margin-bottom: 4px;
        }

        .custom-file-upload p {
            margin: 0;
            font-weight: 600;
            color: #111;
        }

        /* ===== NARAHUBUNG CARD ===== */
        .narahubung-card {
            background: #f9fafb;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            position: relative;
            transition: border-color 0.2s;
        }

        .narahubung-card:hover {
            border-color: #c4c9d0;
        }

        .narahubung-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .narahubung-card-title {
            font-weight: 700;
            color: var(--kdh-navy);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .narahubung-number-badge {
            background: var(--jkpi-teal);
            color: #fff;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .btn-remove-narahubung {
            background: transparent;
            border: 1.5px solid #dc3545;
            color: #dc3545;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-remove-narahubung:hover:not(:disabled) {
            background: #dc3545;
            color: #fff;
        }

        .btn-remove-narahubung:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .btn-add-narahubung {
            background: transparent;
            border: 2px dashed var(--jkpi-teal);
            color: var(--jkpi-teal);
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            width: 100%;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-add-narahubung:hover {
            background: #f0fafb;
            border-style: solid;
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-submit {
            background: var(--kdh-navy);
            color: #fff;
            padding: 14px 40px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s;
            width: 100%;
        }

        .btn-submit:hover {
            background: var(--kdh-navy-hover);
            color: #fff;
        }

        .btn-submit:active {
            transform: translateY(1px);
        }

        @media (max-width: 576px) {
            .registration-card {
                padding: 24px 20px;
            }

            .registration-header h1 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>
    <div class="page-wrap">
        <div class="container" style="max-width: 1100px;">
            <div class="registration-card">

                <!-- ===== HEADER ===== -->
                <div class="registration-header">
                    <div>
                        <h1>Registrasi JKPI</h1>
                        <p>Isi data sesuai format registrasi resmi.</p>
                    </div>
                    <a href="{{ url('/') }}" class="btn-back">Kembali</a>
                </div>

                {{-- ===== FLASH MESSAGES ===== --}}
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

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 mb-4">
                        <div class="fw-bold mb-1">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>Mohon periksa kembali isian berikut:
                        </div>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- ===== FORM ===== --}}
                <form id="registrationForm" method="POST" action="{{ route('pendaftaran.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Row 1: Timestamp + Nama Daerah --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="timestamp">Timestamp</label>
                            <input type="text" class="form-control" id="timestamp" name="timestamp"
                                value="{{ now()->format('d/m/Y, H.i') }}" readonly>
                            <small class="field-help">Otomatis diisi sistem saat submit dan tidak bisa diubah.</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_daerah">
                                Nama Daerah <span class="required">*</span>
                            </label>
                            <select class="form-select" id="nama_daerah" name="nama_daerah" required>
                                <option value="">Pilih Daerah</option>
                                <optgroup label="Anggota JKPI">
                                    @php
                                        $daerahList = [
                                            // 1–25
                                            'Kota Ambon',
                                            'Kota Banda Aceh',
                                            'Kota Bengkulu',
                                            'Kota Bukittinggi',
                                            'Kota Baubau',
                                            'Kota Blitar',
                                            'Kota Banjarmasin',
                                            'Kota Bontang',
                                            'Kota Bogor',
                                            'Kab. Bangka Barat',
                                            'Kab. Bangli',
                                            'Kab. Buleleng',
                                            'Kab. Brebes',
                                            'Kab. Banjar Negara',
                                            'Kab. Banyumas',
                                            'Kab. Batang',
                                            'Kota Cirebon',
                                            'Kab. Cilacap',
                                            'Kota Jakarta Pusat',
                                            'Kota Lubuk Linggau',
                                            'Kota Langsa',
                                            'Kab. Kepulauan Seribu',
                                            'Kab. Karang Asem',
                                            'Kota Medan',
                                            'Kota Madiun',
                                            // 26–50
                                            'Kota Malang',
                                            'Kota Palembang',
                                            'Kota Pangkal Pinang',
                                            'Kota Pekalongan',
                                            'Kota Padang',
                                            'Kota Palopo',
                                            'Kota Pontianak',
                                            'Kab. Purbalingga',
                                            'Kota Sawahlunto',
                                            'Kota Semarang',
                                            'Kota Surakarta',
                                            'Kota Ternate',
                                            'Kota Tegal',
                                            'Kab. Tegal',
                                            'Kota Yogyakarta',
                                            'Kota Sungai Penuh',
                                            'Kab. Ngawi',
                                            'Kota Tidore',
                                            'Kota Tangerang',
                                            'Kota Kupang',
                                            'Kab. Temanggung',
                                            'Kota Sabang',
                                            'Kab. Halmahera Barat',
                                            'Kab. Siak',
                                            'Kab. Pesawaran',
                                            // 51–75
                                            'Kota Probolinggo',
                                            'Kab. Buton Utara',
                                            'Kab. Kutai Kartanegara',
                                            'Kab. Muna',
                                            'Kota Denpasar',
                                            'Kota Sibolga',
                                            'Kab. Sambas',
                                            'Kab. Gianyar',
                                            'Kota Jakarta Barat',
                                            'Kota Jakarta Utara',
                                            'Kota Salatiga',
                                            'Kota Surabaya',
                                            'Kota Singkawang',
                                            'Kab. Sumbawa',
                                            'Kab. Belitung Timur',
                                            'Kota Pasuruan',
                                            'Kab. Sumba Timur',
                                            'Kab. Flores Timur',
                                            'Kab. Sumenep',
                                            'Kab. Nias Selatan',
                                            'Kab. Jepara',
                                            'Kab. Buton Selatan',
                                            'Kab. Ende',
                                            'Kota Kediri',
                                            'Kota Bandung',
                                        ];
                                        sort($daerahList);
                                    @endphp
                                    @foreach ($daerahList as $daerah)
                                        <option value="{{ $daerah }}"
                                            {{ old('nama_daerah', 'Kota Ternate') == $daerah ? 'selected' : '' }}>
                                            {{ $daerah }}
                                        </option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Peninjau">
                                    @php
                                        $peninjauList = [
                                            'Kab. Tranggalek',
                                            'Kota Magelang',
                                            'Kab. Lombok Utara',
                                            'Kab. Sleman',
                                            'Kab. Bojonegoro',
                                        ];
                                        sort($peninjauList);
                                    @endphp
                                    @foreach ($peninjauList as $daerah)
                                        <option value="{{ $daerah }}"
                                            {{ old('nama_daerah') == $daerah ? 'selected' : '' }}>
                                            {{ $daerah }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    {{-- Row 2: Nama Kepala Daerah + Pasangan --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_kepala_daerah">
                                Nama Lengkap Kepala Daerah <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama_kepala_daerah" name="nama_kepala_daerah"
                                value="{{ old('nama_kepala_daerah') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_pasangan_kepala_daerah">
                                Nama Lengkap Pasangan Kepala Daerah
                            </label>
                            <input type="text" class="form-control" id="nama_pasangan_kepala_daerah"
                                name="nama_pasangan_kepala_daerah" value="{{ old('nama_pasangan_kepala_daerah') }}">
                        </div>
                    </div>



                    {{-- ===== PERJALANAN ===== --}}
                    <h3 class="form-section-title">
                        <i class="bi bi-airplane-fill"></i>Informasi Perjalanan
                    </h3>

                    {{-- Row 3: Nomor Plat + Info Kedatangan --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nomor_plat">
                                Nomor Plat Kendaraan Kepala Daerah
                            </label>
                            <input type="text" class="form-control" id="nomor_plat" name="nomor_plat"
                                value="{{ old('nomor_plat') }}" placeholder="Contoh: B 1 ABC">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="info_kedatangan">
                                Info Kedatangan Kepala Daerah <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control" id="info_kedatangan" name="info_kedatangan"
                                value="{{ old('info_kedatangan') }}"
                                placeholder="Contoh: 26 Agustus 2026, GA-602, 10:30 WIT" required>
                        </div>
                    </div>

                    {{-- Row 4: Info Kepulangan --}}
                    <div class="mb-3">
                        <label class="form-label" for="info_kepulangan">
                            Info Kepulangan Kepala Daerah <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control" id="info_kepulangan" name="info_kepulangan"
                            value="{{ old('info_kepulangan') }}"
                            placeholder="Contoh: 30 Agustus 2026, GA-603, 14:15 WIT" required>
                    </div>

                    {{-- ===== AJUDAN ===== --}}
                    <h3 class="form-section-title">
                        <i class="bi bi-person-badge-fill"></i>Data Ajudan/ADC
                    </h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_ajudan">Nama Ajudan/ADC</label>
                            <input type="text" class="form-control" id="nama_ajudan" name="nama_ajudan"
                                value="{{ old('nama_ajudan') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="telepon_ajudan">Nomor Telepon Ajudan/ADC</label>
                            <input type="text" class="form-control" id="telepon_ajudan" name="telepon_ajudan"
                                value="{{ old('telepon_ajudan') }}" placeholder="08xxxxxxxxxx">
                        </div>
                    </div>

                    {{-- ===== NARAHUBUNG (DINAMIS - BISA LEBIH DARI SATU) ===== --}}
                    <h3 class="form-section-title">
                        <i class="bi bi-people-fill"></i>Data Narahubung
                        <small class="text-muted ms-2" style="font-size:0.78rem;font-weight:500;">
                            (Bisa lebih dari satu)
                        </small>
                    </h3>

                    <div id="narahubungContainer">
                        @php
                            $oldNarahubung = old('narahubung', [[]]);
                        @endphp

                        @foreach ($oldNarahubung as $index => $nh)
                            <div class="narahubung-card" data-index="{{ $index }}">
                                <div class="narahubung-card-header">
                                    <div class="narahubung-card-title">
                                        <span class="narahubung-number-badge nh-number">{{ $index + 1 }}</span>
                                        Narahubung
                                    </div>
                                    <button type="button" class="btn-remove-narahubung"
                                        onclick="removeNarahubung(this)"
                                        {{ count($oldNarahubung) <= 1 ? 'disabled' : '' }}>
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Nama Narahubung <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                        name="narahubung[{{ $index }}][nama]" value="{{ $nh['nama'] ?? '' }}"
                                        required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Nomor Telepon Narahubung <span class="required">*</span>
                                        </label>
                                        <input type="text" class="form-control nh-telepon"
                                            name="narahubung[{{ $index }}][telepon]"
                                            value="{{ $nh['telepon'] ?? '' }}" placeholder="08xxxxxxxxxx" required>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <label class="form-label">
                                            Email Narahubung <span class="required">*</span>
                                        </label>
                                        <input type="email" class="form-control"
                                            name="narahubung[{{ $index }}][email]"
                                            value="{{ $nh['email'] ?? '' }}" placeholder="email@domain.com" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn-add-narahubung mb-4" onclick="addNarahubung()">
                        <i class="bi bi-plus-circle-fill"></i> Tambah Narahubung
                    </button>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-submit">
                        Simpan Data
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== TEMPLATE NARAHUBUNG (untuk JS) ===== --}}
    <template id="narahubungTemplate">
        <div class="narahubung-card" data-index="__INDEX__">
            <div class="narahubung-card-header">
                <div class="narahubung-card-title">
                    <span class="narahubung-number-badge nh-number">__NUMBER__</span>
                    Narahubung
                </div>
                <button type="button" class="btn-remove-narahubung" onclick="removeNarahubung(this)">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Narahubung <span class="required">*</span></label>
                <input type="text" class="form-control" name="narahubung[__INDEX__][nama]" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor Telepon Narahubung <span class="required">*</span></label>
                    <input type="text" class="form-control nh-telepon" name="narahubung[__INDEX__][telepon]"
                        placeholder="08xxxxxxxxxx" required>
                </div>
                <div class="col-md-6 mb-0">
                    <label class="form-label">Email Narahubung <span class="required">*</span></label>
                    <input type="email" class="form-control" name="narahubung[__INDEX__][email]"
                        placeholder="email@domain.com" required>
                </div>
            </div>
        </div>
    </template>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ===== TIMESTAMP =====
        function updateTimestamp() {
            const el = document.getElementById('timestamp');
            if (!el) return;
            const d = new Date();
            const pad = n => String(n).padStart(2, '0');
            el.value =
                `${pad(d.getDate())}/${pad(d.getMonth()+1)}/${d.getFullYear()}, ${pad(d.getHours())}.${pad(d.getMinutes())}`;
        }
        updateTimestamp();
        setInterval(updateTimestamp, 30000);

        // ===== FOTO UPLOAD =====
        function handlePhotoUpload(input) {
            const file = input.files[0];
            const errorEl = document.getElementById('fotoError');
            const preview = document.getElementById('photoPreview');

            errorEl.classList.add('d-none');
            errorEl.textContent = '';

            if (!file) return;

            const maxSize = 2 * 1024 * 1024;
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if (file.size > maxSize) {
                errorEl.textContent = 'Ukuran gambar lebih dari 2MB!';
                errorEl.classList.remove('d-none');
                input.value = '';
                return;
            }
            if (!allowedTypes.includes(file.type)) {
                errorEl.textContent = 'Format harus JPG atau PNG!';
                errorEl.classList.remove('d-none');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Foto Profil">`;
            };
            reader.readAsDataURL(file);
        }

        // ===== NARAHUBUNG DYNAMIC =====
        function getNarahubungCount() {
            return document.querySelectorAll('#narahubungContainer .narahubung-card').length;
        }

        function renumberNarahubung() {
            const cards = document.querySelectorAll('#narahubungContainer .narahubung-card');
            cards.forEach((card, idx) => {
                card.setAttribute('data-index', idx);
                card.querySelector('.nh-number').textContent = idx + 1;

                card.querySelectorAll('[name^="narahubung["]').forEach(input => {
                    const name = input.getAttribute('name');
                    const newName = name.replace(/narahubung\[\d+\]/, `narahubung[${idx}]`);
                    input.setAttribute('name', newName);
                });
            });

            document.querySelectorAll('.btn-remove-narahubung').forEach(btn => {
                btn.disabled = cards.length <= 1;
            });
        }

        function addNarahubung() {
            const container = document.getElementById('narahubungContainer');
            const template = document.getElementById('narahubungTemplate');
            const newIndex = getNarahubungCount();

            const html = template.innerHTML
                .replace(/__INDEX__/g, newIndex)
                .replace(/__NUMBER__/g, newIndex + 1);

            const wrapper = document.createElement('div');
            wrapper.innerHTML = html.trim();
            const newCard = wrapper.firstChild;

            container.appendChild(newCard);
            renumberNarahubung();
            attachPhoneFilter(newCard);

            newCard.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function removeNarahubung(btn) {
            const cards = document.querySelectorAll('#narahubungContainer .narahubung-card');
            if (cards.length <= 1) return;

            const card = btn.closest('.narahubung-card');
            if (confirm('Hapus narahubung ini?')) {
                card.remove();
                renumberNarahubung();
            }
        }

        // ===== PHONE NUMBER FILTER =====
        function attachPhoneFilter(scope = document) {
            const phoneInputs = scope.querySelectorAll('#telepon_ajudan, .nh-telepon');
            phoneInputs.forEach(el => {
                if (el.dataset.phoneFilter) return;
                el.dataset.phoneFilter = '1';
                el.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9+]/g, '');
                });
            });
        }
        attachPhoneFilter();

        renumberNarahubung();
    </script>
</body>

</html>
