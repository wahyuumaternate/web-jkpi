<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendaftaranPesertaRequest;
use App\Models\Peserta as PendaftaranPeserta;
use App\Exports\PesertaCategoryMultiSheetExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DashboardController extends Controller
{
    // ─── Web ──────────────────────────────────────────────────────────────────
    public function edit($id)
    {
        $peserta = PendaftaranPeserta::with(['narahubung', 'kegiatan'])->findOrFail($id);

        return view('admin.dashboard.edit', [
            'peserta' => $peserta,
            'isEdit' => true,
        ]);
    }

    public function update(PendaftaranPesertaRequest $request, $id)
    {
        $peserta = PendaftaranPeserta::findOrFail($id);
        $validated = $request->validated();

        $peserta->update([
            'nama_daerah' => $validated['nama_daerah'] === '__lainnya__' ? $validated['nama_daerah_lainnya'] : $validated['nama_daerah'],
            'nama_kepala_daerah' => $validated['nama_kepala_daerah'],
            'nama_pasangan_kepala_daerah' => $validated['nama_pasangan_kepala_daerah'] ?? null,
            'nama_wakil_kepala_daerah' => $validated['nama_wakil_kepala_daerah'] ?? null,
            'nama_pasangan_wakil_kepala_daerah' => $validated['nama_pasangan_wakil_kepala_daerah'] ?? null,
            'ukuran_baju' => $validated['ukuran_baju'],
            'ukuran_baju_pasangan' => $validated['ukuran_baju_pasangan'] ?? null,
            'ukuran_peci' => $validated['ukuran_peci'] ?? null,
            'ukuran_baju_wakil' => $validated['ukuran_baju_wakil'] ?? null,
            'ukuran_baju_pasangan_wakil' => $validated['ukuran_baju_pasangan_wakil'] ?? null,
            'ukuran_peci_wakil' => $validated['ukuran_peci_wakil'] ?? null,
            'jumlah_rombongan' => $validated['jumlah_rombongan'],
            'nomor_plat' => $validated['nomor_plat'] ?? null,
            'info_kedatangan' => $validated['info_kedatangan'],
            'info_kepulangan' => $validated['info_kepulangan'],
            'nama_ajudan' => $validated['nama_ajudan'] ?? null,
            'telepon_ajudan' => $validated['telepon_ajudan'] ?? null,
        ]);

        // Sinkronkan kegiatan: hapus lama, simpan ulang yang dipilih
        $peserta->kegiatan()->delete();
        foreach ($validated['kegiatan'] ?? [] as $namaKegiatan) {
            $peserta->kegiatan()->create(['nama_kegiatan' => $namaKegiatan]);
        }

        // Sinkronkan narahubung: hapus lama, simpan ulang
        $peserta->narahubung()->delete();
        foreach ($validated['narahubung'] as $nh) {
            $peserta->narahubung()->create($nh);
        }

        return redirect()->route('admin.dashboard.show', $peserta->id)->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function index(Request $request)
    {
        $query = PendaftaranPeserta::with(['narahubung', 'kegiatan']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_daerah', 'like', "%{$search}%")
                    ->orWhere('nama_kepala_daerah', 'like', "%{$search}%")
                    ->orWhere('kode_registrasi', 'like', "%{$search}%")
                    ->orWhere('nama_ajudan', 'like', "%{$search}%")
                    ->orWhereHas('narahubung', function ($q2) use ($search) {
                        $q2->where('nama', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peserta = $query->latest()->paginate(20)->withQueryString();

        $stats = [
            'total' => PendaftaranPeserta::count(),
            'confirmed' => PendaftaranPeserta::where('status', 'confirmed')->count(),
            'pending' => PendaftaranPeserta::where('status', 'pending')->count(),
            'cancelled' => PendaftaranPeserta::where('status', 'cancelled')->count(),
        ];

        return view('admin.dashboard.index', compact('peserta', 'stats'));
    }

    public function show($id)
    {
        // Eager-load kegiatan agar section "Kegiatan Yang Akan Diikuti" terisi
        $peserta = PendaftaranPeserta::with(['narahubung', 'kegiatan'])->findOrFail($id);
        return view('admin.dashboard.show', compact('peserta'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
            'catatan' => 'nullable|string',
        ]);

        $peserta = PendaftaranPeserta::findOrFail($id);
        $peserta->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.dashboard.show', $id)->with('success', 'Status berhasil diupdate!');
    }

    public function destroy($id)
    {
        try {
            PendaftaranPeserta::findOrFail($id)->delete();
            return redirect()->route('admin.dashboard')->with('success', 'Data peserta berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ─── Export entry points ──────────────────────────────────────────────────

    public function exportAll()
    {
        try {
            $filename = 'Data_Peserta_Semua_' . now()->format('d-m-Y_H-i-s') . '.xlsx';
            return Excel::download(new PesertaCategoryMultiSheetExport(null), $filename);
        } catch (\Exception $e) {
            Log::error('Export All Error: ' . $e->getMessage());
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Error export: ' . $e->getMessage());
        }
    }

    public function exportConfirmed()
    {
        try {
            $filename = 'Data_Peserta_Confirmed_' . now()->format('d-m-Y_H-i-s') . '.xlsx';
            return Excel::download(new PesertaCategoryMultiSheetExport('confirmed'), $filename);
        } catch (\Exception $e) {
            Log::error('Export Confirmed Error: ' . $e->getMessage());
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Error export: ' . $e->getMessage());
        }
    }

    public function exportPending()
    {
        try {
            $filename = 'Data_Peserta_Pending_' . now()->format('d-m-Y_H-i-s') . '.xlsx';
            return Excel::download(new PesertaCategoryMultiSheetExport('pending'), $filename);
        } catch (\Exception $e) {
            Log::error('Export Pending Error: ' . $e->getMessage());
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Error export: ' . $e->getMessage());
        }
    }

    public function exportCancelled()
    {
        try {
            $filename = 'Data_Peserta_Cancelled_' . now()->format('d-m-Y_H-i-s') . '.xlsx';
            return Excel::download(new PesertaCategoryMultiSheetExport('cancelled'), $filename);
        } catch (\Exception $e) {
            Log::error('Export Cancelled Error: ' . $e->getMessage());
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Error export: ' . $e->getMessage());
        }
    }

}
