<?php

namespace App\Exports\Peserta;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DaerahExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle, WithEvents
{
    protected $status;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function collection()
    {
        $query = Peserta::with(['narahubung', 'kegiatan']);
        if ($this->status) {
            $query->where('status', $this->status);
        }
        return $query->orderBy('nama_daerah', 'asc')->get();
    }

    public function headings(): array
    {
        return ['NO', 'NAMA DAERAH', 'NAMA KEPALA DAERAH', 'BAJU KD', 'NAMA PASANGAN KD', 'BAJU PASANGAN KD', 'PECI KD', 'NAMA WAKIL KEPALA DAERAH', 'NAMA PASANGAN WAKIL', 'BAJU WAKIL', 'BAJU PASANGAN WAKIL', 'PECI WAKIL', 'NOMOR PLAT', 'JUMLAH ROMBONGAN'];
    }

    public function map($item): array
    {
        static $no = 0;
        $no++;

        return [$no, strtoupper($item->nama_daerah), strtoupper($item->nama_kepala_daerah), strtoupper($item->ukuran_baju), strtoupper($item->nama_pasangan_kepala_daerah ?? '-'), strtoupper($item->ukuran_baju_pasangan ?? '-'), strtoupper($item->ukuran_peci ?? '-'), strtoupper($item->nama_wakil_kepala_daerah ?? '-'), strtoupper($item->nama_pasangan_wakil_kepala_daerah ?? '-'), strtoupper($item->ukuran_baju_wakil ?? '-'), strtoupper($item->ukuran_baju_pasangan_wakil ?? '-'), strtoupper($item->ukuran_peci_wakil ?? '-'), strtoupper($item->nomor_plat ?? '-'), $item->jumlah_rombongan];
    }

    public function styles(Worksheet $sheet)
    {
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '099AA7']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ];

        $sheet->getStyle('A1:N1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(35);

        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:N' . $highestRow)->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
            'alignment' => ['vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true],
        ]);

        // Style Kepala Daerah columns with soft gray
        $sheet->getStyle('C2:G' . $highestRow)->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'ffffff'],
            ],
        ]);

        // Style Wakil columns with soft orange
        $sheet->getStyle('H2:L' . $highestRow)->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'ffffff'],
            ],
        ]);

        // Style header segments for Kepala Daerah and Wakil
        $sheet->getStyle('C1:G1')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '099AA7'],
            ],
            'font' => ['bold' => true, 'color' => ['rgb' => 'ffffff']],
        ]);
        $sheet->getStyle('H1:L1')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '099AA7'],
            ],
            'font' => ['bold' => true, 'color' => ['rgb' => 'ffffff']],
        ]);

        // Style placeholder cells for missing data with soft orange
        $placeholderStyle = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFF1E0'],
            ],
            'font' => [
                'color' => ['rgb' => '000000'],
            ],
        ];

        for ($row = 2; $row <= $highestRow; $row++) {
            foreach (range('C', 'N') as $col) {
                $value = trim((string) $sheet->getCell("{$col}{$row}")->getValue());
                if ($value === '-') {
                    $sheet->getStyle("{$col}{$row}")->applyFromArray($placeholderStyle);
                }
            }
        }

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(28);
        $sheet->getColumnDimension('D')->setWidth(10);
        $sheet->getColumnDimension('E')->setWidth(22);
        $sheet->getColumnDimension('F')->setWidth(12);
        $sheet->getColumnDimension('G')->setWidth(10);
        $sheet->getColumnDimension('H')->setWidth(22);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(10);
        $sheet->getColumnDimension('K')->setWidth(15);
        $sheet->getColumnDimension('L')->setWidth(10);
        $sheet->getColumnDimension('M')->setWidth(14);
        $sheet->getColumnDimension('N')->setWidth(12);

        $sheet->freezePane('A2');
        return $sheet;
    }

    public function title(): string
    {
        return 'Daftar Kepala Daerah';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $totalRow = $highestRow + 2;

                $sheet->setCellValue('B' . $totalRow, 'TOTAL JUMLAH ROMBONGAN');
                $sheet->setCellValue('N' . $totalRow, '=SUM(N2:N' . $highestRow . ')');

                $sheet->getStyle('B' . $totalRow . ':N' . $totalRow)->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F2F2F2']],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                ]);
                $sheet
                    ->getStyle('B' . $totalRow)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $sheet
                    ->getStyle('M' . $totalRow)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
