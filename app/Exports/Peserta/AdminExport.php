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
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AdminExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle, WithEvents
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

        return [$no, strtoupper($item->nama_daerah), strtoupper($item->nama_kepala_daerah), strtoupper($item->nama_wakil_kepala_daerah ?? '-'), strtoupper($item->nama_ajudan ?? '-'), $this->formatPhone($item->telepon_ajudan), $narahubungNama ?: '-', $narahubungTelepon ?: '-', $narahubungEmail ?: '-'];
    }

    public function styles(Worksheet $sheet)
    {
        return [];
    }

    public function title(): string
    {
        return 'Ajudan & Narahubung';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Tambahkan 2 baris (judul + kosong)
                $sheet->insertNewRowBefore(1, 2);
                $highestRow = $sheet->getHighestRow();

                $sheet->getStyle("A3:I{$highestRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // ===== Judul =====
                $sheet->setCellValue('A1', 'DAFTAR KEPALA DAERAH, WAKIL KEPALA DAERAH, AJUDAN DAN NARAHUBUNG (UPDATE WEBSITE ' . strtoupper(date('d F Y')) . ')');

                $sheet->mergeCells('A1:I1');

                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getRowDimension(1)->setRowHeight(22);

                // Header pindah ke baris 3
                $headerStyle = [
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
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ];

                $sheet->getStyle('A3:I3')->applyFromArray($headerStyle);
                $sheet->getRowDimension(3)->setRowHeight(30);

                // Freeze pane
                $sheet->freezePane('A4');

                // ===== Print Area =====
                $highestRow = $sheet->getHighestRow();

                $sheet->getPageSetup()->setPrintArea("A1:I{$highestRow}");
                $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
                $sheet->getPageSetup()->setFitToWidth(1);
                $sheet->getPageSetup()->setFitToHeight(0);

                // Ulangi header di setiap halaman
                $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 3);

                // Margin
                $sheet->getPageMargins()->setTop(0.3)->setBottom(0.3)->setLeft(0.3)->setRight(0.3);
            },
        ];
    }
}
