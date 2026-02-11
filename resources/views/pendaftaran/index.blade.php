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

        .badge-status {
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: 12px;
            margin-left: 5px;
        }

        .badge-anggota {
            background-color: #28a745;
            color: white;
        }

        .badge-peninjau {
            background-color: #ffc107;
            color: #333;
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
                    <p>Rakernas JKPI XII 2026 - Kota Ternate</p>
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
                            <label for="jabatan" class="form-label">Jabatan <span class="required">*</span></label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan"
                                name="jabatan" value="{{ old('jabatan') }}" required>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="instansi_organisasi" class="form-label">Instansi/Organisasi <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control @error('instansi_organisasi') is-invalid @enderror"
                                id="instansi_organisasi" name="instansi_organisasi" value="{{ old('instansi_organisasi') }}"
                                required>
                            @error('instansi_organisasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="kota_kabupaten" class="form-label">Kota/Kabupaten <span
                                    class="required">*</span></label>
                            <select class="form-select @error('kota_kabupaten') is-invalid @enderror" id="kota_kabupaten"
                                name="kota_kabupaten" required>
                                <option value="">Pilih Kota/Kabupaten</option>
                                <optgroup label="Anggota JKPI">
                                    <option value="Kota Ambon"
                                        {{ old('kota_kabupaten') == 'Kota Ambon' ? 'selected' : '' }}>Kota Ambon</option>
                                    <option value="Kota Banda Aceh"
                                        {{ old('kota_kabupaten') == 'Kota Banda Aceh' ? 'selected' : '' }}>Kota Banda Aceh
                                    </option>
                                    <option value="Kota Bengkulu"
                                        {{ old('kota_kabupaten') == 'Kota Bengkulu' ? 'selected' : '' }}>Kota Bengkulu
                                    </option>
                                    <option value="Kota Bukittinggi"
                                        {{ old('kota_kabupaten') == 'Kota Bukittinggi' ? 'selected' : '' }}>Kota
                                        Bukittinggi</option>
                                    <option value="Kota Baubau"
                                        {{ old('kota_kabupaten') == 'Kota Baubau' ? 'selected' : '' }}>Kota Baubau</option>
                                    <option value="Kota Blitar"
                                        {{ old('kota_kabupaten') == 'Kota Blitar' ? 'selected' : '' }}>Kota Blitar</option>
                                    <option value="Kota Banjarmasin"
                                        {{ old('kota_kabupaten') == 'Kota Banjarmasin' ? 'selected' : '' }}>Kota
                                        Banjarmasin</option>
                                    <option value="Kota Bontang"
                                        {{ old('kota_kabupaten') == 'Kota Bontang' ? 'selected' : '' }}>Kota Bontang
                                    </option>
                                    <option value="Kota Bogor"
                                        {{ old('kota_kabupaten') == 'Kota Bogor' ? 'selected' : '' }}>Kota Bogor</option>
                                    <option value="Kab. Bangka Barat"
                                        {{ old('kota_kabupaten') == 'Kab. Bangka Barat' ? 'selected' : '' }}>Kab. Bangka
                                        Barat</option>
                                    <option value="Kab. Bangli"
                                        {{ old('kota_kabupaten') == 'Kab. Bangli' ? 'selected' : '' }}>Kab. Bangli</option>
                                    <option value="Kab. Buleleng"
                                        {{ old('kota_kabupaten') == 'Kab. Buleleng' ? 'selected' : '' }}>Kab. Buleleng
                                    </option>
                                    <option value="Kab. Brebes"
                                        {{ old('kota_kabupaten') == 'Kab. Brebes' ? 'selected' : '' }}>Kab. Brebes</option>
                                    <option value="Kab. Banjar Negara"
                                        {{ old('kota_kabupaten') == 'Kab. Banjar Negara' ? 'selected' : '' }}>Kab. Banjar
                                        Negara</option>
                                    <option value="Kab. Banyumas"
                                        {{ old('kota_kabupaten') == 'Kab. Banyumas' ? 'selected' : '' }}>Kab. Banyumas
                                    </option>
                                    <option value="Kab. Batang"
                                        {{ old('kota_kabupaten') == 'Kab. Batang' ? 'selected' : '' }}>Kab. Batang</option>
                                    <option value="Kota Cirebon"
                                        {{ old('kota_kabupaten') == 'Kota Cirebon' ? 'selected' : '' }}>Kota Cirebon
                                    </option>
                                    <option value="Kab. Cilacap"
                                        {{ old('kota_kabupaten') == 'Kab. Cilacap' ? 'selected' : '' }}>Kab. Cilacap
                                    </option>
                                    <option value="Kota Jakarta Pusat"
                                        {{ old('kota_kabupaten') == 'Kota Jakarta Pusat' ? 'selected' : '' }}>Kota Jakarta
                                        Pusat</option>
                                    <option value="Kota Lubuk Linggau"
                                        {{ old('kota_kabupaten') == 'Kota Lubuk Linggau' ? 'selected' : '' }}>Kota Lubuk
                                        Linggau</option>
                                    <option value="Kota Langsa"
                                        {{ old('kota_kabupaten') == 'Kota Langsa' ? 'selected' : '' }}>Kota Langsa</option>
                                    <option value="Kab. Kepulauan Seribu"
                                        {{ old('kota_kabupaten') == 'Kab. Kepulauan Seribu' ? 'selected' : '' }}>Kab.
                                        Kepulauan Seribu</option>
                                    <option value="Kab. Karang Asem"
                                        {{ old('kota_kabupaten') == 'Kab. Karang Asem' ? 'selected' : '' }}>Kab. Karang
                                        Asem</option>
                                    <option value="Kota Medan"
                                        {{ old('kota_kabupaten') == 'Kota Medan' ? 'selected' : '' }}>Kota Medan</option>
                                    <option value="Kota Madiun"
                                        {{ old('kota_kabupaten') == 'Kota Madiun' ? 'selected' : '' }}>Kota Madiun</option>
                                    <option value="Kota Malang"
                                        {{ old('kota_kabupaten') == 'Kota Malang' ? 'selected' : '' }}>Kota Malang</option>
                                    <option value="Kota Palembang"
                                        {{ old('kota_kabupaten') == 'Kota Palembang' ? 'selected' : '' }}>Kota Palembang
                                    </option>
                                    <option value="Kota Pangkal Pinang"
                                        {{ old('kota_kabupaten') == 'Kota Pangkal Pinang' ? 'selected' : '' }}>Kota Pangkal
                                        Pinang</option>
                                    <option value="Kab. Pulang Pisau"
                                        {{ old('kota_kabupaten') == 'Kab. Pulang Pisau' ? 'selected' : '' }}>Kab. Pulang
                                        Pisau</option>
                                    <option value="Kota Pekalongan"
                                        {{ old('kota_kabupaten') == 'Kota Pekalongan' ? 'selected' : '' }}>Kota Pekalongan
                                    </option>
                                    <option value="Kota Padang"
                                        {{ old('kota_kabupaten') == 'Kota Padang' ? 'selected' : '' }}>Kota Padang</option>
                                    <option value="Kota Palopo"
                                        {{ old('kota_kabupaten') == 'Kota Palopo' ? 'selected' : '' }}>Kota Palopo</option>
                                    <option value="Kota Pontianak"
                                        {{ old('kota_kabupaten') == 'Kota Pontianak' ? 'selected' : '' }}>Kota Pontianak
                                    </option>
                                    <option value="Kab. Purbalingga"
                                        {{ old('kota_kabupaten') == 'Kab. Purbalingga' ? 'selected' : '' }}>Kab.
                                        Purbalingga</option>
                                    <option value="Kota Sawahlunto"
                                        {{ old('kota_kabupaten') == 'Kota Sawahlunto' ? 'selected' : '' }}>Kota Sawahlunto
                                    </option>
                                    <option value="Kota Semarang"
                                        {{ old('kota_kabupaten') == 'Kota Semarang' ? 'selected' : '' }}>Kota Semarang
                                    </option>
                                    <option value="Kota Surakarta"
                                        {{ old('kota_kabupaten') == 'Kota Surakarta' ? 'selected' : '' }}>Kota Surakarta
                                    </option>
                                    <option value="Kota Ternate"
                                        {{ old('kota_kabupaten') == 'Kota Ternate' ? 'selected' : '' }}>Kota Ternate
                                    </option>
                                    <option value="Kota Tegal"
                                        {{ old('kota_kabupaten') == 'Kota Tegal' ? 'selected' : '' }}>Kota Tegal</option>
                                    <option value="Kab. Tegal"
                                        {{ old('kota_kabupaten') == 'Kab. Tegal' ? 'selected' : '' }}>Kab. Tegal</option>
                                    <option value="Kota Yogyakarta"
                                        {{ old('kota_kabupaten') == 'Kota Yogyakarta' ? 'selected' : '' }}>Kota Yogyakarta
                                    </option>
                                    <option value="Kota Sungai Penuh"
                                        {{ old('kota_kabupaten') == 'Kota Sungai Penuh' ? 'selected' : '' }}>Kota Sungai
                                        Penuh</option>
                                    <option value="Kab. Ngawi"
                                        {{ old('kota_kabupaten') == 'Kab. Ngawi' ? 'selected' : '' }}>Kab. Ngawi</option>
                                    <option value="Kota Tidore"
                                        {{ old('kota_kabupaten') == 'Kota Tidore' ? 'selected' : '' }}>Kota Tidore</option>
                                    <option value="Kota Tangerang"
                                        {{ old('kota_kabupaten') == 'Kota Tangerang' ? 'selected' : '' }}>Kota Tangerang
                                    </option>
                                    <option value="Kota Kupang"
                                        {{ old('kota_kabupaten') == 'Kota Kupang' ? 'selected' : '' }}>Kota Kupang</option>
                                    <option value="Kab. Temanggung"
                                        {{ old('kota_kabupaten') == 'Kab. Temanggung' ? 'selected' : '' }}>Kab. Temanggung
                                    </option>
                                    <option value="Kota Sabang"
                                        {{ old('kota_kabupaten') == 'Kota Sabang' ? 'selected' : '' }}>Kota Sabang</option>
                                    <option value="Kab. Halmahera Barat"
                                        {{ old('kota_kabupaten') == 'Kab. Halmahera Barat' ? 'selected' : '' }}>Kab.
                                        Halmahera Barat</option>
                                    <option value="Kab. Siak"
                                        {{ old('kota_kabupaten') == 'Kab. Siak' ? 'selected' : '' }}>Kab. Siak</option>
                                    <option value="Kab. Pesawaran"
                                        {{ old('kota_kabupaten') == 'Kab. Pesawaran' ? 'selected' : '' }}>Kab. Pesawaran
                                    </option>
                                    <option value="Kota Probolinggo"
                                        {{ old('kota_kabupaten') == 'Kota Probolinggo' ? 'selected' : '' }}>Kota
                                        Probolinggo</option>
                                    <option value="Kab. Buton Utara"
                                        {{ old('kota_kabupaten') == 'Kab. Buton Utara' ? 'selected' : '' }}>Kab. Buton
                                        Utara</option>
                                    <option value="Kab. Kutai Kartanegara"
                                        {{ old('kota_kabupaten') == 'Kab. Kutai Kartanegara' ? 'selected' : '' }}>Kab.
                                        Kutai Kartanegara</option>
                                    <option value="Kab. Muna"
                                        {{ old('kota_kabupaten') == 'Kab. Muna' ? 'selected' : '' }}>Kab. Muna</option>
                                    <option value="Kota Denpasar"
                                        {{ old('kota_kabupaten') == 'Kota Denpasar' ? 'selected' : '' }}>Kota Denpasar
                                    </option>
                                    <option value="Kota Sibolga"
                                        {{ old('kota_kabupaten') == 'Kota Sibolga' ? 'selected' : '' }}>Kota Sibolga
                                    </option>
                                    <option value="Kab. Sambas"
                                        {{ old('kota_kabupaten') == 'Kab. Sambas' ? 'selected' : '' }}>Kab. Sambas</option>
                                    <option value="Kab. Gianyar"
                                        {{ old('kota_kabupaten') == 'Kab. Gianyar' ? 'selected' : '' }}>Kab. Gianyar
                                    </option>
                                    <option value="Kota Jakarta Barat"
                                        {{ old('kota_kabupaten') == 'Kota Jakarta Barat' ? 'selected' : '' }}>Kota Jakarta
                                        Barat</option>
                                    <option value="Kota Jakarta Utara"
                                        {{ old('kota_kabupaten') == 'Kota Jakarta Utara' ? 'selected' : '' }}>Kota Jakarta
                                        Utara</option>
                                    <option value="Kota Salatiga"
                                        {{ old('kota_kabupaten') == 'Kota Salatiga' ? 'selected' : '' }}>Kota Salatiga
                                    </option>
                                    <option value="Kota Surabaya"
                                        {{ old('kota_kabupaten') == 'Kota Surabaya' ? 'selected' : '' }}>Kota Surabaya
                                    </option>
                                    <option value="Kota Singkawang"
                                        {{ old('kota_kabupaten') == 'Kota Singkawang' ? 'selected' : '' }}>Kota Singkawang
                                    </option>
                                    <option value="Kab. Sumbawa"
                                        {{ old('kota_kabupaten') == 'Kab. Sumbawa' ? 'selected' : '' }}>Kab. Sumbawa
                                    </option>
                                    <option value="Kab. Belitung Timur"
                                        {{ old('kota_kabupaten') == 'Kab. Belitung Timur' ? 'selected' : '' }}>Kab.
                                        Belitung Timur</option>
                                    <option value="Kota Pasuruan"
                                        {{ old('kota_kabupaten') == 'Kota Pasuruan' ? 'selected' : '' }}>Kota Pasuruan
                                    </option>
                                    <option value="Kab. Sumba Timur"
                                        {{ old('kota_kabupaten') == 'Kab. Sumba Timur' ? 'selected' : '' }}>Kab. Sumba
                                        Timur</option>
                                    <option value="Kab. Flores Timur"
                                        {{ old('kota_kabupaten') == 'Kab. Flores Timur' ? 'selected' : '' }}>Kab. Flores
                                        Timur</option>
                                    <option value="Kab. Sumenep"
                                        {{ old('kota_kabupaten') == 'Kab. Sumenep' ? 'selected' : '' }}>Kab. Sumenep
                                    </option>
                                    <option value="Kab. Nias Selatan"
                                        {{ old('kota_kabupaten') == 'Kab. Nias Selatan' ? 'selected' : '' }}>Kab. Nias
                                        Selatan</option>
                                    <option value="Kab. Jepara"
                                        {{ old('kota_kabupaten') == 'Kab. Jepara' ? 'selected' : '' }}>Kab. Jepara</option>
                                    <option value="Kab. Buton Selatan"
                                        {{ old('kota_kabupaten') == 'Kab. Buton Selatan' ? 'selected' : '' }}>Kab. Buton
                                        Selatan</option>
                                    <option value="Kab. Ende"
                                        {{ old('kota_kabupaten') == 'Kab. Ende' ? 'selected' : '' }}>Kab. Ende</option>
                                    <option value="Kota Kediri"
                                        {{ old('kota_kabupaten') == 'Kota Kediri' ? 'selected' : '' }}>Kota Kediri</option>
                                    <option value="Kota Bandung"
                                        {{ old('kota_kabupaten') == 'Kota Bandung' ? 'selected' : '' }}>Kota Bandung
                                    </option>
                                    <option value="Kota Magelang"
                                        {{ old('kota_kabupaten') == 'Kota Magelang' ? 'selected' : '' }}>Kota Magelang
                                    </option>
                                    <option value="Kab. Lombok Utara"
                                        {{ old('kota_kabupaten') == 'Kab. Lombok Utara' ? 'selected' : '' }}>Kab. Lombok
                                        Utara</option>
                                    <option value="Kab. Sleman"
                                        {{ old('kota_kabupaten') == 'Kab. Sleman' ? 'selected' : '' }}>Kab. Sleman</option>
                                </optgroup>
                                {{-- <optgroup label="Peninjau">
                                    <option value="Kab. Tranggalek"
                                        {{ old('kota_kabupaten') == 'Kab. Tranggalek' ? 'selected' : '' }}>Kab. Tranggalek
                                    </option>

                                    <option value="Kab. Bojonegoro"
                                        {{ old('kota_kabupaten') == 'Kab. Bojonegoro' ? 'selected' : '' }}>Kab. Bojonegoro
                                    </option>
                                </optgroup> --}}
                            </select>
                            @error('kota_kabupaten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Informasi Kontak -->
                    <h3 class="form-section-title"><i class="bi bi-telephone-fill me-2"></i>Informasi Kontak</h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nomor_telepon" class="form-label">
                                Nomor Telepon <span class="required">*</span>
                                <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right"
                                    title="Gunakan nomor WhatsApp yang aktif untuk menerima pemberitahuan"></i>
                            </label>
                            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                placeholder="08xxxxxxxxxx" required>
                            @error('nomor_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                Email <span class="required">*</span>
                                <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right"
                                    title="Gunakan email yang aktif untuk verifikasi dan notifikasi"></i>
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}" required>
                            <div class="form-text">Email akan digunakan untuk verifikasi</div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- Upload Foto Profil -->
                    <h3 class="form-section-title"><i class="bi bi-camera-fill me-2"></i>Upload Foto Profil</h3>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="foto" class="form-label">Foto Profil <span
                                    class="text-muted">(Opsional)</span></label>
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
                    </div>


                    <!-- Perjalanan dan Akomodasi -->
                    <h3 class="form-section-title"><i class="bi bi-airplane-fill me-2"></i>Perjalanan dan Akomodasi</h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_kedatangan" class="form-label">Tanggal Kedatangan <span
                                    class="required">*</span></label>
                            <input type="date" class="form-control @error('tanggal_kedatangan') is-invalid @enderror"
                                id="tanggal_kedatangan" name="tanggal_kedatangan"
                                value="{{ old('tanggal_kedatangan') }}" required>
                            @error('tanggal_kedatangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_kepulangan" class="form-label">Tanggal Kepulangan <span
                                    class="required">*</span></label>
                            <input type="date" class="form-control @error('tanggal_kepulangan') is-invalid @enderror"
                                id="tanggal_kepulangan" name="tanggal_kepulangan"
                                value="{{ old('tanggal_kepulangan') }}" required>
                            @error('tanggal_kepulangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="akomodasi_hotel" class="form-label">Hotel Pilihan / Detail Akomodasi</label>
                        <textarea class="form-control @error('akomodasi_hotel') is-invalid @enderror" id="akomodasi_hotel"
                            name="akomodasi_hotel" rows="3"
                            placeholder="Contoh: Hotel Grand Ternate, atau sebutkan jika tidak membutuhkan akomodasi">{{ old('akomodasi_hotel') }}</textarea>
                        <div class="form-text">Sebutkan nama hotel pilihan Anda atau detail akomodasi lainnya. Jika tidak
                            membutuhkan akomodasi, silakan tulis "Tidak membutuhkan akomodasi"</div>
                        @error('akomodasi_hotel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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

        // Validasi nomor telepon
        document.getElementById('nomor_telepon').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });

        // Set minimum date untuk tanggal kedatangan (hari ini)
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal_kedatangan').setAttribute('min', today);

        // Update minimum date untuk tanggal kepulangan berdasarkan tanggal kedatangan
        document.getElementById('tanggal_kedatangan').addEventListener('change', function() {
            const kedatangan = this.value;
            document.getElementById('tanggal_kepulangan').setAttribute('min', kedatangan);
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endpush
