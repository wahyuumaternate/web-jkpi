<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DashboardController extends Controller
{
    /**
     * Display dashboard dengan data peserta
     */
    public function index(Request $request)
    {
        $query = Peserta::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('kode_registrasi', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        // Statistik
        $stats = [
            'total' => Peserta::count(),
            'verified' => Peserta::where('status', 'verified')->count(),
            'unverified' => Peserta::where('status', 'unverified')->count(),
            'cancelled' => Peserta::where('status', 'cancelled')->count(),
            'email_verified' => Peserta::whereNotNull('email_verified_at')->count(),
            'anggota_jkpi' => Peserta::where('is_anggota_jkpi', true)->count(),
        ];

        // Get data dengan pagination
        $peserta = $query->latest()->paginate(20)->withQueryString();

        return view('admin.dashboard.index', compact('peserta', 'stats'));
    }

    /**
     * Show detail peserta
     */
    public function show($id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('admin.dashboard.show', compact('peserta'));
    }

    /**
     * Update status peserta
     */
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

        return redirect()->back()->with('success', 'Status peserta berhasil diperbarui.');
    }

    /**
     * Delete peserta
     */
    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);

        // Hapus file foto dan KTP jika ada
        if ($peserta->foto) {
            Storage::disk('public')->delete($peserta->foto);
        }
        if ($peserta->ktp) {
            Storage::disk('public')->delete($peserta->ktp);
        }

        $peserta->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data peserta berhasil dihapus.');
    }

    // ==================== EXPORT METHODS ====================

    /**
     * Export ALL data ke Excel
     */
    public function exportAll(Request $request)
    {
        return $this->exportByStatus($request, 'all');
    }

    /**
     * Export VERIFIED ke Excel
     */
    public function exportVerified(Request $request)
    {
        return $this->exportByStatus($request, 'verified');
    }

    /**
     * Export UNVERIFIED ke Excel
     */
    public function exportUnverified(Request $request)
    {
        return $this->exportByStatus($request, 'unverified');
    }

    /**
     * Export CANCELLED ke Excel
     */
    public function exportCancelled(Request $request)
    {
        return $this->exportByStatus($request, 'cancelled');
    }

    /**
     * Main export method - Generate Excel by status
     */
    private function exportByStatus(Request $request, $status)
    {
        $query = Peserta::query();

        // Filter by status
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        // Apply search if any
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('kode_registrasi', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $peserta = $query->orderBy('created_at', 'desc')->get();

        $statusLabel = [
            'all' => 'SEMUA STATUS',
            'verified' => 'VERIFIED',
            'unverified' => 'UNVERIFIED',
            'cancelled' => 'CANCELLED',
        ];

        // Create Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Peserta');

        // Header Info (Rows 1-4)
        $sheet->setCellValue('A1', 'RAKERNAS XII JARINGAN KOTA PUSAKA INDONESIA 2026');
        $sheet->mergeCells('A1:V1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('099AA7');
        $sheet->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getRowDimension(1)->setRowHeight(30);

        $sheet->setCellValue('A2', 'DATA PESERTA');
        $sheet->mergeCells('A2:V2');
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'Status Filter: ' . $statusLabel[$status]);
        $sheet->mergeCells('A3:V3');
        $sheet->getStyle('A3')->getFont()->setBold(true);

        $sheet->setCellValue('A4', 'Tanggal Export: ' . date('d-m-Y H:i:s'));
        $sheet->setCellValue('D4', 'Total Data: ' . $peserta->count() . ' peserta');
        $sheet->getStyle('A4:D4')->getFont()->setBold(true);

        // Column Headers (Row 6)
        $headers = ['NO', 'STATUS', 'KODE REGISTRASI', 'NAMA LENGKAP', 'NIK', 'JENIS KELAMIN', 'EMAIL', 'EMAIL VERIFIED', 'NO. WHATSAPP', 'NO. TELEPON', 'PROVINSI', 'KABUPATEN/KOTA', 'KECAMATAN', 'KELURAHAN', 'INSTANSI', 'JABATAN', 'BIDANG PEKERJAAN', 'ANGGOTA JKPI', 'BUTUH AKOMODASI', 'KEBUTUHAN KHUSUS', 'TANGGAL DAFTAR', 'TANGGAL UPDATE'];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '6', $header);
            $col++;
        }

        // Style Header
        $sheet->getStyle('A6:V6')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '099AA7'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->getRowDimension(6)->setRowHeight(25);

        // Data Rows
        $row = 7;
        $no = 1;
        foreach ($peserta as $p) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, strtoupper($p->status));
            $sheet->setCellValue('C' . $row, $p->kode_registrasi);
            $sheet->setCellValue('D' . $row, $p->nama_lengkap);
            $sheet->setCellValueExplicit('E' . $row, $p->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('F' . $row, $p->jenis_kelamin);
            $sheet->setCellValue('G' . $row, $p->email);
            $sheet->setCellValue('H' . $row, $p->email_verified_at ? 'Ya (' . $p->email_verified_at->format('d-m-Y H:i') . ')' : 'Belum');
            $sheet->setCellValue('I' . $row, $p->nomor_wa);
            $sheet->setCellValue('J' . $row, $p->nomor_telepon ?? '-');
            $sheet->setCellValue('K' . $row, $p->provinsi);
            $sheet->setCellValue('L' . $row, $p->kabupaten_kota);
            $sheet->setCellValue('M' . $row, $p->kecamatan ?? '-');
            $sheet->setCellValue('N' . $row, $p->kelurahan ?? '-');
            $sheet->setCellValue('O' . $row, $p->instansi ?? '-');
            $sheet->setCellValue('P' . $row, $p->jabatan ?? '-');
            $sheet->setCellValue('Q' . $row, $p->bidang_pekerjaan ?? '-');
            $sheet->setCellValue('R' . $row, $p->is_anggota_jkpi ? 'Ya' : 'Tidak');
            $sheet->setCellValue('S' . $row, $p->butuh_akomodasi ? 'Ya' : 'Tidak');
            $sheet->setCellValue('T' . $row, $p->kebutuhan_khusus ?? '-');
            $sheet->setCellValue('U' . $row, $p->created_at->format('d-m-Y H:i:s'));
            $sheet->setCellValue('V' . $row, $p->updated_at->format('d-m-Y H:i:s'));

            $row++;
        }

        // Style Data Rows
        $lastRow = $row - 1;
        if ($lastRow >= 7) {
            $sheet->getStyle('A7:V' . $lastRow)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ]);

            // Center align certain columns
            $centerColumns = ['A', 'B', 'F', 'H', 'R', 'S'];
            foreach ($centerColumns as $col) {
                $sheet
                    ->getStyle($col . '7:' . $col . $lastRow)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        }

        // Footer - Rekap Data
        $row += 2;
        $sheet->setCellValue('A' . $row, '=== REKAP DATA ===');
        $sheet->mergeCells('A' . $row . ':B' . $row);
        $sheet
            ->getStyle('A' . $row)
            ->getFont()
            ->setBold(true);
        $sheet
            ->getStyle('A' . $row)
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('E0E0E0');

        $row++;
        $sheet->setCellValue('A' . $row, 'Total Peserta');
        $sheet->setCellValue('B' . $row, $peserta->count());
        $sheet
            ->getStyle('A' . $row . ':B' . $row)
            ->getFont()
            ->setBold(true);

        $row++;
        $lakiLaki = $peserta->where('jenis_kelamin', 'Laki-laki')->count();
        $sheet->setCellValue('A' . $row, 'Laki-laki');
        $sheet->setCellValue('B' . $row, $lakiLaki);

        $row++;
        $perempuan = $peserta->where('jenis_kelamin', 'Perempuan')->count();
        $sheet->setCellValue('A' . $row, 'Perempuan');
        $sheet->setCellValue('B' . $row, $perempuan);

        $row++;
        $anggotaJKPI = $peserta->where('is_anggota_jkpi', true)->count();
        $sheet->setCellValue('A' . $row, 'Anggota JKPI');
        $sheet->setCellValue('B' . $row, $anggotaJKPI);

        $row++;
        $butuhAkomodasi = $peserta->where('butuh_akomodasi', true)->count();
        $sheet->setCellValue('A' . $row, 'Butuh Akomodasi');
        $sheet->setCellValue('B' . $row, $butuhAkomodasi);

        // Auto-size columns
        foreach (range('A', 'V') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Freeze pane
        $sheet->freezePane('A7');

        // Generate filename
        $filename = 'peserta_jkpi_2026_' . $status . '_' . date('Ymd_His') . '.xlsx';

        // Create writer and download
        $writer = new Xlsx($spreadsheet);

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }

    /**
     * Export statistik ke Excel
     */
    public function exportStatistik()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Statistik');

        // Header
        $sheet->setCellValue('A1', 'STATISTIK PESERTA RAKERNAS XII JKPI 2026');
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('099AA7');
        $sheet->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getRowDimension(1)->setRowHeight(30);

        $sheet->setCellValue('A2', 'Tanggal: ' . date('d-m-Y H:i:s'));
        $sheet->mergeCells('A2:B2');
        $sheet->getStyle('A2')->getFont()->setBold(true);

        $row = 4;

        // Header tabel
        $sheet->setCellValue('A' . $row, 'KATEGORI');
        $sheet->setCellValue('B' . $row, 'JUMLAH');
        $sheet
            ->getStyle('A' . $row . ':B' . $row)
            ->getFont()
            ->setBold(true);
        $sheet
            ->getStyle('A' . $row . ':B' . $row)
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('E0E0E0');
        $sheet
            ->getStyle('A' . $row . ':B' . $row)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $row++;
        $sheet->setCellValue('A' . $row, 'Total Peserta');
        $sheet->setCellValue('B' . $row, Peserta::count());
        $sheet
            ->getStyle('A' . $row . ':B' . $row)
            ->getFont()
            ->setBold(true);

        // By Status
        $row += 2;
        $sheet->setCellValue('A' . $row, 'BERDASARKAN STATUS');
        $sheet
            ->getStyle('A' . $row)
            ->getFont()
            ->setBold(true);
        $sheet
            ->getStyle('A' . $row)
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('D3D3D3');

        $row++;
        $sheet->setCellValue('A' . $row, 'Verified');
        $sheet->setCellValue('B' . $row, Peserta::where('status', 'verified')->count());
        $row++;
        $sheet->setCellValue('A' . $row, 'Unverified');
        $sheet->setCellValue('B' . $row, Peserta::where('status', 'unverified')->count());
        $row++;
        $sheet->setCellValue('A' . $row, 'Cancelled');
        $sheet->setCellValue('B' . $row, Peserta::where('status', 'cancelled')->count());

        // By Email Verification
        $row += 2;
        $sheet->setCellValue('A' . $row, 'BERDASARKAN EMAIL VERIFICATION');
        $sheet
            ->getStyle('A' . $row)
            ->getFont()
            ->setBold(true);
        $sheet
            ->getStyle('A' . $row)
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('D3D3D3');

        $row++;
        $sheet->setCellValue('A' . $row, 'Email Verified');
        $sheet->setCellValue('B' . $row, Peserta::whereNotNull('email_verified_at')->count());
        $row++;
        $sheet->setCellValue('A' . $row, 'Email Belum Verified');
        $sheet->setCellValue('B' . $row, Peserta::whereNull('email_verified_at')->count());

        // By Gender
        $row += 2;
        $sheet->setCellValue('A' . $row, 'BERDASARKAN JENIS KELAMIN');
        $sheet
            ->getStyle('A' . $row)
            ->getFont()
            ->setBold(true);
        $sheet
            ->getStyle('A' . $row)
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('D3D3D3');

        $row++;
        $sheet->setCellValue('A' . $row, 'Laki-laki');
        $sheet->setCellValue('B' . $row, Peserta::where('jenis_kelamin', 'Laki-laki')->count());
        $row++;
        $sheet->setCellValue('A' . $row, 'Perempuan');
        $sheet->setCellValue('B' . $row, Peserta::where('jenis_kelamin', 'Perempuan')->count());

        // By Anggota JKPI
        $row += 2;
        $sheet->setCellValue('A' . $row, 'BERDASARKAN KEANGGOTAAN JKPI');
        $sheet
            ->getStyle('A' . $row)
            ->getFont()
            ->setBold(true);
        $sheet
            ->getStyle('A' . $row)
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('D3D3D3');

        $row++;
        $sheet->setCellValue('A' . $row, 'Anggota JKPI');
        $sheet->setCellValue('B' . $row, Peserta::where('is_anggota_jkpi', true)->count());
        $row++;
        $sheet->setCellValue('A' . $row, 'Bukan Anggota JKPI');
        $sheet->setCellValue('B' . $row, Peserta::where('is_anggota_jkpi', false)->count());

        // By Akomodasi
        $row += 2;
        $sheet->setCellValue('A' . $row, 'BERDASARKAN KEBUTUHAN AKOMODASI');
        $sheet
            ->getStyle('A' . $row)
            ->getFont()
            ->setBold(true);
        $sheet
            ->getStyle('A' . $row)
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('D3D3D3');

        $row++;
        $sheet->setCellValue('A' . $row, 'Butuh Akomodasi');
        $sheet->setCellValue('B' . $row, Peserta::where('butuh_akomodasi', true)->count());
        $row++;
        $sheet->setCellValue('A' . $row, 'Tidak Butuh Akomodasi');
        $sheet->setCellValue('B' . $row, Peserta::where('butuh_akomodasi', false)->count());

        // Top 10 Provinsi
        $row += 2;
        $sheet->setCellValue('A' . $row, 'TOP 10 PROVINSI');
        $sheet->setCellValue('B' . $row, 'JUMLAH');
        $sheet
            ->getStyle('A' . $row . ':B' . $row)
            ->getFont()
            ->setBold(true);
        $sheet
            ->getStyle('A' . $row . ':B' . $row)
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('E0E0E0');
        $sheet
            ->getStyle('A' . $row . ':B' . $row)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $topProvinsi = Peserta::selectRaw('provinsi, COUNT(*) as total')->groupBy('provinsi')->orderByDesc('total')->limit(10)->get();

        foreach ($topProvinsi as $prov) {
            $row++;
            $sheet->setCellValue('A' . $row, $prov->provinsi);
            $sheet->setCellValue('B' . $row, $prov->total);
        }

        // Auto-size
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);

        // Center align column B
        $sheet
            ->getStyle('B1:B' . $row)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $filename = 'statistik_peserta_jkpi_2026_' . date('Ymd_His') . '.xlsx';

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }

    /**
     * Export by Provinsi ke Excel (Multiple Sheets)
     */
    public function exportByProvinsi()
    {
        $spreadsheet = new Spreadsheet();

        // Get all provinsi
        $provinsiList = Peserta::select('provinsi')->groupBy('provinsi')->orderBy('provinsi')->pluck('provinsi');

        $sheetIndex = 0;
        foreach ($provinsiList as $provinsi) {
            if ($sheetIndex > 0) {
                $spreadsheet->createSheet();
            }

            $sheet = $spreadsheet->setActiveSheetIndex($sheetIndex);

            // Clean provinsi name for sheet title (max 31 chars, no special chars)
            $sheetTitle = substr(preg_replace('/[^a-zA-Z0-9 ]/', '', $provinsi), 0, 31);
            $sheet->setTitle($sheetTitle);

            $pesertaByProvinsi = Peserta::where('provinsi', $provinsi)->orderBy('kabupaten_kota')->orderBy('nama_lengkap')->get();

            // Header
            $sheet->setCellValue('A1', strtoupper($provinsi));
            $sheet->mergeCells('A1:H1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('099AA7');
            $sheet->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');
            $sheet->getRowDimension(1)->setRowHeight(30);

            $sheet->setCellValue('A2', 'Total: ' . $pesertaByProvinsi->count() . ' peserta');
            $sheet->mergeCells('A2:H2');
            $sheet->getStyle('A2')->getFont()->setBold(true);

            // Column Headers
            $headers = ['No', 'Kode Reg', 'Nama', 'Email', 'No. WA', 'Kab/Kota', 'Instansi', 'Status'];
            $col = 'A';
            foreach ($headers as $header) {
                $sheet->setCellValue($col . '4', $header);
                $col++;
            }

            $sheet->getStyle('A4:H4')->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '099AA7']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            ]);
            $sheet->getRowDimension(4)->setRowHeight(25);

            // Data
            $row = 5;
            $no = 1;
            foreach ($pesertaByProvinsi as $p) {
                $sheet->setCellValue('A' . $row, $no++);
                $sheet->setCellValue('B' . $row, $p->kode_registrasi);
                $sheet->setCellValue('C' . $row, $p->nama_lengkap);
                $sheet->setCellValue('D' . $row, $p->email);
                $sheet->setCellValue('E' . $row, $p->nomor_wa);
                $sheet->setCellValue('F' . $row, $p->kabupaten_kota);
                $sheet->setCellValue('G' . $row, $p->instansi ?? '-');
                $sheet->setCellValue('H' . $row, strtoupper($p->status));
                $row++;
            }

            // Style data
            if ($row > 5) {
                $sheet->getStyle('A5:H' . ($row - 1))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC'],
                        ],
                    ],
                ]);

                // Center align
                $sheet
                    ->getStyle('A5:A' . ($row - 1))
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet
                    ->getStyle('H5:H' . ($row - 1))
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }

            // Auto-size
            foreach (range('A', 'H') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // Freeze pane
            $sheet->freezePane('A5');

            $sheetIndex++;
        }

        $spreadsheet->setActiveSheetIndex(0);

        $filename = 'peserta_by_provinsi_' . date('Ymd_His') . '.xlsx';

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }
}
