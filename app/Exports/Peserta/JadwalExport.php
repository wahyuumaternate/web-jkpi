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

class JadwalExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
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
        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return ['NO', 'NAMA DAERAH', 'NAMA KEPALA DAERAH', 'NAMA WAKIL KEPALA DAERAH', 'INFO KEDATANGAN', 'INFO KEPULANGAN', 'KEGIATAN'];
    }

    public function map($item): array
    {
        static $no = 0;
        $no++;

        $kegiatanItems = $item->kegiatan->pluck('nama_kegiatan')->filter()->values();
        $kegiatan = $kegiatanItems->count() > 0
            ? $kegiatanItems->map(fn($value) => '- ' . strtoupper($value))->implode("\n")
            : '-';

        return [
            $no,
            strtoupper($item->nama_daerah),
            strtoupper($item->nama_kepala_daerah),
            strtoupper($item->nama_wakil_kepala_daerah ?? '-'),
            strtoupper($item->info_kedatangan),
            strtoupper($item->info_kepulangan),
            $kegiatan,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '099AA7']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ];

        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(25);

        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:G' . $highestRow)->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
        ]);

        $placeholderStyle = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFF1E0'],
            ],
        ];

        for ($row = 2; $row <= $highestRow; $row++) {
            foreach (range('A', 'G') as $col) {
                if (trim((string) $sheet->getCell("{$col}{$row}")->getValue()) === '-') {
                    $sheet->getStyle("{$col}{$row}")->applyFromArray($placeholderStyle);
                }
            }
        }

        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(40);

        $sheet->getStyle('G2:G' . $highestRow)->getAlignment()->setWrapText(true);

        $sheet->freezePane('A2');
        return $sheet;
    }

    public function title(): string
    {
        return 'Kedatangan - Kepulangan - Kegiatan';
    }
}
