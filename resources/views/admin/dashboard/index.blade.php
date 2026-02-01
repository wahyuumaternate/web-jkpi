<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - JKPI 2026</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-speedometer2"></i> Dashboard Admin JKPI 2026
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4">

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-white-50 text-uppercase">Total</h6>
                                <h3 class="card-title mb-0 fw-bold">{{ $stats['total'] }}</h3>
                            </div>
                            <i class="bi bi-people-fill fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-white bg-success h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-white-50 text-uppercase">Verified</h6>
                                <h3 class="card-title mb-0 fw-bold">{{ $stats['verified'] }}</h3>
                            </div>
                            <i class="bi bi-check-circle-fill fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-white-50 text-uppercase">Unverified</h6>
                                <h3 class="card-title mb-0 fw-bold">{{ $stats['unverified'] }}</h3>
                            </div>
                            <i class="bi bi-clock-fill fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-white bg-danger h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-white-50 text-uppercase">Cancelled</h6>
                                <h3 class="card-title mb-0 fw-bold">{{ $stats['cancelled'] }}</h3>
                            </div>
                            <i class="bi bi-x-circle-fill fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-white bg-info h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-white-50 text-uppercase">Email OK</h6>
                                <h3 class="card-title mb-0 fw-bold">{{ $stats['email_verified'] }}</h3>
                            </div>
                            <i class="bi bi-envelope-check-fill fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 text-white-50 text-uppercase">Anggota</h6>
                                <h3 class="card-title mb-0 fw-bold">{{ $stats['anggota_jkpi'] }}</h3>
                            </div>
                            <i class="bi bi-person-badge-fill fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Export Section -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-download me-2"></i>Export Data Excel
                </h5>
            </div>
            <div class="card-body">
                <h6 class="fw-bold mb-3">Export by Status</h6>
                <div class="row g-2 mb-3">
                    <div class="col-6 col-md-3">
                        <a href="{{ url('/admin/dashboard/export/all') }}" class="btn btn-dark w-100">
                            <i class="bi bi-download me-1"></i>
                            <span class="d-none d-md-inline">Semua</span> ({{ $stats['total'] }})
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ url('/admin/dashboard/export/verified') }}" class="btn btn-success w-100">
                            <i class="bi bi-check-circle me-1"></i>
                            <span class="d-none d-md-inline">Verified</span> ({{ $stats['verified'] }})
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ url('/admin/dashboard/export/unverified') }}" class="btn btn-warning w-100">
                            <i class="bi bi-clock me-1"></i>
                            <span class="d-none d-md-inline">Unverified</span> ({{ $stats['unverified'] }})
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ url('/admin/dashboard/export/cancelled') }}" class="btn btn-danger w-100">
                            <i class="bi bi-x-circle me-1"></i>
                            <span class="d-none d-md-inline">Cancelled</span> ({{ $stats['cancelled'] }})
                        </a>
                    </div>
                </div>

                <hr>
                <h6 class="fw-bold mb-3">Export Lainnya</h6>
                <div class="row g-2">
                    <div class="col-6 col-md-3">
                        <a href="{{ url('/admin/dashboard/export/statistik') }}"
                            class="btn btn-outline-primary w-100">
                            <i class="bi bi-bar-chart-fill me-1"></i>Statistik
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ url('/admin/dashboard/export/by-provinsi') }}"
                            class="btn btn-outline-secondary w-100">
                            <i class="bi bi-map-fill me-1"></i>By Provinsi
                        </a>
                    </div>
                </div>
                <small class="text-muted d-block mt-2">
                    <i class="bi bi-info-circle me-1"></i>
                    Statistik: Ringkasan | By Provinsi: Multi-sheet per daerah
                </small>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-funnel me-2"></i>Filter & Pencarian
                </h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.dashboard') }}">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="search" class="form-label">
                                <i class="bi bi-search me-1"></i>Cari Peserta
                            </label>
                            <input type="text" class="form-control" id="search" name="search"
                                value="{{ request('search') }}" placeholder="Nama, Email, NIK, atau Kode Registrasi">
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="form-label">
                                <i class="bi bi-filter me-1"></i>Status
                            </label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Semua Status</option>
                                <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>
                                    Verified</option>
                                <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>
                                    Unverified</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i>Cari
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-clockwise me-1"></i>Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-table me-2"></i>Data Peserta
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th style="width: 120px;">Kode</th>
                                <th>Nama / Email</th>
                                <th style="width: 120px;">No. WA</th>
                                <th style="width: 150px;">Asal</th>
                                <th class="text-center" style="width: 100px;">Status</th>
                                <th class="text-center" style="width: 100px;">Tanggal</th>
                                <th class="text-center" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peserta as $index => $p)
                                <tr>
                                    <td class="text-center fw-bold">{{ $peserta->firstItem() + $index }}</td>
                                    <td><code>{{ $p->kode_registrasi }}</code></td>
                                    <td>
                                        <div class="fw-bold">{{ $p->nama_lengkap }}</div>
                                        <small class="text-muted">{{ $p->email }}</small>
                                        @if ($p->email_verified_at)
                                            <br><span class="badge bg-success">
                                                <i class="bi bi-check-circle-fill"></i> Email Verified
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $p->nomor_wa }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $p->kabupaten_kota }}</div>
                                        <small class="text-muted">{{ $p->provinsi }}</small>
                                    </td>
                                    <td class="text-center">
                                        @if ($p->status === 'verified')
                                            <span class="badge bg-success">Verified</span>
                                        @elseif($p->status === 'unverified')
                                            <span class="badge bg-warning text-dark">Unverified</span>
                                        @else
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <small>{{ $p->created_at->format('d/m/Y') }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.dashboard.show', $p->id) }}"
                                                class="btn btn-outline-primary" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger"
                                                onclick="confirmDelete({{ $p->id }})" title="Hapus">
                                                <i class="bi bi-trash"></i>
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
                                    <td colspan="8" class="text-center py-5">
                                        <i class="bi bi-inbox fs-1 text-muted"></i>
                                        <p class="text-muted mt-2 mb-0">Tidak ada data peserta</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if ($peserta->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Menampilkan {{ $peserta->firstItem() }} - {{ $peserta->lastItem() }} dari
                            {{ $peserta->total() }} data
                        </div>
                        <div>
                            {{ $peserta->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
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
