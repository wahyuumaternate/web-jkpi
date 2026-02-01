<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PesertaExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Get collection data
     */
    public function collection()
    {
        $query = Peserta::query();

        // Apply filters
        if (isset($this->filters['status']) && $this->filters['status'] != '') {
            $query->where('status', $this->filters['status']);
        }

        if (isset($this->filters['verified']) && $this->filters['verified'] != '') {
            if ($this->filters['verified'] == 'yes') {
                $query->whereNotNull('email_verified_at');
            } else {
                $query->whereNull('email_verified_at');
            }
        }

        if (isset($this->filters['search']) && $this->filters['search'] != '') {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('kode_registrasi', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Define headings
     */
    public function headings(): array
    {
        return ['NO', 'KODE REGISTRASI', 'NAMA LENGKAP', 'NIK', 'JENIS KELAMIN', 'TEMPAT LAHIR', 'TANGGAL LAHIR', 'UMUR', 'ALAMAT LENGKAP', 'PROVINSI', 'KABUPATEN/KOTA', 'KECAMATAN', 'KELURAHAN', 'KODE POS', 'EMAIL', 'EMAIL VERIFIED', 'NO. TELEPON', 'NO. WHATSAPP', 'INSTANSI', 'JABATAN', 'BIDANG PEKERJAAN', 'ANGGOTA JKPI', 'BUTUH AKOMODASI', 'KEBUTUHAN KHUSUS', 'STATUS', 'TANGGAL DAFTAR', 'TANGGAL UPDATE'];
    }

    /**
     * Map data for each row
     */
    public function map($peserta): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $peserta->kode_registrasi,
            $peserta->nama_lengkap,
            "'" . $peserta->nik, // Prefix dengan ' agar tidak auto format
            $peserta->jenis_kelamin,
            $peserta->tempat_lahir,
            $peserta->tanggal_lahir ? $peserta->tanggal_lahir->format('d-m-Y') : '',
            $peserta->umur . ' tahun',
            $peserta->alamat,
            $peserta->provinsi,
            $peserta->kabupaten_kota,
            $peserta->kecamatan ?? '-',
            $peserta->kelurahan ?? '-',
            $peserta->kode_pos ?? '-',
            $peserta->email,
            $peserta->email_verified_at ? 'Verified (' . $peserta->email_verified_at->format('d-m-Y H:i') . ')' : 'Belum Verified',
            $peserta->nomor_telepon ?? '-',
            $peserta->nomor_wa,
            $peserta->instansi ?? '-',
            $peserta->jabatan ?? '-',
            $peserta->bidang_pekerjaan ?? '-',
            $peserta->is_anggota_jkpi ? 'Ya' : 'Tidak',
            $peserta->butuh_akomodasi ? 'Ya' : 'Tidak',
            $peserta->kebutuhan_khusus ?? '-',
            strtoupper($peserta->status),
            $peserta->created_at->format('d-m-Y H:i:s'),
            $peserta->updated_at->format('d-m-Y H:i:s'),
        ];
    }

    /**
     * Apply styles to worksheet
     */
    public function styles(Worksheet $sheet)
    {
        // Style header row
        $sheet->getStyle('A1:AA1')->applyFromArray([
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

        // Set row height for header
        $sheet->getRowDimension(1)->setRowHeight(25);

        // Style data rows (apply borders to all cells with data)
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:AA' . $highestRow)->applyFromArray([
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

        // Align center untuk kolom tertentu
        $centerColumns = ['A', 'D', 'E', 'H', 'K', 'L', 'M', 'P', 'V', 'W', 'X', 'Y'];
        foreach ($centerColumns as $col) {
            $sheet
                ->getStyle($col . '2:' . $col . $highestRow)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Set minimum row height
        for ($i = 2; $i <= $highestRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(20);
        }

        // Freeze first row
        $sheet->freezePane('A2');

        return $sheet;
    }

    /**
     * Set sheet title
     */
    public function title(): string
    {
        return 'Data Peserta JKPI 2026';
    }
}
