<?php

namespace App\Exports\Peserta;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PekerjaanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
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

        return $query->orderBy('created_at', 'asc')->get();
    }

    /**
     * Define headings
     */
    public function headings(): array
    {
        return ['NO', 'KODE REGISTRASI', 'NAMA LENGKAP', 'INSTANSI', 'JABATAN', 'BIDANG PEKERJAAN', 'ANGGOTA JKPI'];
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
            strtoupper($peserta->nama_lengkap),
            strtoupper($peserta->instansi ?? '-'),
            strtoupper($peserta->jabatan ?? '-'),
            strtoupper($peserta->bidang_pekerjaan ?? '-'),
            $peserta->is_anggota_jkpi ? 'YA' : 'TIDAK',
        ];
    }

    /**
     * Apply styles to worksheet
     */
    public function styles(Worksheet $sheet)
    {
        // Style header row
        $sheet->getStyle('A1:G1')->applyFromArray([
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
                ],
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(25);

        // Data
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:G' . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
        ]);

        // Set column width
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);

        $sheet->freezePane('A2');

        return $sheet;
    }

    /**
     * Sheet title
     */
    public function title(): string
    {
        return 'Pekerjaan';
    }
}
