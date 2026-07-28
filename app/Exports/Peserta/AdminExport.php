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

class AdminExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
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
        return ['NO', 'NAMA DAERAH', 'NAMA KEPALA DAERAH', 'NAMA WAKIL KEPALA DAERAH', 'NAMA AJUDAN', 'TELEPON AJUDAN', 'NAMA NARAHUBUNG', 'TELEPON NARAHUBUNG', 'EMAIL NARAHUBUNG'];
    }

    protected function formatPhone(?string $phone): string
    {
        $phone = trim($phone ?? '');
        if ($phone === '') {
            return '-';
        }

        return "'{$phone}";
    }

    public function map($item): array
    {
        static $no = 0;
        $no++;

        $narahubungNama = $item->narahubung->pluck('nama')->map(fn($v) => strtoupper($v))->implode(' | ');
        $narahubungTelepon = $item->narahubung->pluck('telepon')->map(fn($value) => $this->formatPhone($value))->implode(' | ');
        $narahubungEmail = $item->narahubung->pluck('email')->implode(' | ');

        return [
            $no,
            strtoupper($item->nama_daerah),
            strtoupper($item->nama_kepala_daerah),
            strtoupper($item->nama_wakil_kepala_daerah ?? '-'),
            strtoupper($item->nama_ajudan ?? '-'),
            $this->formatPhone($item->telepon_ajudan),
            $narahubungNama ?: '-',
            $narahubungTelepon ?: '-',
            $narahubungEmail ?: '-',
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

        $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(25);

        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:I' . $highestRow)->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
        ]);

        $placeholderStyle = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFF1E0'],
            ],
        ];

        for ($row = 2; $row <= $highestRow; $row++) {
            foreach (range('A', 'I') as $col) {
                if (trim((string) $sheet->getCell("{$col}{$row}")->getValue()) === '-') {
                    $sheet->getStyle("{$col}{$row}")->applyFromArray($placeholderStyle);
                }
            }
        }

        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(28);
        $sheet->getColumnDimension('D')->setWidth(22);
        $sheet->getColumnDimension('E')->setWidth(22);
        $sheet->getColumnDimension('F')->setWidth(18);
        $sheet->getColumnDimension('G')->setWidth(24);
        $sheet->getColumnDimension('H')->setWidth(24);
        $sheet->getColumnDimension('I')->setWidth(30);

        $sheet->freezePane('A2');
        return $sheet;
    }

    public function title(): string
    {
        return 'Ajudan & Narahubung';
    }
}
