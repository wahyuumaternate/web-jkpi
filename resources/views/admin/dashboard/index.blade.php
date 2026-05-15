{{-- dashboard.blade.php (disesuaikan dengan DB) --}}
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
                <a href="#"><p class="m-0 pe-3">Dashboard</p></a>
                <a class="ps-3 me-4" href="#"><p class="m-0">JKPI 2026</p></a>
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
                    'icon'  => 'mdi-account-group',
                    'color' => 'primary',
                ],
                [
                    'label' => 'Confirmed',
                    'value' => $stats['confirmed'],
                    'icon'  => 'mdi-check-circle',
                    'color' => 'success',
                ],
                [
                    'label' => 'Pending',
                    'value' => $stats['pending'],
                    'icon'  => 'mdi-clock-outline',
                    'color' => 'warning',
                ],
                [
                    'label' => 'Cancelled',
                    'value' => $stats['cancelled'],
                    'icon'  => 'mdi-close-circle',
                    'color' => 'danger',
                ],
            ];
        @endphp

        @foreach ($statCards as $card)
            <div class="col-xl-3 col-sm-6 col-6 stretch-card grid-margin">
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
                        @if ($stats['confirmed'] != 0)
                            <div class="col-6 col-md-3">
                                <a href="{{ url('/admin/dashboard/export/confirmed') }}" class="btn btn-success w-100">
                                    <i class="mdi mdi-check-circle me-1"></i> Confirmed ({{ $stats['confirmed'] }})
                                </a>
                            </div>
                        @endif
                        @if ($stats['pending'] != 0)
                            <div class="col-6 col-md-3">
                                <a href="{{ url('/admin/dashboard/export/pending') }}" class="btn btn-warning w-100">
                                    <i class="mdi mdi-clock-outline me-1"></i> Pending ({{ $stats['pending'] }})
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
                            <a href="{{ url('/admin/dashboard/export/by-daerah') }}" class="btn btn-secondary w-100">
                                <i class="mdi mdi-map me-1"></i> By Daerah
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
                                <input type="text" class="form-control" name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Nama Daerah, Nama Kepala Daerah, Kode Registrasi, atau Ajudan">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="mdi mdi-filter-outline me-1"></i>Status
                                </label>
                                <select class="form-select" name="status">
                                    <option value="">Semua Status</option>
                                    <option value="confirmed"
                                        {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="pending"
                                        {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="cancelled"
                                        {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Daerah & Kepala Daerah</th>
                                    <th>Pasangan</th>
                                    <th>Ajudan / ADC</th>
                                    <th>Narahubung</th>
                                    <th>Perjalanan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peserta as $index => $p)
                                    <tr>
                                        <td>{{ $peserta->firstItem() + $index }}</td>

                                        {{-- KODE REGISTRASI --}}
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ $p->kode_registrasi }}
                                            </span>
                                        </td>

                                        {{-- DAERAH & KEPALA DAERAH --}}
                                        <td>
                                            <div class="fw-bold">{{ $p->nama_kepala_daerah }}</div>
                                            <small class="text-muted">{{ $p->nama_daerah }}</small>
                                        </td>

                                        {{-- PASANGAN --}}
                                        <td>
                                            @if ($p->nama_pasangan_kepala_daerah)
                                                {{ $p->nama_pasangan_kepala_daerah }}
                                            @else
                                                <small class="text-muted">-</small>
                                            @endif
                                        </td>

                                        {{-- AJUDAN / ADC --}}
                                        <td>
                                            @if ($p->nama_ajudan)
                                                <div>{{ $p->nama_ajudan }}</div>
                                                @if ($p->telepon_ajudan)
                                                    <small class="text-muted">{{ $p->telepon_ajudan }}</small>
                                                @endif
                                            @else
                                                <small class="text-muted">-</small>
                                            @endif
                                        </td>

                                        {{-- NARAHUBUNG (relasi) --}}
                                        <td>
                                            @if ($p->narahubung && $p->narahubung->count())
                                                @foreach ($p->narahubung as $nh)
                                                    <div>{{ $nh->nama }}</div>
                                                    <small class="text-muted">
                                                        {{ $nh->telepon }} · {{ $nh->email }}
                                                    </small>
                                                @endforeach
                                            @else
                                                <small class="text-muted">-</small>
                                            @endif
                                        </td>

                                        {{-- PERJALANAN --}}
                                        <td>
                                            <small>
                                                <i class="mdi mdi-airplane-landing me-1"></i>
                                                {{ $p->info_kedatangan }}<br>
                                                <i class="mdi mdi-airplane-takeoff me-1"></i>
                                                {{ $p->info_kepulangan }}
                                            </small>
                                            @if ($p->nomor_plat)
                                                <br><small class="text-muted">
                                                    <i class="mdi mdi-car me-1"></i>{{ $p->nomor_plat }}
                                                </small>
                                            @endif
                                        </td>

                                        {{-- STATUS --}}
                                        <td>
                                            @if ($p->status === 'confirmed')
                                                <span class="badge bg-success">Confirmed</span>
                                            @elseif ($p->status === 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @else
                                                <span class="badge bg-danger">Cancelled</span>
                                            @endif

                                            @if ($p->catatan)
                                                <br>
                                                <small class="text-muted" title="{{ $p->catatan }}">
                                                    <i class="mdi mdi-note-text me-1"></i>Ada catatan
                                                </small>
                                            @endif
                                        </td>

                                        {{-- AKSI --}}
                                        <td>
                                            <a href="{{ route('admin.dashboard.show', $p->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="mdi mdi-eye"></i>
                                            </a>

                                            <button onclick="confirmDelete({{ $p->id }})"
                                                class="btn btn-sm btn-danger">
                                                <i class="mdi mdi-trash-can"></i>
                                            </button>

                                            {{-- Hidden delete form --}}
                                            <form id="delete-form-{{ $p->id }}"
                                                action="{{ route('admin.dashboard.destroy', $p->id) }}"
                                                method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4 text-muted">
                                            <i class="mdi mdi-inbox-outline" style="font-size:2rem;"></i>
                                            <p class="mb-0 mt-1">Tidak ada data peserta</p>
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