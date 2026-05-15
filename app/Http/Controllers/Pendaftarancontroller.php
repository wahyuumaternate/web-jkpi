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
     * Proses pendaftaran peserta + narahubung (dalam satu transaction)
     */
    public function store(PendaftaranPesertaRequest $request)
    {
        try {
            $data = $request->validated();
            $narahubungData = $data['narahubung'] ?? [];
            unset($data['narahubung']);

            // Default status
            $data['status'] = 'pending';

            $peserta = DB::transaction(function () use ($data, $narahubungData) {
                // Buat peserta
                $peserta = Peserta::create($data);

                // Simpan semua narahubung
                foreach ($narahubungData as $nh) {
                    $peserta->narahubung()->create([
                        'nama' => $nh['nama'],
                        'telepon' => $nh['telepon'],
                        'email' => $nh['email'],
                    ]);
                }

                return $peserta;
            });

            return redirect()->route('pendaftaran.success')->with('success', 'Pendaftaran berhasil disimpan.')->with('kode_registrasi', $peserta->kode_registrasi);
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error saat pendaftaran: ' . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan database saat menyimpan data.');
        } catch (\Exception $e) {
            Log::error('Error saat pendaftaran: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

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

        $peserta = Peserta::with('narahubung')->where('kode_registrasi', $request->kode_registrasi)->first();

        if (!$peserta) {
            return back()->with('error', 'Kode registrasi tidak ditemukan.');
        }

        return view('pendaftaran.status', compact('peserta'));
    }
}
