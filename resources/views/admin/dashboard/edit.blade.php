{{-- resources/views/admin/dashboard/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Peserta - ' . $peserta->kode_registrasi)

@section('content')

    {{-- Page Header --}}
    <div class="page-header flex-wrap">
        <div class="header-left">
            <h3 class="fw-bold mb-0">Edit Peserta</h3>
            <p class="text-muted mb-0">{{ $peserta->nama_kepala_daerah }} — {{ $peserta->nama_daerah }}</p>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.dashboard') }}">
                    <p class="m-0 pe-3">Dashboard</p>
                </a>
                <a class="ps-3 pe-3" href="{{ route('admin.dashboard.show', $peserta->id) }}">
                    <p class="m-0">Detail Peserta</p>
                </a>
                <a class="ps-3 me-4" href="#">
                    <p class="m-0">Edit</p>
                </a>
            </div>
        </div>
    </div>

    {{-- Alert error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-bold mb-1"><i class="mdi mdi-alert-circle me-1"></i>Mohon periksa kembali isian berikut:</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.dashboard.update', $peserta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- ═══════════════════════════════════════════════════════════════
                 KOLOM KIRI
            ════════════════════════════════════════════════════════════════════ --}}
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
                                <label class="form-label fw-semibold">Nama Daerah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_daerah"
                                    value="{{ old('nama_daerah', $peserta->nama_daerah) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jumlah Rombongan <span
                                        class="text-danger">*</span></label>
                                <input type="number" min="1" class="form-control" name="jumlah_rombongan"
                                    value="{{ old('jumlah_rombongan', $peserta->jumlah_rombongan) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Kepala Daerah <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_kepala_daerah"
                                    value="{{ old('nama_kepala_daerah', $peserta->nama_kepala_daerah) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Pasangan Kepala Daerah</label>
                                <input type="text" class="form-control" id="nama_pasangan_kepala_daerah"
                                    name="nama_pasangan_kepala_daerah"
                                    value="{{ old('nama_pasangan_kepala_daerah', $peserta->nama_pasangan_kepala_daerah) }}"
                                    oninput="toggleRequired('nama_pasangan_kepala_daerah','ukuran_baju_pasangan')">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Ukuran Baju Kepala Daerah <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="ukuran_baju" required>
                                    <option value="">Pilih Ukuran</option>
                                    @foreach (['S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $u)
                                        <option value="{{ $u }}"
                                            {{ old('ukuran_baju', $peserta->ukuran_baju) == $u ? 'selected' : '' }}>
                                            {{ $u }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Ukuran Baju Pasangan</label>
                                <select class="form-select" name="ukuran_baju_pasangan" id="ukuran_baju_pasangan">
                                    <option value="">Pilih Ukuran</option>
                                    @foreach (['S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $u)
                                        <option value="{{ $u }}"
                                            {{ old('ukuran_baju_pasangan', $peserta->ukuran_baju_pasangan) == $u ? 'selected' : '' }}>
                                            {{ $u }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Ukuran Peci</label>
                                <input type="text" class="form-control" name="ukuran_peci"
                                    value="{{ old('ukuran_peci', $peserta->ukuran_peci) }}" placeholder="Contoh: 58">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Data Wakil Kepala Daerah --}}
                <div class="card grid-margin">
                    <div class="card-header d-flex align-items-center">
                        <i class="mdi mdi-account-tie-outline me-2 text-primary" style="font-size:1.25rem;"></i>
                        <h4 class="card-title mb-0">Data Wakil Kepala Daerah <small class="text-muted ms-2">Kosongkan jika
                                tidak hadir</small></h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Wakil Kepala Daerah</label>
                                <input type="text" class="form-control" id="nama_wakil_kepala_daerah"
                                    name="nama_wakil_kepala_daerah"
                                    value="{{ old('nama_wakil_kepala_daerah', $peserta->nama_wakil_kepala_daerah) }}"
                                    oninput="toggleRequired('nama_wakil_kepala_daerah','ukuran_baju_wakil')">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Pasangan Wakil Kepala Daerah</label>
                                <input type="text" class="form-control" id="nama_pasangan_wakil_kepala_daerah"
                                    name="nama_pasangan_wakil_kepala_daerah"
                                    value="{{ old('nama_pasangan_wakil_kepala_daerah', $peserta->nama_pasangan_wakil_kepala_daerah) }}"
                                    oninput="toggleRequired('nama_pasangan_wakil_kepala_daerah','ukuran_baju_pasangan_wakil')">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Ukuran Baju Wakil</label>
                                <select class="form-select" name="ukuran_baju_wakil" id="ukuran_baju_wakil">
                                    <option value="">Pilih Ukuran</option>
                                    @foreach (['S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $u)
                                        <option value="{{ $u }}"
                                            {{ old('ukuran_baju_wakil', $peserta->ukuran_baju_wakil) == $u ? 'selected' : '' }}>
                                            {{ $u }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Ukuran Baju Pasangan Wakil</label>
                                <select class="form-select" name="ukuran_baju_pasangan_wakil"
                                    id="ukuran_baju_pasangan_wakil">
                                    <option value="">Pilih Ukuran</option>
                                    @foreach (['S', 'M', 'L', 'XL', 'XXL', 'XXXL'] as $u)
                                        <option value="{{ $u }}"
                                            {{ old('ukuran_baju_pasangan_wakil', $peserta->ukuran_baju_pasangan_wakil) == $u ? 'selected' : '' }}>
                                            {{ $u }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Ukuran Peci Wakil</label>
                                <input type="text" class="form-control" name="ukuran_peci_wakil"
                                    value="{{ old('ukuran_peci_wakil', $peserta->ukuran_peci_wakil) }}"
                                    placeholder="Contoh: 58">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kegiatan --}}
                <div class="card grid-margin">
                    <div class="card-header d-flex align-items-center">
                        <i class="mdi mdi-calendar-check me-2 text-success" style="font-size:1.25rem;"></i>
                        <h4 class="card-title mb-0">Kegiatan yang Akan Diikuti</h4>
                    </div>
                    <div class="card-body">
                        @php
                            $daftarKegiatan = [
                                'Master Class',
                                'Welcome Dinner',
                                'Expo UMKM',
                                'Pentas Budaya',
                                'Ladies Program',
                                'Simposium Internasional - Pulau-Pulau Penghasil Rempah',
                                'Rapat Kerja Nasional',
                                'Festival Gastronomi',
                                'Gelar Budaya dan Penyerahan Pataka',
                                'Seminar Nasional',
                                'Heritage City Tour',
                                'Pawai Budaya dan Karnaval',
                                'Nusantara Raya Run',
                            ];
                            $selectedKegiatan = old(
                                'kegiatan',
                                $peserta->kegiatan ? $peserta->kegiatan->pluck('nama_kegiatan')->toArray() : [],
                            );
                        @endphp
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
                            @foreach ($daftarKegiatan as $k)
                                <div class="col">
                                    <div class="border rounded-3 p-3 h-100 bg-light bg-opacity-50">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" name="kegiatan[]"
                                                value="{{ $k }}" id="kegiatan-{{ $loop->index }}"
                                                {{ in_array($k, $selectedKegiatan) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark ms-2"
                                                for="kegiatan-{{ $loop->index }}" style="word-break: break-word;">
                                                {{ $k }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                                <label class="form-label fw-semibold">Nomor Plat Kendaraan</label>
                                <input type="text" class="form-control" name="nomor_plat"
                                    value="{{ old('nomor_plat', $peserta->nomor_plat) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Info Kedatangan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="info_kedatangan"
                                    value="{{ old('info_kedatangan', $peserta->info_kedatangan) }}" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Info Kepulangan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="info_kepulangan"
                                    value="{{ old('info_kepulangan', $peserta->info_kepulangan) }}" required>
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
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Ajudan</label>
                                <input type="text" class="form-control" name="nama_ajudan"
                                    value="{{ old('nama_ajudan', $peserta->nama_ajudan) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Telepon Ajudan</label>
                                <input type="text" class="form-control" name="telepon_ajudan"
                                    value="{{ old('telepon_ajudan', $peserta->telepon_ajudan) }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Narahubung --}}
                <div class="card grid-margin">
                    <div class="card-header d-flex align-items-center">
                        <i class="mdi mdi-phone me-2 text-success" style="font-size:1.25rem;"></i>
                        <h4 class="card-title mb-0">Data Narahubung</h4>
                    </div>
                    <div class="card-body">
                        <div id="narahubungContainer">
                            @php
                                $oldNarahubung = old(
                                    'narahubung',
                                    $peserta->narahubung && $peserta->narahubung->count()
                                        ? $peserta->narahubung
                                            ->map(
                                                fn($n) => [
                                                    'nama' => $n->nama,
                                                    'telepon' => $n->telepon,
                                                    'email' => $n->email,
                                                ],
                                            )
                                            ->toArray()
                                        : [[]],
                                );
                            @endphp
                            @foreach ($oldNarahubung as $index => $nh)
                                <div class="narahubung-row border rounded p-3 mb-3" data-index="{{ $index }}">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-semibold nh-number">Narahubung {{ $index + 1 }}</span>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="removeNarahubung(this)"
                                            {{ count($oldNarahubung) <= 1 ? 'disabled' : '' }}>
                                            <i class="mdi mdi-trash-can-outline"></i> Hapus
                                        </button>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Nama <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                name="narahubung[{{ $index }}][nama]"
                                                value="{{ $nh['nama'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Telepon <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                name="narahubung[{{ $index }}][telepon]"
                                                value="{{ $nh['telepon'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control"
                                                name="narahubung[{{ $index }}][email]"
                                                value="{{ $nh['email'] ?? '' }}" required>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="addNarahubung()">
                            <i class="mdi mdi-plus-circle-outline me-1"></i>Tambah Narahubung
                        </button>
                    </div>
                </div>

            </div>

            {{-- ═══════════════════════════════════════════════════════════════
                 KOLOM KANAN
            ════════════════════════════════════════════════════════════════════ --}}
            <div class="col-lg-4">

                {{-- Status --}}
                <div class="card grid-margin">
                    <div class="card-header d-flex align-items-center">
                        <i class="mdi mdi-cog me-2 text-primary" style="font-size:1.25rem;"></i>
                        <h4 class="card-title mb-0">Status</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="pending"
                                    {{ old('status', $peserta->status) == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="confirmed"
                                    {{ old('status', $peserta->status) == 'confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="cancelled"
                                    {{ old('status', $peserta->status) == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-semibold">Catatan</label>
                            <textarea name="catatan" rows="3" class="form-control">{{ old('catatan', $peserta->catatan) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Aksi --}}
                <div class="card grid-margin">
                    <div class="card-body d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save-outline me-1"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.dashboard.show', $peserta->id) }}" class="btn btn-outline-secondary">
                            <i class="mdi mdi-close me-1"></i>Batal
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </form>

    {{-- NARAHUBUNG TEMPLATE --}}
    <template id="narahubungTemplate">
        <div class="narahubung-row border rounded p-3 mb-3" data-index="__INDEX__">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="fw-semibold nh-number">Narahubung __NUMBER__</span>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeNarahubung(this)">
                    <i class="mdi mdi-trash-can-outline"></i> Hapus
                </button>
            </div>
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="narahubung[__INDEX__][nama]" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Telepon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="narahubung[__INDEX__][telepon]" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="narahubung[__INDEX__][email]" required>
                </div>
            </div>
        </div>
    </template>

    <script>
        /* Wajibkan ukuran baju hanya jika nama terkait diisi */
        function toggleRequired(nameFieldId, sizeFieldName) {
            const nameEl = document.getElementById(nameFieldId);
            const sizeEl = document.querySelector(`[name="${sizeFieldName}"]`);
            if (!nameEl || !sizeEl) return;
            sizeEl.required = nameEl.value.trim() !== '';
        }
        document.addEventListener('DOMContentLoaded', () => {
            toggleRequired('nama_pasangan_kepala_daerah', 'ukuran_baju_pasangan');
            toggleRequired('nama_wakil_kepala_daerah', 'ukuran_baju_wakil');
            toggleRequired('nama_pasangan_wakil_kepala_daerah', 'ukuran_baju_pasangan_wakil');
        });

        /* Narahubung dinamis */
        function renumberNarahubung() {
            const rows = document.querySelectorAll('#narahubungContainer .narahubung-row');
            rows.forEach((row, idx) => {
                row.setAttribute('data-index', idx);
                row.querySelector('.nh-number').textContent = 'Narahubung ' + (idx + 1);
                row.querySelectorAll('[name^="narahubung["]').forEach(inp => {
                    inp.setAttribute('name', inp.getAttribute('name').replace(/narahubung\[\d+\]/,
                        `narahubung[${idx}]`));
                });
            });
            document.querySelectorAll('#narahubungContainer .btn-outline-danger').forEach(btn => {
                btn.disabled = rows.length <= 1;
            });
        }

        function addNarahubung() {
            const tpl = document.getElementById('narahubungTemplate');
            const idx = document.querySelectorAll('#narahubungContainer .narahubung-row').length;
            const wrapper = document.createElement('div');
            wrapper.innerHTML = tpl.innerHTML.replace(/__INDEX__/g, idx).replace(/__NUMBER__/g, idx + 1);
            document.getElementById('narahubungContainer').appendChild(wrapper.firstElementChild);
            renumberNarahubung();
        }

        function removeNarahubung(btn) {
            if (document.querySelectorAll('#narahubungContainer .narahubung-row').length <= 1) return;
            if (confirm('Hapus narahubung ini?')) {
                btn.closest('.narahubung-row').remove();
                renumberNarahubung();
            }
        }
        renumberNarahubung();
    </script>

@endsection
