<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Peserta::query();

        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('kode_registrasi', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peserta = $query->latest()->paginate(20)->withQueryString();

        // Statistics
        $stats = [
            'total' => Peserta::count(),
            'verified' => Peserta::where('status', 'verified')->count(),
            'unverified' => Peserta::where('status', 'unverified')->count(),
            'cancelled' => Peserta::where('status', 'cancelled')->count(),
            'email_verified' => Peserta::whereNotNull('email_verified_at')->count(),
            'anggota_jkpi' => Peserta::where('is_anggota_jkpi', true)->count(),
        ];

        return view('admin.dashboard.index', compact('peserta', 'stats'));
    }

    public function show($id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('admin.dashboard.show', compact('peserta'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:verified,unverified,cancelled',
            'catatan' => 'nullable|string',
        ]);

        $peserta = Peserta::findOrFail($id);
        $peserta->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.dashboard.show', $id)->with('success', 'Status berhasil diupdate!');
    }

    public function destroy($id)
    {
        try {
            $peserta = Peserta::findOrFail($id);

            // Delete files
            if ($peserta->foto) {
                Storage::disk('public')->delete($peserta->foto);
            }
            if ($peserta->ktp) {
                Storage::disk('public')->delete($peserta->ktp);
            }

            $peserta->delete();

            return redirect()->route('admin.dashboard')->with('success', 'Data peserta berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // Export Methods
    public function exportAll()
    {
        return $this->exportByStatus(null, 'Semua_Peserta');
    }

    public function exportVerified()
    {
        return $this->exportByStatus('verified', 'Peserta_Verified');
    }

    public function exportUnverified()
    {
        return $this->exportByStatus('unverified', 'Peserta_Unverified');
    }

    public function exportCancelled()
    {
        return $this->exportByStatus('cancelled', 'Peserta_Cancelled');
    }

    private function exportByStatus($status, $filename)
    {
        try {
            $query = Peserta::query();

            if ($status) {
                $query->where('status', $status);
            }

            $data = $query->get();

            Log::info("Export {$filename}: " . ($data->isEmpty() ? 'No data found, generating empty Excel' : "{$data->count()} records"));

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Data Peserta');

            // Header styling
            $headerStyle = [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '099AA7'],
                ],
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 11,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ];

            // Headers
            $headers = [
                'A' => 'No',
                'B' => 'Status',
                'C' => 'Kode Registrasi',
                'D' => 'Nama Lengkap',
                'E' => 'NIK',
                'F' => 'Jenis Kelamin',
                'G' => 'Email',
                'H' => 'Email Verified',
                'I' => 'No. WhatsApp',
                'J' => 'No. Telepon',
                'K' => 'Provinsi',
                'L' => 'Kabupaten/Kota',
                'M' => 'Kecamatan',
                'N' => 'Kelurahan',
                'O' => 'Instansi',
                'P' => 'Jabatan',
                'Q' => 'Bidang',
                'R' => 'Anggota JKPI',
                'S' => 'Akomodasi',
                'T' => 'Kebutuhan Khusus',
                'U' => 'Tanggal Daftar',
                'V' => 'Tanggal Update',
            ];

            $row = 1;
            foreach ($headers as $col => $header) {
                $sheet->setCellValue("{$col}{$row}", $header);
            }
            $sheet->getStyle("A{$row}:V{$row}")->applyFromArray($headerStyle);

            // Data
            $row = 2;
            foreach ($data as $index => $item) {
                $sheet->setCellValue("A{$row}", $index + 1);
                $sheet->setCellValue("B{$row}", strtoupper($item->status));
                $sheet->setCellValue("C{$row}", $item->kode_registrasi);
                $sheet->setCellValue("D{$row}", $item->nama_lengkap);
                $sheet->setCellValueExplicit("E{$row}", $item->nik, DataType::TYPE_STRING);
                $sheet->setCellValue("F{$row}", $item->jenis_kelamin);
                $sheet->setCellValue("G{$row}", $item->email);
                $sheet->setCellValue("H{$row}", $item->email_verified_at ? 'Ya' : 'Tidak');
                $sheet->setCellValue("I{$row}", $item->nomor_wa);
                $sheet->setCellValue("J{$row}", $item->nomor_telepon ?? '-');
                $sheet->setCellValue("K{$row}", $item->provinsi);
                $sheet->setCellValue("L{$row}", $item->kabupaten_kota);
                $sheet->setCellValue("M{$row}", $item->kecamatan ?? '-');
                $sheet->setCellValue("N{$row}", $item->kelurahan ?? '-');
                $sheet->setCellValue("O{$row}", $item->instansi ?? '-');
                $sheet->setCellValue("P{$row}", $item->jabatan ?? '-');
                $sheet->setCellValue("Q{$row}", $item->bidang ?? '-');
                $sheet->setCellValue("R{$row}", $item->is_anggota_jkpi ? 'Ya' : 'Tidak');
                $sheet->setCellValue("S{$row}", $item->akomodasi ?? '-');
                $sheet->setCellValue("T{$row}", $item->kebutuhan_khusus ?? '-');
                $sheet->setCellValue("U{$row}", $item->created_at->format('d/m/Y H:i'));
                $sheet->setCellValue("V{$row}", $item->updated_at->format('d/m/Y H:i'));
                $row++;
            }

            // Footer Recap - FIXED: Gunakan nilai langsung, bukan formula
            if ($data->count() > 0) {
                $row += 2; // Skip 2 rows

                $sheet->setCellValue("A{$row}", 'REKAP DATA');
                $sheet->mergeCells("A{$row}:B{$row}");
                $sheet->getStyle("A{$row}:B{$row}")->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E2E8F0'],
                    ],
                    'font' => ['bold' => true, 'size' => 12],
                ]);

                $row++;

                // Hitung semua nilai SEBELUM memasukkan ke Excel
                $totalPeserta = $data->count();
                $lakiCount = $data->where('jenis_kelamin', 'Laki-laki')->count();
                $perempuanCount = $data->where('jenis_kelamin', 'Perempuan')->count();
                $anggotaCount = $data->where('is_anggota_jkpi', true)->count();
                $akomodasiCount = $data
                    ->filter(function ($item) {
                        return !empty($item->akomodasi) && $item->akomodasi !== '-';
                    })
                    ->count();

                // Total Peserta
                $sheet->setCellValue("A{$row}", 'Total Peserta');
                $sheet->setCellValue("B{$row}", $totalPeserta);
                $row++;

                // Laki-laki
                $sheet->setCellValue("A{$row}", 'Laki-laki');
                $sheet->setCellValue("B{$row}", $lakiCount);
                $row++;

                // Perempuan
                $sheet->setCellValue("A{$row}", 'Perempuan');
                $sheet->setCellValue("B{$row}", $perempuanCount);
                $row++;

                // Anggota JKPI
                $sheet->setCellValue("A{$row}", 'Anggota JKPI');
                $sheet->setCellValue("B{$row}", $anggotaCount);
                $row++;

                // Butuh Akomodasi
                $sheet->setCellValue("A{$row}", 'Butuh Akomodasi');
                $sheet->setCellValue("B{$row}", $akomodasiCount);

                // Style untuk recap
                $recapStartRow = $row - 5;
                $sheet->getStyle("A{$recapStartRow}:B{$row}")->applyFromArray([
                    'font' => ['bold' => true],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC'],
                        ],
                    ],
                ]);
            }

            // Auto size columns
            foreach (range('A', 'V') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // Freeze pane
            $sheet->freezePane('A2');

            // Border all data cells
            if ($data->count() > 0) {
                $lastDataRow = 1 + $data->count();
                $sheet->getStyle("A1:V{$lastDataRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC'],
                        ],
                    ],
                ]);
            }

            // Generate file
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

    public function exportStatistik()
    {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Statistik');

            // Title
            $sheet->setCellValue('A1', 'STATISTIK PESERTA JKPI 2026');
            $sheet->mergeCells('A1:B1');
            $sheet->getStyle('A1')->applyFromArray([
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);

            $row = 3;

            // Total
            $total = Peserta::count();
            $sheet->setCellValue("A{$row}", 'Total Peserta');
            $sheet->setCellValue("B{$row}", $total);
            $row++;

            // By Status
            $sheet->setCellValue("A{$row}", 'Verified');
            $sheet->setCellValue("B{$row}", Peserta::where('status', 'verified')->count());
            $row++;

            $sheet->setCellValue("A{$row}", 'Unverified');
            $sheet->setCellValue("B{$row}", Peserta::where('status', 'unverified')->count());
            $row++;

            $sheet->setCellValue("A{$row}", 'Cancelled');
            $sheet->setCellValue("B{$row}", Peserta::where('status', 'cancelled')->count());
            $row += 2;

            // By Gender
            $sheet->setCellValue("A{$row}", 'Laki-laki');
            $sheet->setCellValue("B{$row}", Peserta::where('jenis_kelamin', 'Laki-laki')->count());
            $row++;

            $sheet->setCellValue("A{$row}", 'Perempuan');
            $sheet->setCellValue("B{$row}", Peserta::where('jenis_kelamin', 'Perempuan')->count());
            $row += 2;

            // Email Verified
            $sheet->setCellValue("A{$row}", 'Email Verified');
            $sheet->setCellValue("B{$row}", Peserta::whereNotNull('email_verified_at')->count());
            $row++;

            // Anggota JKPI
            $sheet->setCellValue("A{$row}", 'Anggota JKPI');
            $sheet->setCellValue("B{$row}", Peserta::where('is_anggota_jkpi', true)->count());

            // Auto size
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);

            // Generate file
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

    public function exportByProvinsi()
    {
        try {
            $spreadsheet = new Spreadsheet();

            // Get all provinces
            $provinces = Peserta::select('provinsi')->distinct()->orderBy('provinsi')->pluck('provinsi');

            foreach ($provinces as $index => $provinsi) {
                if ($index > 0) {
                    $spreadsheet->createSheet();
                }

                $sheet = $spreadsheet->setActiveSheetIndex($index);
                $sheetTitle = substr($provinsi, 0, 31); // Max 31 chars for sheet name
                $sheet->setTitle($sheetTitle);

                // Header
                $headerStyle = [
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '099AA7'],
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                ];

                $headers = ['No', 'Nama', 'Email', 'No. WA', 'Kabupaten/Kota', 'Status'];
                $sheet->fromArray($headers, null, 'A1');
                $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

                // Data
                $data = Peserta::where('provinsi', $provinsi)->get();
                $row = 2;
                foreach ($data as $no => $item) {
                    $sheet->setCellValue("A{$row}", $no + 1);
                    $sheet->setCellValue("B{$row}", $item->nama_lengkap);
                    $sheet->setCellValue("C{$row}", $item->email);
                    $sheet->setCellValue("D{$row}", $item->nomor_wa);
                    $sheet->setCellValue("E{$row}", $item->kabupaten_kota);
                    $sheet->setCellValue("F{$row}", strtoupper($item->status));
                    $row++;
                }

                // Auto size
                foreach (range('A', 'F') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }

            $spreadsheet->setActiveSheetIndex(0);

            // Generate file
            $writer = new Xlsx($spreadsheet);
            $fileName = 'Peserta_By_Provinsi_' . date('Ymd_His') . '.xlsx';
            $tempFile = tempnam(sys_get_temp_dir(), $fileName);
            $writer->save($tempFile);

            return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Export By Provinsi Error: ' . $e->getMessage());
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Error export by provinsi: ' . $e->getMessage());
        }
    }
}
