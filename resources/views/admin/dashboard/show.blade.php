{{-- resources/views/admin/dashboard/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Detail Peserta - ' . $peserta->kode_registrasi)

@section('content')

    {{-- Page Header --}}
    <div class="page-header flex-wrap">
        <div class="header-left">
            <h3 class="fw-bold mb-0">Detail Peserta</h3>
            <p class="text-muted mb-0">{{ $peserta->nama_kepala_daerah }} — {{ $peserta->nama_daerah }}</p>
        </div>
        <div class="header-right d-flex flex-wrap align-items-center mt-2 mt-sm-0">
            <a href="{{ route('admin.dashboard.edit', $peserta->id) }}" class="btn btn-primary btn-sm me-3">
                <i class="mdi mdi-pencil me-1"></i>Edit Data
            </a>
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.dashboard') }}">
                    <p class="m-0 pe-3">Dashboard</p>
                </a>
                <a class="ps-3 me-4" href="#">
                    <p class="m-0">Detail Peserta</p>
                </a>
            </div>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle me-2"></i>
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">

        {{-- ═══════════════════════════════════════════════════════════════════
             KOLOM KIRI
        ════════════════════════════════════════════════════════════════════════ --}}
        <div class="col-lg-8">

            {{-- Data Daerah & Kepala Daerah --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-map-marker me-2 text-primary" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Data Daerah & Kepala Daerah</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Kode Registrasi</p>
                            <span class="badge bg-secondary fw-normal font-13">
                                {{ $peserta->kode_registrasi }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Status</p>
                            @if ($peserta->status === 'confirmed')
                                <span class="badge bg-success">
                                    <i class="mdi mdi-check-circle me-1"></i>Confirmed
                                </span>
                            @elseif ($peserta->status === 'pending')
                                <span class="badge bg-warning text-dark">
                                    <i class="mdi mdi-clock-outline me-1"></i>Pending
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="mdi mdi-close-circle me-1"></i>Cancelled
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Nama Daerah</p>
                            <p class="fw-bold mb-0">{{ $peserta->nama_daerah }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Nama Kepala Daerah</p>
                            <p class="fw-bold mb-0">{{ $peserta->nama_kepala_daerah }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Nama Pasangan Kepala Daerah</p>
                            <p class="fw-bold mb-0">{{ $peserta->nama_pasangan_kepala_daerah ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Data Wakil Kepala Daerah --}}
            @if ($peserta->nama_wakil_kepala_daerah || $peserta->nama_pasangan_wakil_kepala_daerah)
                <div class="card grid-margin">
                    <div class="card-header d-flex align-items-center">
                        <i class="mdi mdi-account-tie-outline me-2 text-primary" style="font-size:1.25rem;"></i>
                        <h4 class="card-title mb-0">Data Wakil Kepala Daerah</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="text-muted fw-semibold mb-1 font-13">Nama Wakil Kepala Daerah</p>
                                <p class="fw-bold mb-0">{{ $peserta->nama_wakil_kepala_daerah ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted fw-semibold mb-1 font-13">Nama Pasangan Wakil Kepala Daerah</p>
                                <p class="fw-bold mb-0">{{ $peserta->nama_pasangan_wakil_kepala_daerah ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Informasi Tambahan --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-details me-2 text-info" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Informasi Tambahan</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted fw-semibold mb-2 font-13 text-uppercase" style="font-size:.72rem; letter-spacing:.05em;">
                        Kepala Daerah
                    </p>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <p class="text-muted fw-semibold mb-1 font-13">
                                <i class="mdi mdi-tshirt-v me-1"></i>Ukuran Baju
                            </p>
                            <p class="fw-bold mb-0">
                                <span class="badge bg-primary">{{ $peserta->ukuran_baju }}</span>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted fw-semibold mb-1 font-13">
                                <i class="mdi mdi-tshirt-v me-1"></i>Ukuran Baju Pasangan
                            </p>
                            <p class="fw-bold mb-0">
                                @if ($peserta->ukuran_baju_pasangan)
                                    <span class="badge bg-info">{{ $peserta->ukuran_baju_pasangan }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted fw-semibold mb-1 font-13">
                                <i class="mdi mdi-hat-fedora me-1"></i>Ukuran Peci
                            </p>
                            <p class="fw-bold mb-0">
                                @if ($peserta->ukuran_peci)
                                    <span class="badge bg-secondary">{{ $peserta->ukuran_peci }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    @if ($peserta->nama_wakil_kepala_daerah || $peserta->ukuran_baju_wakil || $peserta->ukuran_peci_wakil)
                        <hr>
                        <p class="text-muted fw-semibold mb-2 font-13 text-uppercase" style="font-size:.72rem; letter-spacing:.05em;">
                            Wakil Kepala Daerah
                        </p>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <p class="text-muted fw-semibold mb-1 font-13">
                                    <i class="mdi mdi-tshirt-v me-1"></i>Ukuran Baju Wakil
                                </p>
                                <p class="fw-bold mb-0">
                                    @if ($peserta->ukuran_baju_wakil)
                                        <span class="badge bg-primary">{{ $peserta->ukuran_baju_wakil }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted fw-semibold mb-1 font-13">
                                    <i class="mdi mdi-tshirt-v me-1"></i>Ukuran Baju Pasangan Wakil
                                </p>
                                <p class="fw-bold mb-0">
                                    @if ($peserta->ukuran_baju_pasangan_wakil)
                                        <span class="badge bg-info">{{ $peserta->ukuran_baju_pasangan_wakil }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted fw-semibold mb-1 font-13">
                                    <i class="mdi mdi-hat-fedora me-1"></i>Ukuran Peci Wakil
                                </p>
                                <p class="fw-bold mb-0">
                                    @if ($peserta->ukuran_peci_wakil)
                                        <span class="badge bg-secondary">{{ $peserta->ukuran_peci_wakil }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-4">
                            <p class="text-muted fw-semibold mb-1 font-13">
                                <i class="mdi mdi-account-multiple me-1"></i>Jumlah Rombongan
                            </p>
                            <p class="fw-bold mb-0 text-dark">{{ $peserta->jumlah_rombongan }} orang</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ajudan / ADC --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-account-tie me-2 text-info" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Ajudan / ADC</h4>
                </div>
                <div class="card-body">
                    @if ($peserta->nama_ajudan)
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="text-muted fw-semibold mb-1 font-13">Nama Ajudan</p>
                                <p class="fw-bold mb-0">{{ $peserta->nama_ajudan }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted fw-semibold mb-1 font-13">Telepon Ajudan</p>
                                <p class="fw-bold mb-0">{{ $peserta->telepon_ajudan ?? '-' }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-minus-circle-outline me-1"></i>Tidak ada data ajudan
                        </p>
                    @endif
                </div>
            </div>

            {{-- Informasi Perjalanan --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-airplane me-2 text-warning" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Informasi Perjalanan</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">
                                <i class="mdi mdi-airplane-landing me-1"></i>Info Kedatangan
                            </p>
                            <p class="fw-bold mb-0">{{ $peserta->info_kedatangan }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">
                                <i class="mdi mdi-airplane-takeoff me-1"></i>Info Kepulangan
                            </p>
                            <p class="fw-bold mb-0">{{ $peserta->info_kepulangan }}</p>
                        </div>
                        @if ($peserta->nomor_plat)
                            <div class="col-md-6">
                                <p class="text-muted fw-semibold mb-1 font-13">
                                    <i class="mdi mdi-car me-1"></i>Nomor Plat
                                </p>
                                <p class="fw-bold mb-0">{{ $peserta->nomor_plat }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Narahubung --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-phone me-2 text-success" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Narahubung</h4>
                </div>
                <div class="card-body">
                    @if ($peserta->narahubung && $peserta->narahubung->count())
                        @foreach ($peserta->narahubung as $nh)
                            <div class="{{ !$loop->last ? 'mb-4 pb-4 border-bottom' : '' }}">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <p class="text-muted fw-semibold mb-1 font-13">Nama</p>
                                        <p class="fw-bold mb-0">{{ $nh->nama }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="text-muted fw-semibold mb-1 font-13">Telepon</p>
                                        <p class="fw-bold mb-0">{{ $nh->telepon }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="text-muted fw-semibold mb-1 font-13">Email</p>
                                        <p class="fw-bold mb-0">{{ $nh->email }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-minus-circle-outline me-1"></i>Tidak ada data narahubung
                        </p>
                    @endif
                </div>
            </div>

            {{-- Kegiatan Yang Akan Diikuti --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-calendar-check me-2 text-success" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Kegiatan Yang Akan Diikuti</h4>
                </div>
                <div class="card-body">
                    @if ($peserta->kegiatan && $peserta->kegiatan->count())
                        <div class="list-group list-group-flush">
                            @foreach ($peserta->kegiatan as $kegiatan)
                                <div class="list-group-item px-0 py-3 border-bottom">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <i class="mdi mdi-checkbox-marked-circle text-success"
                                                style="font-size:1.4rem;"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="fw-semibold mb-0">{{ $kegiatan->nama_kegiatan }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-minus-circle-outline me-1"></i>Tidak ada kegiatan yang dipilih
                        </p>
                    @endif
                </div>
            </div>

            {{-- Catatan --}}
            @if ($peserta->catatan)
                <div class="card grid-margin">
                    <div class="card-header d-flex align-items-center">
                        <i class="mdi mdi-note-text me-2 text-secondary" style="font-size:1.25rem;"></i>
                        <h4 class="card-title mb-0">Catatan</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $peserta->catatan }}</p>
                    </div>
                </div>
            @endif

        </div>

        {{-- ═══════════════════════════════════════════════════════════════════
             KOLOM KANAN (Sidebar)
        ════════════════════════════════════════════════════════════════════════ --}}
        <div class="col-lg-4">

            {{-- Info Tambahan --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-information-outline me-2 text-info" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Info Tambahan</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="text-muted fw-semibold mb-1 font-13">Tanggal Daftar</p>
                        <p class="fw-bold mb-0">{{ $peserta->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted fw-semibold mb-1 font-13">Terakhir Update</p>
                        <p class="fw-bold mb-0">{{ $peserta->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                    @if ($peserta->deleted_at)
                        <div>
                            <p class="text-muted fw-semibold mb-1 font-13">Dihapus Pada</p>
                            <p class="fw-bold mb-0 text-danger">{{ $peserta->deleted_at->format('d M Y, H:i') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Ringkasan Rombongan --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-account-multiple me-2 text-primary" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Ringkasan Rombongan</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="bg-light rounded p-3 text-center">
                                <p class="text-muted font-13 mb-1">Total Rombongan</p>
                                <p class="fw-bold text-primary mb-0" style="font-size:1.8rem;">
                                    {{ $peserta->jumlah_rombongan }}
                                    <span style="font-size:0.9rem;">orang</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="text-muted font-13 mb-2">Terdiri dari:</p>
                            <ul class="mb-0 ps-3">
                                <li class="mb-2">
                                    1 Kepala Daerah
                                    <span class="badge bg-primary ms-1">{{ $peserta->ukuran_baju }}</span>
                                    @if ($peserta->ukuran_peci)
                                        <span class="badge bg-secondary ms-1">Peci {{ $peserta->ukuran_peci }}</span>
                                    @endif
                                </li>
                                @if ($peserta->nama_pasangan_kepala_daerah)
                                    <li class="mb-2">
                                        1 Pasangan Kepala Daerah
                                        @if ($peserta->ukuran_baju_pasangan)
                                            <span class="badge bg-info ms-1">{{ $peserta->ukuran_baju_pasangan }}</span>
                                        @endif
                                    </li>
                                @endif
                                @if ($peserta->nama_wakil_kepala_daerah)
                                    <li class="mb-2">
                                        1 Wakil Kepala Daerah
                                        @if ($peserta->ukuran_baju_wakil)
                                            <span class="badge bg-primary ms-1">{{ $peserta->ukuran_baju_wakil }}</span>
                                        @endif
                                        @if ($peserta->ukuran_peci_wakil)
                                            <span class="badge bg-secondary ms-1">Peci {{ $peserta->ukuran_peci_wakil }}</span>
                                        @endif
                                    </li>
                                @endif
                                @if ($peserta->nama_pasangan_wakil_kepala_daerah)
                                    <li class="mb-2">
                                        1 Pasangan Wakil Kepala Daerah
                                        @if ($peserta->ukuran_baju_pasangan_wakil)
                                            <span class="badge bg-info ms-1">{{ $peserta->ukuran_baju_pasangan_wakil }}</span>
                                        @endif
                                    </li>
                                @endif
                                @if ($peserta->nama_ajudan)
                                    <li class="mb-2">1 Ajudan/ADC</li>
                                @endif
                                @if ($peserta->narahubung && $peserta->narahubung->count())
                                    <li class="mb-2">{{ $peserta->narahubung->count() }} Narahubung</li>
                                @endif
                            </ul>
                        </div>

                        {{-- Kegiatan summary --}}
                        @if ($peserta->kegiatan && $peserta->kegiatan->count())
                            <div class="col-12">
                                <div class="bg-opacity-10 rounded p-3">
                                    <p class="text-muted font-13 mb-1">
                                        <i class="mdi mdi-calendar-check me-1 text-success"></i>
                                        Kegiatan Dipilih
                                    </p>
                                    <p class="fw-bold text-success mb-0" style="font-size:1.4rem;">
                                        {{ $peserta->kegiatan->count() }} / 12
                                        <span style="font-size:0.9rem;">kegiatan</span>
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="col-12">
                                <div class="bg-warning bg-opacity-10 rounded p-3">
                                    <p class="text-muted font-13 mb-0">
                                        <i class="mdi mdi-calendar-remove me-1 text-warning"></i>
                                        Belum memilih kegiatan
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Update Status --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-cog me-2 text-primary" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Update Status</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.dashboard.update-status', $peserta->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ $peserta->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="confirmed" {{ $peserta->status == 'confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="cancelled" {{ $peserta->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Catatan</label>
                            <textarea name="catatan" rows="3" class="form-control" placeholder="Catatan admin...">{{ $peserta->catatan }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="mdi mdi-check-circle me-1"></i>Update Status
                        </button>
                    </form>
                </div>
            </div>

            {{-- Zona Berbahaya --}}
            <div class="card grid-margin border-danger">
                <div class="card-header d-flex align-items-center bg-danger bg-opacity-10">
                    <i class="mdi mdi-alert me-2 text-danger" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0 text-danger">Zona Berbahaya</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted font-13 mb-3">
                        Menghapus data akan menghapus seluruh data peserta beserta narahubung
                        dan kegiatan secara permanen.
                    </p>
                    <form action="{{ route('admin.dashboard.destroy', $peserta->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100"
                            onclick="return confirm('Yakin ingin menghapus data {{ addslashes($peserta->nama_kepala_daerah) }}? Tindakan ini tidak dapat dibatalkan.')">
                            <i class="mdi mdi-trash-can me-1"></i>Hapus Data Peserta
                        </button>
                    </form>
                </div>
            </div>

            {{-- Tombol Kembali --}}
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary w-100 mb-4">
                <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Dashboard
            </a>

        </div>
    </div>

@endsection