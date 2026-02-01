@extends('layouts.main')

@section('title', 'Pendaftaran Peserta - Rakernas XII JKPI 2026')

@push('styles')
    <style>
        .registration-section {
            padding: 100px 0 80px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .registration-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 50px;
            margin-bottom: 40px;
        }

        .registration-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .registration-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #099aa7;
            margin-bottom: 10px;
        }

        .registration-header p {
            font-size: 1.1rem;
            color: #666;
        }

        .form-section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #099aa7;
            margin: 30px 0 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #099aa7;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-label .required {
            color: #dc3545;
            margin-left: 3px;
        }

        .form-control,
        .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #099aa7;
            box-shadow: 0 0 0 0.2rem rgba(9, 154, 167, 0.15);
        }

        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .btn-submit {
            background: linear-gradient(135deg, #099aa7 0%, #077b86 100%);
            color: #fff;
            padding: 15px 50px;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(9, 154, 167, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(9, 154, 167, 0.4);
            background: linear-gradient(135deg, #077b86 0%, #099aa7 100%);
        }

        .btn-cancel {
            background: #6c757d;
            color: #fff;
            padding: 15px 50px;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-cancel:hover {
            background: #5a6268;
            transform: translateY(-3px);
        }

        .custom-file-upload {
            border: 2px dashed #099aa7;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #f8f9fa;
        }

        .custom-file-upload:hover {
            background: #e9ecef;
            border-color: #077b86;
        }

        .custom-file-upload i {
            font-size: 2rem;
            color: #099aa7;
            margin-bottom: 10px;
        }

        .file-preview {
            max-width: 200px;
            margin-top: 15px;
            border-radius: 10px;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
        }

        .form-check-input:checked {
            background-color: #099aa7;
            border-color: #099aa7;
        }

        @media (max-width: 768px) {
            .registration-card {
                padding: 30px 20px;
            }

            .registration-header h1 {
                font-size: 2rem;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="registration-section">
        <div class="container">
            <div class="registration-card" data-aos="fade-up">
                <div class="registration-header">
                    <h1><i class="bi bi-pencil-square me-2"></i>Formulir Pendaftaran</h1>
                    <p>Rakernas XII JKPI 2026 - Kota Ternate</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="bi bi-exclamation-triangle me-2"></i>Terdapat kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data"
                    id="registrationForm">
                    @csrf
                    <!-- Data Pribadi -->
                    <h3 class="form-section-title"><i class="bi bi-person-fill me-2"></i>Data Pribadi</h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nik" class="form-label">NIK <span class="required">*</span></label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                name="nik" value="{{ old('nik') }}" maxlength="16" required>
                            <div class="form-text">16 digit nomor NIK</div>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                    class="required">*</span></label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                                name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                    class="required">*</span></label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap <span class="required">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                            required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="provinsi" class="form-label">Provinsi <span class="required">*</span></label>
                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                id="provinsi" name="provinsi" value="{{ old('provinsi') }}" required>
                            @error('provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="kabupaten_kota" class="form-label">Kabupaten/Kota <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control @error('kabupaten_kota') is-invalid @enderror"
                                id="kabupaten_kota" name="kabupaten_kota" value="{{ old('kabupaten_kota') }}" required>
                            @error('kabupaten_kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="kelurahan" class="form-label">Kelurahan/Desa</label>
                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror"
                                id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}">
                            @error('kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror"
                                id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" maxlength="5">
                            @error('kode_pos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Kontak -->
                    <h3 class="form-section-title"><i class="bi bi-telephone-fill me-2"></i>Informasi Kontak</h3>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                placeholder="08xxxxxxxxxx">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="nomor_wa" class="form-label">Nomor WhatsApp <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control @error('nomor_wa') is-invalid @enderror"
                                id="nomor_wa" name="nomor_wa" value="{{ old('nomor_wa') }}" placeholder="08xxxxxxxxxx"
                                required>
                            @error('nomor_wa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="email" class="form-label">Email <span class="required">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}" required>
                            <div class="form-text">Email akan digunakan untuk verifikasi</div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Instansi/Pekerjaan -->
                    <h3 class="form-section-title"><i class="bi bi-briefcase-fill me-2"></i>Informasi Pekerjaan</h3>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="instansi" class="form-label">Instansi/Perusahaan</label>
                            <input type="text" class="form-control @error('instansi') is-invalid @enderror"
                                id="instansi" name="instansi" value="{{ old('instansi') }}">
                            @error('instansi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                id="jabatan" name="jabatan" value="{{ old('jabatan') }}">
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="bidang_pekerjaan" class="form-label">Bidang Pekerjaan</label>
                            <input type="text" class="form-control @error('bidang_pekerjaan') is-invalid @enderror"
                                id="bidang_pekerjaan" name="bidang_pekerjaan" value="{{ old('bidang_pekerjaan') }}">
                            @error('bidang_pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Data Kepesertaan -->
                    <h3 class="form-section-title"><i class="bi bi-people-fill me-2"></i>Data Kepesertaan</h3>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_anggota_jkpi" name="is_anggota_jkpi"
                                value="1" {{ old('is_anggota_jkpi') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_anggota_jkpi">
                                Saya adalah anggota JKPI
                            </label>
                        </div>
                    </div>

                    <!-- Kebutuhan Khusus -->
                    <h3 class="form-section-title"><i class="bi bi-heart-fill me-2"></i>Kebutuhan Khusus</h3>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="butuh_akomodasi" name="butuh_akomodasi"
                                value="1" {{ old('butuh_akomodasi') ? 'checked' : '' }}>
                            <label class="form-check-label" for="butuh_akomodasi">
                                Membutuhkan akomodasi
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kebutuhan_khusus" class="form-label">Kebutuhan Khusus Lainnya</label>
                        <textarea class="form-control @error('kebutuhan_khusus') is-invalid @enderror" id="kebutuhan_khusus"
                            name="kebutuhan_khusus" rows="3" placeholder="Contoh: Diet vegetarian, kursi roda, dll">{{ old('kebutuhan_khusus') }}</textarea>
                        <div class="form-text">Isi jika memiliki kebutuhan khusus seperti diet, disabilitas, dll</div>
                        @error('kebutuhan_khusus')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload Dokumen -->
                    <h3 class="form-section-title"><i class="bi bi-file-earmark-arrow-up-fill me-2"></i>Upload Dokumen
                    </h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="foto" class="form-label">Foto Diri</label>
                            <div class="custom-file-upload" onclick="document.getElementById('foto').click()">
                                <i class="bi bi-camera-fill"></i>
                                <p class="mb-0">Klik untuk upload foto</p>
                                <small class="text-muted">Format: JPG, PNG (Max: 2MB)</small>
                            </div>
                            <input type="file" class="d-none @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/jpeg,image/jpg,image/png"
                                onchange="previewImage(this, 'foto-preview')">
                            <img id="foto-preview" class="file-preview" style="display: none;">
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="ktp" class="form-label">Foto KTP</label>
                            <div class="custom-file-upload" onclick="document.getElementById('ktp').click()">
                                <i class="bi bi-card-image"></i>
                                <p class="mb-0">Klik untuk upload KTP</p>
                                <small class="text-muted">Format: JPG, PNG (Max: 2MB)</small>
                            </div>
                            <input type="file" class="d-none @error('ktp') is-invalid @enderror" id="ktp"
                                name="ktp" accept="image/jpeg,image/jpg,image/png"
                                onchange="previewImage(this, 'ktp-preview')">
                            <img id="ktp-preview" class="file-preview" style="display: none;">
                            @error('ktp')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Persetujuan -->
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agree" required>
                            <label class="form-check-label" for="agree">
                                Saya menyetujui bahwa data yang saya berikan adalah benar dan dapat dipertanggungjawabkan.
                                Saya bersedia mengikuti seluruh rangkaian kegiatan Rakernas XII JKPI 2026.
                                <span class="required">*</span>
                            </label>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="text-center">
                        <button type="button" class="btn btn-cancel me-2"
                            onclick="window.location.href='{{ url('/') }}'">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-submit">
                            <i class="bi bi-check-circle me-2"></i>Daftar Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Preview gambar sebelum upload
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Validasi NIK hanya angka
        document.getElementById('nik').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Validasi nomor telepon dan WA
        ['nomor_telepon', 'nomor_wa'].forEach(function(fieldId) {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener('input', function(e) {
                    this.value = this.value.replace(/[^0-9+]/g, '');
                });
            }
        });

        // Konfirmasi sebelum submit
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            if (!confirm('Pastikan semua data yang Anda masukkan sudah benar. Lanjutkan pendaftaran?')) {
                e.preventDefault();
            }
        });

        // Auto scroll to error
        document.addEventListener('DOMContentLoaded', function() {
            const firstError = document.querySelector('.is-invalid');
            if (firstError) {
                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    </script>
@endpush
