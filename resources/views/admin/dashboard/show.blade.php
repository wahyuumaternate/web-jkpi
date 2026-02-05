<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta - JKPI 2026</title>
    <!-- Bootstrap 5 CSS (minimal usage) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #0f172a;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            opacity: 0.05;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 50%);
            animation: rotate 20s linear infinite;
            z-index: 0;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .main-container {
            position: relative;
            z-index: 1;
        }

        /* Navbar */
        .navbar-ultra {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
        }

        .navbar-brand-custom {
            font-weight: 700;
            font-size: 1.25rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        /* Breadcrumb */
        .breadcrumb-ultra {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
        }

        .breadcrumb-ultra .breadcrumb {
            margin: 0;
        }

        .breadcrumb-ultra .breadcrumb-item {
            color: rgba(255, 255, 255, 0.6);
        }

        .breadcrumb-ultra .breadcrumb-item.active {
            color: white;
        }

        .breadcrumb-ultra .breadcrumb-item a {
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .breadcrumb-ultra .breadcrumb-item a:hover {
            color: #764ba2;
        }

        /* Card Ultra */
        .card-ultra {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .card-ultra:hover {
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .card-header-ultra {
            background: rgba(15, 23, 42, 0.5);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            position: relative;
        }

        .card-header-ultra::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
        }

        .card-ultra.blue {
            --gradient-start: #667eea;
            --gradient-end: #764ba2;
        }

        .card-ultra.green {
            --gradient-start: #10b981;
            --gradient-end: #059669;
        }

        .card-ultra.yellow {
            --gradient-start: #f59e0b;
            --gradient-end: #d97706;
        }

        .card-ultra.red {
            --gradient-start: #ef4444;
            --gradient-end: #dc2626;
        }

        .card-ultra.purple {
            --gradient-start: #8b5cf6;
            --gradient-end: #7c3aed;
        }

        .card-title-ultra {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-title-ultra i {
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Info Item */
        .info-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .info-item {
            padding: 1rem;
            background: rgba(15, 23, 42, 0.3);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: rgba(15, 23, 42, 0.5);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .info-label {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-size: 1rem;
            color: white;
            font-weight: 600;
        }

        /* Badge Ultra */
        .badge-ultra {
            padding: 0.6rem 1.25rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .badge-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .badge-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .badge-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .badge-gray {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
        }

        /* Image Preview */
        .image-preview {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .image-preview:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .image-preview img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Button Ultra */
        .btn-ultra {
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-block;
        }

        .btn-ultra::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-ultra:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-ultra span {
            position: relative;
            z-index: 1;
        }

        .btn-ultra:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .btn-blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-gray {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
        }

        /* Input & Select */
        .input-dark {
            background: rgba(15, 23, 42, 0.5);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 0.875rem 1.25rem;
            color: white;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .input-dark:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.2);
            background: rgba(15, 23, 42, 0.7);
        }

        .label-dark {
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        /* Code */
        code {
            background: rgba(102, 126, 234, 0.2);
            color: #a5b4fc;
            padding: 0.35rem 0.7rem;
            border-radius: 8px;
            font-family: 'Monaco', 'Courier New', monospace;
            font-size: 0.875rem;
        }

        /* Alert */
        .alert-ultra {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 15px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
        }

        .alert-ultra::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        /* Empty State */
        .empty-state {
            padding: 3rem 2rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.4);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar-ultra">
        <div class="container-fluid px-4">
            <a class="navbar-brand-custom" href="{{ route('admin.dashboard') }}">
                <div class="brand-icon">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                </div>
                <span>Dashboard JKPI 2026</span>
            </a>
        </div>
    </nav>

    <div class="main-container">
        <div class="container-fluid px-4 py-4">

            <!-- Breadcrumb -->
            <div class="breadcrumb-ultra">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house-fill me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Detail Peserta</li>
                    </ol>
                </nav>
            </div>

            <!-- Alert -->
            @if (session('success'))
                <div class="alert-ultra">
                    <i class="bi bi-check-circle-fill me-2" style="color: #10b981;"></i>
                    <span style="color: white; font-weight: 600;">{{ session('success') }}</span>
                </div>
            @endif

            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Data Pribadi -->
                    <div class="card-ultra blue">
                        <div class="card-header-ultra">
                            <h3 class="card-title-ultra">
                                <i class="bi bi-person-fill"></i>
                                Data Pribadi
                            </h3>
                        </div>
                        <div class="info-row">
                            <div class="info-item">
                                <div class="info-label">Kode Registrasi</div>
                                <div class="info-value"><code>{{ $peserta->kode_registrasi }}</code></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Status</div>
                                <div class="info-value">
                                    @if ($peserta->status === 'verified')
                                        <span class="badge-ultra badge-success">
                                            <i class="bi bi-check-circle-fill"></i>Verified
                                        </span>
                                    @elseif($peserta->status === 'unverified')
                                        <span class="badge-ultra badge-warning">
                                            <i class="bi bi-clock-fill"></i>Unverified
                                        </span>
                                    @else
                                        <span class="badge-ultra badge-danger">
                                            <i class="bi bi-x-circle-fill"></i>Cancelled
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Nama Lengkap</div>
                                <div class="info-value">{{ $peserta->nama_lengkap }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Jabatan</div>
                                <div class="info-value">{{ $peserta->jabatan }}</div>
                            </div>
                            <div class="info-item" style="grid-column: 1 / -1;">
                                <div class="info-label">Instansi/Organisasi</div>
                                <div class="info-value">{{ $peserta->instansi_organisasi }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Kota/Kabupaten</div>
                                <div class="info-value">{{ $peserta->kota_kabupaten }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak -->
                    <div class="card-ultra green">
                        <div class="card-header-ultra">
                            <h3 class="card-title-ultra">
                                <i class="bi bi-telephone-fill"></i>
                                Informasi Kontak
                            </h3>
                        </div>
                        <div class="info-row">
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value">
                                    {{ $peserta->email }}
                                    @if ($peserta->email_verified_at)
                                        <br><span class="badge-ultra badge-success mt-2">
                                            <i class="bi bi-patch-check-fill"></i>Verified
                                        </span>
                                    @else
                                        <br><span class="badge-ultra badge-warning mt-2">
                                            <i class="bi bi-exclamation-triangle-fill"></i>Belum Verified
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">No. Telepon</div>
                                <div class="info-value"><code>{{ $peserta->nomor_telepon }}</code></div>
                            </div>
                        </div>
                    </div>

                    <!-- Perjalanan & Akomodasi -->
                    <div class="card-ultra yellow">
                        <div class="card-header-ultra">
                            <h3 class="card-title-ultra">
                                <i class="bi bi-airplane-fill"></i>
                                Perjalanan & Akomodasi
                            </h3>
                        </div>
                        <div class="info-row">
                            <div class="info-item">
                                <div class="info-label">Tanggal Kedatangan</div>
                                <div class="info-value">
                                    {{ $peserta->tanggal_kedatangan ? $peserta->tanggal_kedatangan->format('d M Y') : '-' }}
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Tanggal Kepulangan</div>
                                <div class="info-value">
                                    {{ $peserta->tanggal_kepulangan ? $peserta->tanggal_kepulangan->format('d M Y') : '-' }}
                                </div>
                            </div>
                            @if ($peserta->akomodasi_hotel)
                                <div class="info-item" style="grid-column: 1 / -1;">
                                    <div class="info-label">Akomodasi Hotel / Detail</div>
                                    <div class="info-value">{{ $peserta->akomodasi_hotel }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Dokumen -->
                    <div class="card-ultra red">
                        <div class="card-header-ultra">
                            <h3 class="card-title-ultra">
                                <i class="bi bi-file-earmark-image"></i>
                                Dokumen
                            </h3>
                        </div>
                        <div class="p-4">
                            @if ($peserta->foto)
                                <div>
                                    <div class="label-dark mb-2">Foto Peserta</div>
                                    <div class="image-preview">
                                        <img src="{{ Storage::url($peserta->foto) }}" alt="Foto">
                                    </div>
                                </div>
                            @else
                                <div class="empty-state">
                                    <i class="bi bi-file-earmark-x"></i>
                                    <p class="mb-0">Tidak ada dokumen</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Info Tambahan -->
                    <div class="card-ultra purple">
                        <div class="card-header-ultra">
                            <h3 class="card-title-ultra">
                                <i class="bi bi-info-circle-fill"></i>
                                Info Tambahan
                            </h3>
                        </div>
                        <div class="p-4">
                            <div class="info-item mb-3">
                                <div class="info-label">Tanggal Daftar</div>
                                <div class="info-value">{{ $peserta->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Terakhir Update</div>
                                <div class="info-value">{{ $peserta->updated_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Update Status -->
                    <div class="card-ultra blue">
                        <div class="card-header-ultra">
                            <h3 class="card-title-ultra">
                                <i class="bi bi-gear-fill"></i>
                                Update Status
                            </h3>
                        </div>
                        <div class="p-4">
                            <form action="{{ route('admin.dashboard.update-status', $peserta->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label class="label-dark">Status</label>
                                    <select name="status" class="input-dark" required>
                                        <option value="verified"
                                            {{ $peserta->status == 'verified' ? 'selected' : '' }}>Verified</option>
                                        <option value="unverified"
                                            {{ $peserta->status == 'unverified' ? 'selected' : '' }}>Unverified
                                        </option>
                                        <option value="cancelled"
                                            {{ $peserta->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="label-dark">Catatan</label>
                                    <textarea name="catatan" rows="3" class="input-dark" placeholder="Catatan...">{{ $peserta->catatan }}</textarea>
                                </div>
                                <button type="submit" class="btn-ultra btn-blue w-100">
                                    <span><i class="bi bi-check-circle me-2"></i>Update Status</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <a href="{{ route('admin.dashboard') }}" class="btn-ultra btn-gray w-100">
                        <span><i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
