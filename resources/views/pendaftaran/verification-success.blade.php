@extends('layouts.main')

@section('title', 'Verifikasi Berhasil')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 80px;"></i>
                        </div>

                        <h1 class="mb-3">Email Berhasil Diverifikasi! 🎉</h1>
                        <p class="lead text-muted mb-4">
                            Selamat datang, <strong>{{ $peserta->nama_lengkap }}</strong>
                        </p>

                        <div class="alert alert-success" role="alert">
                            <h5 class="alert-heading">
                                <i class="bi bi-envelope-check me-2"></i>
                                ID Card Telah Dikirim ke Email Anda
                            </h5>
                            <hr>
                            <p class="mb-0">
                                Kami telah mengirimkan ID Card resmi Rakernas XII JKPI 2026 ke alamat email Anda.
                                Silakan cek inbox atau folder spam Anda.
                            </p>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h5 class="card-title">📋 Informasi Pendaftaran</h5>
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <td class="text-end"><strong>Kode Registrasi:</strong></td>
                                        <td class="text-start">
                                            <span class="badge bg-primary">{{ $peserta->kode_registrasi }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-end"><strong>Email:</strong></td>
                                        <td class="text-start">{{ $peserta->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end"><strong>Status:</strong></td>
                                        <td class="text-start">
                                            <span class="badge bg-success">Terverifikasi</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <h6><i class="bi bi-exclamation-triangle me-2"></i>Yang Perlu Anda Lakukan:</h6>
                            <ul class="text-start mb-0">
                                <li>Cek email Anda untuk mendapatkan ID Card</li>
                                <li>Unduh dan cetak ID Card (ukuran B3: 95mm × 126mm)</li>
                                <li>Bawa ID Card tercetak saat registrasi ulang</li>
                                <li>Simpan email konfirmasi sebagai bukti pendaftaran</li>
                            </ul>
                        </div>

                        <a href="{{ url('/') }}" class="btn btn-primary btn-lg mt-3">
                            <i class="bi bi-house-door me-2"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
