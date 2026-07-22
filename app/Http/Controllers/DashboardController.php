<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendaftaranPesertaRequest;
use App\Models\Peserta as PendaftaranPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        return $this->exportByStatus(null, 'Semua_Peserta');
    }
    public function exportConfirmed()
    {
        return $this->exportByStatus('confirmed', 'Peserta_Confirmed');
    }
    public function exportPending()
    {
        return $this->exportByStatus('pending', 'Peserta_Pending');
    }
    public function exportCancelled()
    {
        return $this->exportByStatus('cancelled', 'Peserta_Cancelled');
    }

    // ─── exportByStatus (20 kolom: A – T) ────────────────────────────────────

    private function exportByStatus($status, $filename)
    {
        try {
            $query = PendaftaranPeserta::with(['narahubung', 'kegiatan']);
            if ($status) {
                $query->where('status', $status);
            }
            $data = $query->get();

            Log::info("Export {$filename}: {$data->count()} records");

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Data Peserta');

            $headerStyle = [
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '099AA7']],
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ];

            $headers = [
                'A' => 'No',
                'B' => 'Status',
                'C' => 'Kode Registrasi',
                'D' => 'Nama Daerah',
                'E' => 'Nama Kepala Daerah',
                'F' => 'Ukuran Baju KD',
                'G' => 'Nama Pasangan KD',
                'H' => 'Ukuran Baju Pasangan',
                'I' => 'Ukuran Peci KD',
                'J' => 'Nama Wakil Kepala Daerah',
                'K' => 'Nama Pasangan Wakil',
                'L' => 'Ukuran Baju Wakil',
                'M' => 'Ukuran Baju Pasangan Wakil',
                'N' => 'Ukuran Peci Wakil',
                'O' => 'Jumlah Rombongan',
                'P' => 'Nama Ajudan',
                'Q' => 'Telepon Ajudan',
                'R' => 'Nomor Plat',
                'S' => 'Info Kedatangan',
                'T' => 'Info Kepulangan',
                'U' => 'Nama Narahubung',
                'V' => 'Telepon Narahubung',
                'W' => 'Email Narahubung',
                'X' => 'Kegiatan',
                'Y' => 'Catatan',
                'Z' => 'Tanggal Daftar',
            ];

            foreach ($headers as $col => $header) {
                $sheet->setCellValue("{$col}1", $header);
            }
            $sheet->getStyle('A1:Z1')->applyFromArray($headerStyle);

            $row = 2;
            foreach ($data as $index => $item) {
                // Gabungkan semua narahubung dengan separator " | "
                $narahubungNama = $item->narahubung->pluck('nama')->implode(' | ');
                $narahubungTelepon = $item->narahubung->pluck('telepon')->implode(' | ');
                $narahubungEmail = $item->narahubung->pluck('email')->implode(' | ');
                $kegiatan = $item->kegiatan->pluck('nama_kegiatan')->implode(', ');

                $sheet->setCellValue("A{$row}", $index + 1);
                $sheet->setCellValue("B{$row}", strtoupper($item->status));
                $sheet->setCellValue("C{$row}", $item->kode_registrasi);
                $sheet->setCellValue("D{$row}", $item->nama_daerah);
                $sheet->setCellValue("E{$row}", $item->nama_kepala_daerah);
                $sheet->setCellValue("F{$row}", $item->ukuran_baju);
                $sheet->setCellValue("G{$row}", $item->nama_pasangan_kepala_daerah ?? '-');
                $sheet->setCellValue("H{$row}", $item->ukuran_baju_pasangan ?? '-');
                $sheet->setCellValue("I{$row}", $item->ukuran_peci ?? '-');
                $sheet->setCellValue("J{$row}", $item->nama_wakil_kepala_daerah ?? '-');
                $sheet->setCellValue("K{$row}", $item->nama_pasangan_wakil_kepala_daerah ?? '-');
                $sheet->setCellValue("L{$row}", $item->ukuran_baju_wakil ?? '-');
                $sheet->setCellValue("M{$row}", $item->ukuran_baju_pasangan_wakil ?? '-');
                $sheet->setCellValue("N{$row}", $item->ukuran_peci_wakil ?? '-');
                $sheet->setCellValue("O{$row}", $item->jumlah_rombongan);
                $sheet->setCellValue("P{$row}", $item->nama_ajudan ?? '-');
                $sheet->setCellValue("Q{$row}", $item->telepon_ajudan ?? '-');
                $sheet->setCellValue("R{$row}", $item->nomor_plat ?? '-');
                $sheet->setCellValue("S{$row}", $item->info_kedatangan);
                $sheet->setCellValue("T{$row}", $item->info_kepulangan);
                $sheet->setCellValue("U{$row}", $narahubungNama ?: '-');
                $sheet->setCellValue("V{$row}", $narahubungTelepon ?: '-');
                $sheet->setCellValue("W{$row}", $narahubungEmail ?: '-');
                $sheet->setCellValue("X{$row}", $kegiatan ?: '-');
                $sheet->setCellValue("Y{$row}", $item->catatan ?? '-');
                $sheet->setCellValue("Z{$row}", $item->created_at->format('d/m/Y H:i'));
                $row++;
            }

            // Rekap footer
            if ($data->count() > 0) {
                $row += 2;
                $sheet->setCellValue("A{$row}", 'REKAP');
                $sheet->mergeCells("A{$row}:B{$row}");
                $sheet->getStyle("A{$row}:B{$row}")->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E2E8F0']],
                    'font' => ['bold' => true, 'size' => 12],
                ]);
                $row++;
                foreach (['confirmed', 'pending', 'cancelled'] as $s) {
                    $sheet->setCellValue("A{$row}", ucfirst($s));
                    $sheet->setCellValue("B{$row}", $data->where('status', $s)->count());
                    $row++;
                }
            }

            foreach (range('A', 'Z') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }
            $sheet->freezePane('A2');

            if ($data->count() > 0) {
                $sheet->getStyle('A1:Z' . (1 + $data->count()))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC'],
                        ],
                    ],
                ]);
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = $filename . '_' . date('Ymd_His') . '.xlsx';
            $tempFile = tempnam(sys_get_temp_dir(), $fileName);
            $writer->save($tempFile);

            return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error("Export {$filename} Error: " . $e->getMessage());
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Error export: ' . $e->getMessage());
        }
    }

    // ─── exportStatistik (5 seksi) ────────────────────────────────────────────

    public function exportStatistik()
    {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Statistik');

            $sectionStyle = [
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '099AA7']],
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            ];

            $sheet->setCellValue('A1', 'STATISTIK PESERTA JKPI 2026');
            $sheet->mergeCells('A1:B1');
            $sheet->getStyle('A1')->applyFromArray([
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);

            $row = 3;

            // ── 1. Status Pendaftaran ──────────────────────────────────────
            $sheet->setCellValue("A{$row}", 'STATUS PENDAFTARAN');
            $sheet->mergeCells("A{$row}:B{$row}");
            $sheet->getStyle("A{$row}:B{$row}")->applyFromArray($sectionStyle);
            $row++;

            foreach (
                [
                    'Total Peserta' => PendaftaranPeserta::count(),
                    'Confirmed' => PendaftaranPeserta::where('status', 'confirmed')->count(),
                    'Pending' => PendaftaranPeserta::where('status', 'pending')->count(),
                    'Cancelled' => PendaftaranPeserta::where('status', 'cancelled')->count(),
                ]
                as $label => $value
            ) {
                $sheet->setCellValue("A{$row}", $label);
                $sheet->setCellValue("B{$row}", $value);
                $row++;
            }
            $row++;

            // ── 2. Rombongan ──────────────────────────────────────────────
            $sheet->setCellValue("A{$row}", 'ROMBONGAN');
            $sheet->mergeCells("A{$row}:B{$row}");
            $sheet->getStyle("A{$row}:B{$row}")->applyFromArray($sectionStyle);
            $row++;

            foreach (
                [
                    'Total Orang Rombongan' => PendaftaranPeserta::sum('jumlah_rombongan'),
                    'Dengan Pasangan' => PendaftaranPeserta::whereNotNull('nama_pasangan_kepala_daerah')->count(),
                    'Dengan Ajudan' => PendaftaranPeserta::whereNotNull('nama_ajudan')->count(),
                    'Dengan Nomor Plat' => PendaftaranPeserta::whereNotNull('nomor_plat')->count(),
                ]
                as $label => $value
            ) {
                $sheet->setCellValue("A{$row}", $label);
                $sheet->setCellValue("B{$row}", $value);
                $row++;
            }
            $row++;

            // ── 3. Ukuran Baju Kepala Daerah ──────────────────────────────
            $sheet->setCellValue("A{$row}", 'UKURAN BAJU KEPALA DAERAH');
            $sheet->mergeCells("A{$row}:B{$row}");
            $sheet->getStyle("A{$row}:B{$row}")->applyFromArray($sectionStyle);
            $row++;

            $ukuranKd = PendaftaranPeserta::selectRaw('ukuran_baju, COUNT(*) as total')->groupBy('ukuran_baju')->orderByRaw("FIELD(ukuran_baju,'S','M','L','XL','XXL','XXXL')")->get();
            foreach ($ukuranKd as $u) {
                $sheet->setCellValue("A{$row}", $u->ukuran_baju);
                $sheet->setCellValue("B{$row}", $u->total);
                $row++;
            }
            $row++;

            // ── 4. Ukuran Baju Pasangan ───────────────────────────────────
            $sheet->setCellValue("A{$row}", 'UKURAN BAJU PASANGAN');
            $sheet->mergeCells("A{$row}:B{$row}");
            $sheet->getStyle("A{$row}:B{$row}")->applyFromArray($sectionStyle);
            $row++;

            $ukuranPasangan = PendaftaranPeserta::selectRaw('ukuran_baju_pasangan, COUNT(*) as total')->whereNotNull('ukuran_baju_pasangan')->groupBy('ukuran_baju_pasangan')->orderByRaw("FIELD(ukuran_baju_pasangan,'S','M','L','XL','XXL','XXXL')")->get();

            if ($ukuranPasangan->isNotEmpty()) {
                foreach ($ukuranPasangan as $u) {
                    $sheet->setCellValue("A{$row}", $u->ukuran_baju_pasangan);
                    $sheet->setCellValue("B{$row}", $u->total);
                    $row++;
                }
            } else {
                $sheet->setCellValue("A{$row}", '(Tidak ada data)');
                $row++;
            }
            $row++;

            // ── 5. Kegiatan Yang Dipilih ──────────────────────────────────
            $sheet->setCellValue("A{$row}", 'KEGIATAN YANG DIPILIH');
            $sheet->mergeCells("A{$row}:B{$row}");
            $sheet->getStyle("A{$row}:B{$row}")->applyFromArray($sectionStyle);
            $row++;

            $kegiatanStats = DB::table('pendaftaran_kegiatan')->selectRaw('nama_kegiatan, COUNT(*) as total')->groupBy('nama_kegiatan')->orderByDesc('total')->get();

            if ($kegiatanStats->isNotEmpty()) {
                foreach ($kegiatanStats as $k) {
                    $sheet->setCellValue("A{$row}", $k->nama_kegiatan);
                    $sheet->setCellValue("B{$row}", $k->total);
                    $row++;
                }
            } else {
                $sheet->setCellValue("A{$row}", '(Tidak ada data)');
            }

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            $fileName = 'Statistik_' . date('Ymd_His') . '.xlsx';
            $tempFile = tempnam(sys_get_temp_dir(), $fileName);
            $writer->save($tempFile);

            return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Export Statistik Error: ' . $e->getMessage());
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Error export statistik: ' . $e->getMessage());
        }
    }

    // ─── exportByDaerah (13 kolom: A – M) ────────────────────────────────────

    public function exportByDaerah()
    {
        try {
            $spreadsheet = new Spreadsheet();

            $daerahList = PendaftaranPeserta::select('nama_daerah')->distinct()->orderBy('nama_daerah')->pluck('nama_daerah');

            foreach ($daerahList as $index => $daerah) {
                if ($index > 0) {
                    $spreadsheet->createSheet();
                }

                $sheet = $spreadsheet->setActiveSheetIndex($index);
                $sheet->setTitle(substr($daerah, 0, 31));

                $headerStyle = [
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '099AA7']],
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                ];

                $headers = ['No', 'Nama Kepala Daerah', 'Ukuran Baju KD', 'Nama Pasangan KD', 'Ukuran Baju Pasangan', 'Jumlah Rombongan', 'Nama Ajudan', 'Telepon Ajudan', 'Info Kedatangan', 'Info Kepulangan', 'Nomor Plat', 'Kegiatan', 'Status'];
                $sheet->fromArray($headers, null, 'A1');
                $sheet->getStyle('A1:M1')->applyFromArray($headerStyle);

                $data = PendaftaranPeserta::with(['kegiatan'])
                    ->where('nama_daerah', $daerah)
                    ->get();

                $row = 2;
                foreach ($data as $no => $item) {
                    $kegiatan = $item->kegiatan->pluck('nama_kegiatan')->implode(', ');

                    $sheet->setCellValue("A{$row}", $no + 1);
                    $sheet->setCellValue("B{$row}", $item->nama_kepala_daerah);
                    $sheet->setCellValue("C{$row}", $item->ukuran_baju);
                    $sheet->setCellValue("D{$row}", $item->nama_pasangan_kepala_daerah ?? '-');
                    $sheet->setCellValue("E{$row}", $item->ukuran_baju_pasangan ?? '-');
                    $sheet->setCellValue("F{$row}", $item->jumlah_rombongan);
                    $sheet->setCellValue("G{$row}", $item->nama_ajudan ?? '-');
                    $sheet->setCellValue("H{$row}", $item->telepon_ajudan ?? '-');
                    $sheet->setCellValue("I{$row}", $item->info_kedatangan);
                    $sheet->setCellValue("J{$row}", $item->info_kepulangan);
                    $sheet->setCellValue("K{$row}", $item->nomor_plat ?? '-');
                    $sheet->setCellValue("L{$row}", $kegiatan ?: '-');
                    $sheet->setCellValue("M{$row}", strtoupper($item->status));
                    $row++;
                }

                foreach (range('A', 'M') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }

            $spreadsheet->setActiveSheetIndex(0);

            $writer = new Xlsx($spreadsheet);
            $fileName = 'Peserta_By_Daerah_' . date('Ymd_His') . '.xlsx';
            $tempFile = tempnam(sys_get_temp_dir(), $fileName);
            $writer->save($tempFile);

            return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Export By Daerah Error: ' . $e->getMessage());
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Error export by daerah: ' . $e->getMessage());
        }
    }
}
