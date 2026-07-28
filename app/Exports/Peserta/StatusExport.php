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

class StatusExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
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

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Define headings
     */
    public function headings(): array
    {
        return ['NO', 'KODE REGISTRASI', 'NAMA LENGKAP', 'STATUS', 'TANGGAL DAFTAR', 'TANGGAL UPDATE', 'PROVINSI'];
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
            strtoupper($peserta->status),
            $peserta->created_at->format('d-m-Y H:i:s'),
            $peserta->updated_at->format('d-m-Y H:i:s'),
            $peserta->provinsi,
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

        // Color code status
        for ($i = 2; $i <= $highestRow; $i++) {
            $status = $sheet->getCell('D' . $i)->getValue();

            if ($status == 'VERIFIED') {
                $sheet->getStyle('D' . $i)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D4EDDA'],
                    ],
                    'font' => [
                        'color' => ['rgb' => '155724'],
                        'bold' => true,
                    ],
                ]);
            } elseif ($status == 'UNVERIFIED') {
                $sheet->getStyle('D' . $i)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFF3CD'],
                    ],
                    'font' => [
                        'color' => ['rgb' => '856404'],
                        'bold' => true,
                    ],
                ]);
            } elseif ($status == 'CANCELLED') {
                $sheet->getStyle('D' . $i)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F8D7DA'],
                    ],
                    'font' => [
                        'color' => ['rgb' => '721C24'],
                        'bold' => true,
                    ],
                ]);
            }
        }

        // Set column width
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
        return 'Status';
    }
}
