<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta - JKPI 2026</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard Admin JKPI 2026
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
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

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Detail Peserta</li>
            </ol>
        </nav>

        <!-- Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Data Pribadi -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-person-fill me-2"></i>Data Pribadi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-muted small">Kode Registrasi</label>
                                <p class="fw-bold mb-0"><code class="fs-6">{{ $peserta->kode_registrasi }}</code></p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Status</label>
                                <p class="mb-0">
                                    @if ($peserta->status === 'verified')
                                        <span class="badge bg-success fs-6">Verified</span>
                                    @elseif($peserta->status === 'unverified')
                                        <span class="badge bg-warning text-dark fs-6">Unverified</span>
                                    @else
                                        <span class="badge bg-danger fs-6">Cancelled</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Nama Lengkap</label>
                                <p class="fw-semibold mb-0">{{ $peserta->nama_lengkap }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">NIK</label>
                                <p class="mb-0">{{ $peserta->nik }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Jenis Kelamin</label>
                                <p class="mb-0">{{ $peserta->jenis_kelamin }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Tempat, Tanggal Lahir</label>
                                <p class="mb-0">{{ $peserta->tempat_lahir }},
                                    {{ $peserta->tanggal_lahir->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-12">
                                <label class="text-muted small">Alamat</label>
                                <p class="mb-0">{{ $peserta->alamat }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Provinsi</label>
                                <p class="mb-0">{{ $peserta->provinsi }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Kabupaten/Kota</label>
                                <p class="mb-0">{{ $peserta->kabupaten_kota }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-telephone-fill me-2"></i>Informasi Kontak</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-muted small">Email</label>
                                <p class="mb-0">{{ $peserta->email }}</p>
                                @if ($peserta->email_verified_at)
                                    <span class="badge bg-success mt-1">
                                        <i class="bi bi-check-circle-fill"></i> Verified
                                        {{ $peserta->email_verified_at->format('d/m/Y H:i') }}
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark mt-1">Belum Diverifikasi</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">No. WhatsApp</label>
                                <p class="mb-0">{{ $peserta->nomor_wa }}</p>
                            </div>
                            @if ($peserta->nomor_telepon)
                                <div class="col-md-6">
                                    <label class="text-muted small">No. Telepon</label>
                                    <p class="mb-0">{{ $peserta->nomor_telepon }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Pekerjaan -->
                @if ($peserta->instansi || $peserta->jabatan)
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="bi bi-briefcase-fill me-2"></i>Informasi Pekerjaan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @if ($peserta->instansi)
                                    <div class="col-md-6">
                                        <label class="text-muted small">Instansi</label>
                                        <p class="mb-0">{{ $peserta->instansi }}</p>
                                    </div>
                                @endif
                                @if ($peserta->jabatan)
                                    <div class="col-md-6">
                                        <label class="text-muted small">Jabatan</label>
                                        <p class="mb-0">{{ $peserta->jabatan }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Dokumen -->
                <div class="card mb-4">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0"><i class="bi bi-file-earmark-image me-2"></i>Dokumen</h5>
                    </div>
                    <div class="card-body">
                        @if ($peserta->foto)
                            <div class="mb-3">
                                <label class="text-muted small d-block mb-2">Foto Peserta</label>
                                <img src="{{ Storage::url($peserta->foto) }}" alt="Foto"
                                    class="img-fluid rounded border">
                            </div>
                        @endif

                        @if ($peserta->ktp)
                            <div>
                                <label class="text-muted small d-block mb-2">Foto KTP</label>
                                <img src="{{ Storage::url($peserta->ktp) }}" alt="KTP"
                                    class="img-fluid rounded border">
                            </div>
                        @endif

                        @if (!$peserta->foto && !$peserta->ktp)
                            <div class="text-center text-muted py-4">
                                <i class="bi bi-file-earmark-x fs-1"></i>
                                <p class="mb-0 mt-2">Tidak ada dokumen</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Info Tambahan</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-muted small">Anggota JKPI</label>
                            <p class="mb-0">
                                @if ($peserta->is_anggota_jkpi)
                                    <span class="badge bg-success">Ya</span>
                                @else
                                    <span class="badge bg-secondary">Tidak</span>
                                @endif
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small">Tanggal Daftar</label>
                            <p class="mb-0">{{ $peserta->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-muted small">Tanggal Update</label>
                            <p class="mb-0">{{ $peserta->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Update Status -->
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="bi bi-gear-fill me-2"></i>Update Status</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.dashboard.update-status', $peserta->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="verified" {{ $peserta->status == 'verified' ? 'selected' : '' }}>
                                        Verified</option>
                                    <option value="unverified"
                                        {{ $peserta->status == 'unverified' ? 'selected' : '' }}>Unverified</option>
                                    <option value="cancelled" {{ $peserta->status == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea name="catatan" id="catatan" rows="3" class="form-control" placeholder="Catatan...">{{ $peserta->catatan }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-check-circle me-1"></i>Update Status
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Back Button -->
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
