<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PesertaByStatusExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Get collection grouped by status
     */
    public function collection()
    {
        $query = Peserta::query();

        // Apply filters
        if (isset($this->filters['status']) && $this->filters['status'] != '') {
            $query->where('status', $this->filters['status']);
        }

        return $query->orderBy('status')->orderBy('created_at', 'desc')->get();
    }

    /**
     * Define headings
     */
    public function headings(): array
    {
        return ['NO', 'STATUS', 'KODE REGISTRASI', 'NAMA LENGKAP', 'EMAIL', 'NO. WA', 'PROVINSI', 'KABUPATEN/KOTA', 'INSTANSI', 'ANGGOTA JKPI', 'TANGGAL DAFTAR'];
    }

    /**
     * Map data
     */
    public function map($peserta): array
    {
        static $no = 0;
        $no++;

        return [$no, strtoupper($peserta->status), $peserta->kode_registrasi, strtoupper($peserta->nama_lengkap), $peserta->email, $peserta->nomor_wa, strtoupper($peserta->provinsi), strtoupper($peserta->kabupaten_kota), strtoupper($peserta->instansi ?? '-'), $peserta->is_anggota_jkpi ? 'YA' : 'TIDAK', $peserta->created_at->format('d-m-Y H:i')];
    }

    /**
     * Apply styles
     */
    public function styles(Worksheet $sheet)
    {
        // Header
        $sheet->getStyle('A1:K1')->applyFromArray([
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
        $sheet->getStyle('A2:K' . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
        ]);

        // Center align certain columns
        $centerColumns = ['A', 'B', 'J'];
        foreach ($centerColumns as $col) {
            $sheet
                ->getStyle($col . '2:' . $col . $highestRow)
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Color code status
        for ($i = 2; $i <= $highestRow; $i++) {
            $status = $sheet->getCell('B' . $i)->getValue();

            if ($status == 'VERIFIED') {
                $sheet->getStyle('B' . $i)->applyFromArray([
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
                $sheet->getStyle('B' . $i)->applyFromArray([
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
                $sheet->getStyle('B' . $i)->applyFromArray([
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

        $sheet->freezePane('A2');

        return $sheet;
    }

    /**
     * Sheet title
     */
    public function title(): string
    {
        return 'Data By Status';
    }
}
