@extends('layouts.main')

@section('title', 'Verifikasi Gagal')

@section('content')
    <div class="container" style="padding: 100px 0; text-align:center;">
        <h1 style="color: red;">Verifikasi Gagal</h1>
        <p>Link verifikasi tidak valid atau sudah kadaluarsa.</p>
        <a href="{{ url('/') }}">Kembali ke Beranda</a>
    </div>
@endsection
