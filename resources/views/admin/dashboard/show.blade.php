@extends('admin.layouts.app')

@section('title', 'Detail Peserta - JKPI 2026')

@section('content')

    {{-- Page Header --}}
    <div class="page-header flex-wrap">
        <div class="header-left">
            <h3 class="fw-bold mb-0">Detail Peserta</h3>
            <p class="text-muted mb-0">{{ $peserta->nama_lengkap }}</p>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
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

        {{-- Kolom Kiri --}}
        <div class="col-lg-8">

            {{-- Data Pribadi --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-account me-2 text-primary" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Data Pribadi</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Kode Registrasi</p>
                            <span class="badge bg-secondary fw-normal font-13">{{ $peserta->kode_registrasi }}</span>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Status</p>
                            @if ($peserta->status === 'verified')
                                <span class="badge bg-success"><i class="mdi mdi-check-circle me-1"></i>Verified</span>
                            @elseif ($peserta->status === 'unverified')
                                <span class="badge bg-warning text-dark"><i
                                        class="mdi mdi-clock-outline me-1"></i>Unverified</span>
                            @else
                                <span class="badge bg-danger"><i class="mdi mdi-close-circle me-1"></i>Cancelled</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Nama Lengkap</p>
                            <p class="fw-bold mb-0">{{ $peserta->nama_lengkap }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Jabatan</p>
                            <p class="fw-bold mb-0">{{ $peserta->jabatan }}</p>
                        </div>
                        <div class="col-12">
                            <p class="text-muted fw-semibold mb-1 font-13">Instansi/Organisasi</p>
                            <p class="fw-bold mb-0">{{ $peserta->instansi_organisasi }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Kota/Kabupaten</p>
                            <p class="fw-bold mb-0">{{ $peserta->kota_kabupaten }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informasi Kontak --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-phone me-2 text-success" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Informasi Kontak</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Email</p>
                            <p class="fw-bold mb-1">{{ $peserta->email }}</p>
                            @if ($peserta->email_verified_at)
                                <span class="badge bg-success">
                                    <i class="mdi mdi-check me-1"></i>Email Verified
                                </span>
                            @else
                                <span class="badge bg-warning text-dark">
                                    <i class="mdi mdi-alert me-1"></i>Belum Verified
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">No. Telepon</p>
                            <p class="fw-bold mb-0">{{ $peserta->nomor_telepon }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Perjalanan & Akomodasi --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-airplane me-2 text-warning" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Perjalanan & Akomodasi</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Tanggal Kedatangan</p>
                            <p class="fw-bold mb-0">
                                {{ $peserta->tanggal_kedatangan ? $peserta->tanggal_kedatangan->format('d M Y') : '-' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted fw-semibold mb-1 font-13">Tanggal Kepulangan</p>
                            <p class="fw-bold mb-0">
                                {{ $peserta->tanggal_kepulangan ? $peserta->tanggal_kepulangan->format('d M Y') : '-' }}
                            </p>
                        </div>
                        @if ($peserta->akomodasi_hotel)
                            <div class="col-12">
                                <p class="text-muted fw-semibold mb-1 font-13">Akomodasi Hotel / Detail</p>
                                <p class="fw-bold mb-0">{{ $peserta->akomodasi_hotel }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        {{-- Kolom Kanan (Sidebar) --}}
        <div class="col-lg-4">

            {{-- Dokumen --}}
            <div class="card grid-margin">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-file-image me-2 text-danger" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Dokumen</h4>
                </div>
                <div class="card-body text-center">
                    @if ($peserta->foto)
                        <p class="text-muted fw-semibold mb-2 font-13 text-start">Foto Peserta</p>
                        <img src="{{ Storage::url($peserta->foto) }}" alt="Foto Peserta" class="img-fluid rounded"
                            style="max-height: 250px; object-fit: cover;">
                    @else
                        <i class="mdi mdi-file-remove-outline text-muted" style="font-size:3rem;"></i>
                        <p class="text-muted mt-2 mb-0">Tidak ada dokumen</p>
                    @endif
                </div>
            </div>

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
                    <div>
                        <p class="text-muted fw-semibold mb-1 font-13">Terakhir Update</p>
                        <p class="fw-bold mb-0">{{ $peserta->updated_at->format('d M Y, H:i') }}</p>
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
                                <option value="verified" {{ $peserta->status == 'verified' ? 'selected' : '' }}>Verified
                                </option>
                                <option value="unverified" {{ $peserta->status == 'unverified' ? 'selected' : '' }}>
                                    Unverified</option>
                                <option value="cancelled" {{ $peserta->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Catatan</label>
                            <textarea name="catatan" rows="3" class="form-control" placeholder="Catatan...">{{ $peserta->catatan }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="mdi mdi-check-circle me-1"></i>Update Status
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
