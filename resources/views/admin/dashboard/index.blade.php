@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - JKPI 2026')

@section('content')

    {{-- Page Header --}}
    <div class="page-header flex-wrap">
        <div class="header-left">
            <h3 class="fw-bold mb-0">Dashboard JKPI 2026</h3>
            <p class="text-muted mb-0">Manajemen Data Peserta</p>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pe-3">Dashboard</p>
                </a>
                <a class="ps-3 me-4" href="#">
                    <p class="m-0">JKPI 2026</p>
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

    {{-- Statistics Cards --}}
    <div class="row">
        @php
            $statCards = [
                [
                    'label' => 'Total Peserta',
                    'value' => $stats['total'],
                    'icon' => 'mdi-account-group',
                    'color' => 'primary',
                ],
                [
                    'label' => 'Verified',
                    'value' => $stats['verified'],
                    'icon' => 'mdi-check-circle',
                    'color' => 'success',
                ],
                [
                    'label' => 'Unverified',
                    'value' => $stats['unverified'],
                    'icon' => 'mdi-clock-outline',
                    'color' => 'warning',
                ],
                [
                    'label' => 'Cancelled',
                    'value' => $stats['cancelled'],
                    'icon' => 'mdi-close-circle',
                    'color' => 'danger',
                ],
                [
                    'label' => 'Email Verified',
                    'value' => $stats['email_verified'],
                    'icon' => 'mdi-email-check',
                    'color' => 'info',
                ],
                [
                    'label' => 'Butuh Hotel',
                    'value' => $stats['butuh_hotel'],
                    'icon' => 'mdi-office-building',
                    'color' => 'dark',
                ],
            ];
        @endphp

        @foreach ($statCards as $card)
            <div class="col-xl-2 col-sm-4 col-6 stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="p-2 rounded bg-{{ $card['color'] }} bg-opacity-10">
                                    <i class="mdi {{ $card['icon'] }} text-{{ $card['color'] }}"
                                        style="font-size: 1.75rem;"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0">{{ $card['value'] }}</h4>
                                <p class="text-muted mb-0 font-13">{{ $card['label'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Export Section --}}
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-download me-2 text-primary" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Export Data Excel</h4>
                </div>
                <div class="card-body">
                    <p class="fw-semibold mb-2">Export by Status</p>
                    <div class="row g-2 mb-4">
                        @if ($stats['total'] != 0)
                            <div class="col-6 col-md-3">
                                <a href="{{ url('/admin/dashboard/export/all') }}" class="btn btn-primary w-100">
                                    <i class="mdi mdi-download me-1"></i> Semua ({{ $stats['total'] }})
                                </a>
                            </div>
                        @endif
                        @if ($stats['verified'] != 0)
                            <div class="col-6 col-md-3">
                                <a href="{{ url('/admin/dashboard/export/verified') }}" class="btn btn-success w-100">
                                    <i class="mdi mdi-check-circle me-1"></i> Verified ({{ $stats['verified'] }})
                                </a>
                            </div>
                        @endif
                        @if ($stats['unverified'] != 0)
                            <div class="col-6 col-md-3">
                                <a href="{{ url('/admin/dashboard/export/unverified') }}" class="btn btn-warning w-100">
                                    <i class="mdi mdi-clock-outline me-1"></i> Unverified ({{ $stats['unverified'] }})
                                </a>
                            </div>
                        @endif
                        @if ($stats['cancelled'] != 0)
                            <div class="col-6 col-md-3">
                                <a href="{{ url('/admin/dashboard/export/cancelled') }}" class="btn btn-danger w-100">
                                    <i class="mdi mdi-close-circle me-1"></i> Cancelled ({{ $stats['cancelled'] }})
                                </a>
                            </div>
                        @endif
                    </div>

                    <p class="fw-semibold mb-2">Export Lainnya</p>
                    <div class="row g-2">
                        <div class="col-6 col-md-3">
                            <a href="{{ url('/admin/dashboard/export/statistik') }}" class="btn btn-info w-100">
                                <i class="mdi mdi-chart-bar me-1"></i> Statistik
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ url('/admin/dashboard/export/by-kabupaten-kota') }}"
                                class="btn btn-secondary w-100">
                                <i class="mdi mdi-map me-1"></i> By Kab/Kota
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Section --}}
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <i class="mdi mdi-filter me-2 text-primary" style="font-size:1.25rem;"></i>
                    <h4 class="card-title mb-0">Filter & Pencarian</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.dashboard') }}">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">
                                    <i class="mdi mdi-magnify me-1"></i>Cari Peserta
                                </label>
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                    placeholder="Nama, Email, Kode Registrasi, atau Kota/Kabupaten">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="mdi mdi-filter-outline me-1"></i>Status
                                </label>
                                <select class="form-select" name="status">
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
                        <div class="mt-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-magnify me-1"></i>Cari
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="mdi mdi-refresh me-1"></i>Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-table-large me-2 text-primary" style="font-size:1.25rem;"></i>
                        <h4 class="card-title mb-0">Data Peserta</h4>
                    </div>
                    @if ($peserta->total() > 0)
                        <small class="text-muted">
                            Menampilkan {{ $peserta->firstItem() }}–{{ $peserta->lastItem() }}
                            dari {{ $peserta->total() }} peserta
                        </small>
                    @endif
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width:60px;">No</th>
                                    <th style="width:130px;">Kode</th>
                                    <th>Nama / Email</th>
                                    <th style="width:130px;">No. Telepon</th>
                                    <th style="width:160px;">Kota/Kabupaten</th>
                                    <th class="text-center" style="width:120px;">Status</th>
                                    <th class="text-center" style="width:100px;">Tanggal</th>
                                    <th class="text-center" style="width:140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peserta as $index => $p)
                                    <tr>
                                        <td class="text-center fw-bold">
                                            {{ $peserta->firstItem() + $index }}
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary font-13 fw-normal">
                                                {{ $p->kode_registrasi }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $p->nama_lengkap }}</div>
                                            <small class="text-muted">{{ $p->email }}</small>
                                            @if ($p->email_verified_at)
                                                <br>
                                                <span class="badge bg-success mt-1">
                                                    <i class="mdi mdi-check me-1"></i>Email Verified
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $p->nomor_telepon }}</td>
                                        <td>
                                            <div class="fw-semibold">{{ $p->kota_kabupaten }}</div>
                                            <small class="text-muted">{{ $p->jabatan }}</small>
                                        </td>
                                        <td class="text-center">
                                            @if ($p->status === 'verified')
                                                <span class="badge bg-success">Verified</span>
                                            @elseif ($p->status === 'unverified')
                                                <span class="badge bg-warning text-dark">Unverified</span>
                                            @else
                                                <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <small class="text-muted">
                                                {{ $p->created_at->format('d/m/Y') }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center">
                                                <a href="{{ route('admin.dashboard.show', $p->id) }}"
                                                    class="btn btn-sm btn-primary" title="Lihat Detail">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                                <button onclick="confirmDelete({{ $p->id }})"
                                                    class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="mdi mdi-trash-can"></i>
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
                                            <i class="mdi mdi-inbox-outline text-muted" style="font-size:3rem;"></i>
                                            <p class="text-muted mt-2 mb-0">Tidak ada data peserta</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($peserta->hasPages())
                        <div class="p-3 border-top d-flex justify-content-end">
                            {{ $peserta->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            if (confirm('Yakin ingin menghapus data peserta ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endpush
