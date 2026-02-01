<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - JKPI 2026</title>
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

        /* Animated Background */
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

        /* Navbar Ultra Modern */
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

        /* Stats Cards - Ultra Modern */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card-ultra {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 1.75rem;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card-ultra::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--color-start), var(--color-end));
        }

        .stat-card-ultra::after {
            content: '';
            position: absolute;
            top: -100%;
            left: -100%;
            width: 300%;
            height: 300%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            transition: all 0.6s ease;
        }

        .stat-card-ultra:hover {
            transform: translateY(-8px);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .stat-card-ultra:hover::after {
            top: -50%;
            left: -50%;
        }

        .stat-card-ultra.blue {
            --color-start: #667eea;
            --color-end: #764ba2;
        }

        .stat-card-ultra.green {
            --color-start: #10b981;
            --color-end: #059669;
        }

        .stat-card-ultra.yellow {
            --color-start: #f59e0b;
            --color-end: #d97706;
        }

        .stat-card-ultra.red {
            --color-start: #ef4444;
            --color-end: #dc2626;
        }

        .stat-card-ultra.cyan {
            --color-start: #06b6d4;
            --color-end: #0891b2;
        }

        .stat-card-ultra.purple {
            --color-start: #8b5cf6;
            --color-end: #7c3aed;
        }

        .stat-icon-ultra {
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, var(--color-start), var(--color-end));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .stat-value-ultra {
            font-size: 2.25rem;
            font-weight: 700;
            color: white;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label-ultra {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }

        /* Card Modern Dark */
        .card-dark {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-header-dark {
            background: rgba(15, 23, 42, 0.5);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
        }

        .card-title-dark {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-title-dark i {
            font-size: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Buttons Ultra Modern */
        .btn-ultra {
            padding: 0.75rem 1.75rem;
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

        .btn-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .btn-yellow {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .btn-red {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }

        .btn-cyan {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
        }

        .btn-gray {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
        }

        /* Input Modern Dark */
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

        .input-dark::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .input-dark:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.2);
            background: rgba(15, 23, 42, 0.7);
        }

        /* Table Ultra Modern */
        .table-ultra {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-ultra thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .table-ultra thead th {
            padding: 1.25rem 1rem;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        .table-ultra thead th:first-child {
            border-top-left-radius: 12px;
        }

        .table-ultra thead th:last-child {
            border-top-right-radius: 12px;
        }

        .table-ultra tbody tr {
            background: rgba(30, 41, 59, 0.4);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .table-ultra tbody tr:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: scale(1.005);
        }

        .table-ultra tbody td {
            padding: 1.25rem 1rem;
            color: rgba(255, 255, 255, 0.9);
            vertical-align: middle;
        }

        /* Badge Modern */
        .badge-ultra {
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.3px;
            display: inline-block;
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

        /* Alert Modern */
        .alert-ultra {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid;
            border-radius: 15px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .alert-success-ultra {
            border-color: rgba(16, 185, 129, 0.3);
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
        }

        .alert-success-ultra::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        /* Label */
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

        /* Empty State */
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.4);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        /* Pagination */
        .pagination-ultra {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            align-items: center;
        }

        .pagination-ultra .page-link {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
            padding: 0.5rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination-ultra .page-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
        }

        .pagination-ultra .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .stat-value-ultra {
                font-size: 1.75rem;
            }

            .stat-icon-ultra {
                width: 45px;
                height: 45px;
                font-size: 1.25rem;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar-ultra">
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand-custom" href="{{ route('admin.dashboard') }}">
                    <div class="brand-icon">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                    </div>
                    <span>Dashboard JKPI 2026</span>
                </a>
                <div class="dropdown">
                    <button class="btn-ultra btn-gray dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <span><i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end"
                        style="background: rgba(30, 41, 59, 0.95); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px;">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}" style="color: white;"><i
                                    class="bi bi-person me-2"></i>Profile</a></li>
                        <li>
                            <hr class="dropdown-divider" style="border-color: rgba(255, 255, 255, 0.1);">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item" style="color: #ef4444;"><i
                                        class="bi bi-box-arrow-right me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <div class="container-fluid px-4 py-4">

            <!-- Alert -->
            @if (session('success'))
                <div class="alert-ultra alert-success-ultra">
                    <i class="bi bi-check-circle-fill me-2" style="color: #10b981;"></i>
                    <span style="color: white; font-weight: 600;">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card-ultra blue">
                    <div class="stat-icon-ultra">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-value-ultra">{{ $stats['total'] }}</div>
                    <div class="stat-label-ultra">Total Peserta</div>
                </div>

                <div class="stat-card-ultra green">
                    <div class="stat-icon-ultra">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="stat-value-ultra">{{ $stats['verified'] }}</div>
                    <div class="stat-label-ultra">Verified</div>
                </div>

                <div class="stat-card-ultra yellow">
                    <div class="stat-icon-ultra">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div class="stat-value-ultra">{{ $stats['unverified'] }}</div>
                    <div class="stat-label-ultra">Unverified</div>
                </div>

                <div class="stat-card-ultra red">
                    <div class="stat-icon-ultra">
                        <i class="bi bi-x-circle-fill"></i>
                    </div>
                    <div class="stat-value-ultra">{{ $stats['cancelled'] }}</div>
                    <div class="stat-label-ultra">Cancelled</div>
                </div>

                <div class="stat-card-ultra cyan">
                    <div class="stat-icon-ultra">
                        <i class="bi bi-envelope-check-fill"></i>
                    </div>
                    <div class="stat-value-ultra">{{ $stats['email_verified'] }}</div>
                    <div class="stat-label-ultra">Email OK</div>
                </div>

                <div class="stat-card-ultra purple">
                    <div class="stat-icon-ultra">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                    <div class="stat-value-ultra">{{ $stats['anggota_jkpi'] }}</div>
                    <div class="stat-label-ultra">Anggota JKPI</div>
                </div>
            </div>

            <!-- Export Section -->
            <div class="card-dark">
                <div class="card-header-dark">
                    <h3 class="card-title-dark">
                        <i class="bi bi-download"></i>
                        Export Data Excel
                    </h3>
                </div>
                <div class="p-4">
                    <label class="label-dark">Export by Status</label>
                    <div class="row g-2 mb-4">
                        @if ($stats['total'] != 0)
                            <div class="col-6 col-md-3">
                                <a href="{{ url('/admin/dashboard/export/all') }}" class="btn-ultra btn-blue w-100">
                                    <span><i class="bi bi-download me-2"></i>Semua ({{ $stats['total'] }})</span>
                                </a>
                            </div>
                        @endif
                        @if ($stats['verified'] != 0)
                            <div class="col-6 col-md-3">
                                <a href="{{ url('/admin/dashboard/export/verified') }}"
                                    class="btn-ultra btn-green w-100">
                                    <span><i class="bi bi-check-circle me-2"></i>Verified
                                        ({{ $stats['verified'] }})</span>
                                </a>
                            </div>
                        @endif
                        @if ($stats['unverified'] != 0)
                            <div class="col-6 col-md-3">
                                <a href="{{ url('/admin/dashboard/export/unverified') }}"
                                    class="btn-ultra btn-yellow w-100">
                                    <span><i class="bi bi-clock me-2"></i>Unverified
                                        ({{ $stats['unverified'] }})</span>
                                </a>
                            </div>
                        @endif
                        @if ($stats['cancelled'] != 0)
                            <div class="col-6 col-md-3">
                                <a href="{{ url('/admin/dashboard/export/cancelled') }}"
                                    class="btn-ultra btn-red w-100">
                                    <span><i class="bi bi-x-circle me-2"></i>Cancelled
                                        ({{ $stats['cancelled'] }})</span>
                                </a>
                            </div>
                        @endif
                    </div>

                    <label class="label-dark">Export Lainnya</label>
                    <div class="row g-2">
                        <div class="col-6 col-md-3">
                            <a href="{{ url('/admin/dashboard/export/statistik') }}"
                                class="btn-ultra btn-purple w-100">
                                <span><i class="bi bi-bar-chart-fill me-2"></i>Statistik</span>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ url('/admin/dashboard/export/by-provinsi') }}"
                                class="btn-ultra btn-cyan w-100">
                                <span><i class="bi bi-map-fill me-2"></i>By Provinsi</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter -->
            <div class="card-dark">
                <div class="card-header-dark">
                    <h3 class="card-title-dark">
                        <i class="bi bi-funnel"></i>
                        Filter & Pencarian
                    </h3>
                </div>
                <div class="p-4">
                    <form method="GET" action="{{ route('admin.dashboard') }}">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="label-dark">
                                    <i class="bi bi-search me-1"></i>Cari Peserta
                                </label>
                                <input type="text" class="input-dark" name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Nama, Email, NIK, atau Kode Registrasi">
                            </div>
                            <div class="col-md-4">
                                <label class="label-dark">
                                    <i class="bi bi-filter me-1"></i>Status
                                </label>
                                <select class="input-dark" name="status">
                                    <option value="">Semua Status</option>
                                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>
                                        Verified</option>
                                    <option value="unverified"
                                        {{ request('status') == 'unverified' ? 'selected' : '' }}>Unverified</option>
                                    <option value="cancelled"
                                        {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3 d-flex gap-2">
                            <button type="submit" class="btn-ultra btn-blue">
                                <span><i class="bi bi-search me-2"></i>Cari</span>
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn-ultra btn-gray">
                                <span><i class="bi bi-arrow-clockwise me-2"></i>Reset</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="card-dark">
                <div class="card-header-dark">
                    <h3 class="card-title-dark">
                        <i class="bi bi-table"></i>
                        Data Peserta
                    </h3>
                </div>
                <div class="table-responsive">
                    <table class="table-ultra">
                        <thead>
                            <tr>
                                <th style="width: 60px; text-align: center;">No</th>
                                <th style="width: 130px;">Kode</th>
                                <th>Nama / Email</th>
                                <th style="width: 130px;">No. WA</th>
                                <th style="width: 160px;">Asal</th>
                                <th style="width: 120px; text-align: center;">Status</th>
                                <th style="width: 100px; text-align: center;">Tanggal</th>
                                <th style="width: 140px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peserta as $index => $p)
                                <tr>
                                    <td style="text-align: center; font-weight: 700;">
                                        {{ $peserta->firstItem() + $index }}</td>
                                    <td><code>{{ $p->kode_registrasi }}</code></td>
                                    <td>
                                        <div style="font-weight: 600;">{{ $p->nama_lengkap }}</div>
                                        <small style="color: rgba(255, 255, 255, 0.5);">{{ $p->email }}</small>
                                        @if ($p->email_verified_at)
                                            <br><span class="badge-ultra badge-success mt-1">
                                                <i class="bi bi-check"></i> Verified
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $p->nomor_wa }}</td>
                                    <td>
                                        <div style="font-weight: 600;">{{ $p->kabupaten_kota }}</div>
                                        <small style="color: rgba(255, 255, 255, 0.5);">{{ $p->provinsi }}</small>
                                    </td>
                                    <td style="text-align: center;">
                                        @if ($p->status === 'verified')
                                            <span class="badge-ultra badge-success">Verified</span>
                                        @elseif($p->status === 'unverified')
                                            <span class="badge-ultra badge-warning">Unverified</span>
                                        @else
                                            <span class="badge-ultra badge-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <small
                                            style="color: rgba(255, 255, 255, 0.6);">{{ $p->created_at->format('d/m/Y') }}</small>
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('admin.dashboard.show', $p->id) }}"
                                                class="btn-ultra btn-blue"
                                                style="padding: 0.5rem 1rem; font-size: 0.8rem;">
                                                <span><i class="bi bi-eye"></i></span>
                                            </a>
                                            <button onclick="confirmDelete({{ $p->id }})"
                                                class="btn-ultra btn-red"
                                                style="padding: 0.5rem 1rem; font-size: 0.8rem;">
                                                <span><i class="bi bi-trash"></i></span>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $p->id }}"
                                            action="{{ route('admin.dashboard.destroy', $p->id) }}" method="POST"
                                            class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <p>Tidak ada data peserta</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($peserta->hasPages())
                    <div class="p-4" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <small style="color: rgba(255, 255, 255, 0.6);">
                                Menampilkan {{ $peserta->firstItem() }} - {{ $peserta->lastItem() }} dari
                                {{ $peserta->total() }}
                            </small>
                            <div class="pagination-ultra">
                                {{ $peserta->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('Yakin ingin menghapus data peserta ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
</body>

</html>
