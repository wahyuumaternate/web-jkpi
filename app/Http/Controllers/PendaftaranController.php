<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Http\Requests\PendaftaranPesertaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan halaman form pendaftaran
     */
    public function index()
    {
        return view('pendaftaran.index');
    }

    /**
     * Proses pendaftaran peserta + narahubung + kegiatan (dalam satu transaction)
     */
    // public function store(PendaftaranPesertaRequest $request)
    // {
    //     try {
    //         $data = $request->validated();
    //         // Resolve nama daerah manual jika pilih "Lainnya"
    //         if (($data['nama_daerah'] ?? '') === '__lainnya__') {
    //             $data['nama_daerah'] = trim($data['nama_daerah_lainnya'] ?? '');
    //         }
    //         // Buang field sementara agar tidak masuk ke Eloquent
    //         unset($data['nama_daerah_lainnya']);
    //         // Pisahkan relasi dari data peserta
    //         $narahubungData = $data['narahubung'] ?? [];
    //         $kegiatanData = $data['kegiatan'] ?? [];
    //         unset($data['narahubung'], $data['kegiatan']);

    //         // Default status
    //         $data['status'] = 'pending';

    //         $peserta = DB::transaction(function () use ($data, $narahubungData, $kegiatanData) {
    //             // 1. Buat peserta
    //             $peserta = Peserta::create($data);

    //             // 2. Simpan semua narahubung
    //             foreach ($narahubungData as $nh) {
    //                 $peserta->narahubung()->create([
    //                     'nama' => $nh['nama'],
    //                     'telepon' => $nh['telepon'],
    //                     'email' => $nh['email'],
    //                 ]);
    //             }

    //             // 3. Simpan kegiatan yang dipilih (deduplicate untuk jaga-jaga)
    //             foreach (array_unique($kegiatanData) as $namaKegiatan) {
    //                 $peserta->kegiatan()->create([
    //                     'nama_kegiatan' => $namaKegiatan,
    //                 ]);
    //             }

    //             return $peserta;
    //         });

    //         return redirect()->route('pendaftaran.success')->with('success', 'Pendaftaran berhasil disimpan.')->with('kode_registrasi', $peserta->kode_registrasi);
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         Log::error('Database error saat pendaftaran: ' . $e->getMessage());

    //         return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan database saat menyimpan data.');
    //     } catch (\Exception $e) {
    //         Log::error('Error saat pendaftaran: ' . $e->getMessage());

    //         return redirect()
    //             ->back()
    //             ->withInput()
    //             ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }

    /**
     * Tampilkan halaman sukses pendaftaran
     */
    public function success()
    {
        if (!session()->has('kode_registrasi')) {
            return redirect()->route('pendaftaran.index');
        }

        return view('pendaftaran.success');
    }

    /**
     * Cek status pendaftaran berdasarkan kode registrasi
     */
    public function checkStatus(Request $request)
    {
        $request->validate([
            'kode_registrasi' => 'required|string',
        ]);

        $peserta = Peserta::with(['narahubung', 'kegiatan'])
            ->where('kode_registrasi', $request->kode_registrasi)
            ->first();

        if (!$peserta) {
            return back()->with('error', 'Kode registrasi tidak ditemukan.');
        }

        return view('pendaftaran.status', compact('peserta'));
    }
}
