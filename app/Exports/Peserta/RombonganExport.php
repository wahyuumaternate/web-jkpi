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

class RombonganExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
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
        return $query->orderBy('created_at', 'asc')->get();
    }

    public function headings(): array
    {
        return ['NO', 'NAMA DAERAH', 'NAMA KEPALA DAERAH', 'WAKIL KEPALA DAERAH', 'JUMLAH ROMBONGAN', 'NAMA AJUDAN', 'TELEPON AJUDAN', 'NOMOR PLAT'];
    }

    public function map($item): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            strtoupper($item->nama_daerah),
            strtoupper($item->nama_kepala_daerah),
            strtoupper($item->nama_wakil_kepala_daerah ?? '-'),
            $item->jumlah_rombongan,
            strtoupper($item->nama_ajudan ?? '-'),
            $item->telepon_ajudan ?? '-',
            strtoupper($item->nomor_plat ?? '-'),
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

        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(25);

        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:H' . $highestRow)->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
        ]);

        $sheet->freezePane('A2');
        return $sheet;
    }

    public function title(): string
    {
        return 'Rombongan';
    }
}
