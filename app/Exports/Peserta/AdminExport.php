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

    public function map($item): array
    {
        static $no = 0;
        $no++;

        $narahubungNama = $item->narahubung->pluck('nama')->implode(' | ');
        $narahubungTelepon = $item->narahubung->pluck('telepon')->implode(' | ');
        $narahubungEmail = $item->narahubung->pluck('email')->implode(' | ');

        return [
            $no,
            $item->nama_daerah,
            $item->nama_kepala_daerah,
            $item->nama_wakil_kepala_daerah ?? '-',
            $item->nama_ajudan ?? '-',
            $item->telepon_ajudan ?? '-',
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
