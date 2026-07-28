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
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class JadwalExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle, WithEvents
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
        $kegiatan = $kegiatanItems->count() > 0 ? $kegiatanItems->map(fn($value) => '- ' . strtoupper($value))->implode("\n") : '-';

        return [$no, strtoupper($item->nama_daerah), strtoupper($item->nama_kepala_daerah), strtoupper($item->nama_wakil_kepala_daerah ?? '-'), strtoupper($item->info_kedatangan), strtoupper($item->info_kepulangan), $kegiatan];
    }

    public function styles(Worksheet $sheet)
    {
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '099AA7']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ];

        $sheet->getRowDimension(1)->setRowHeight(25);

        $highestRow = $sheet->getHighestRow();

        // Style untuk seluruh tabel
        $sheet->getStyle('A3:G' . $highestRow)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
        ]);

        // Header
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(25);

        // Agar teks di kolom G tetap turun ke bawah jika panjang
        $sheet
            ->getStyle('G4:G' . $highestRow)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT)
            ->setVertical(Alignment::VERTICAL_CENTER)
            ->setWrapText(true);
        $placeholderStyle = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFF1E0'],
            ],
        ];

        for ($row = 4; $row <= $highestRow; $row++) {
            foreach (range('A', 'G') as $col) {
                if (trim((string) $sheet->getCell("{$col}{$row}")->getValue()) === '-') {
                    $sheet->getStyle("{$col}{$row}")->applyFromArray($placeholderStyle);
                }
            }
        }

        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(40);

        $sheet
            ->getStyle('G2:G' . $highestRow)
            ->getAlignment()
            ->setWrapText(true);

        $sheet->freezePane('A4');
        return $sheet;
    }

    public function title(): string
    {
        return 'Agenda Peserta';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Tambahkan baris judul dan kosong
                $sheet->insertNewRowBefore(1, 2);

                // ===== Judul =====
                $sheet->setCellValue('A1', 'JADWAL KEDATANGAN, KEPULANGAN DAN KEGIATAN PESERTA (UPDATE WEBSITE ' . strtoupper(date('d F Y')) . ')');

                $sheet->mergeCells('A1:G1');

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

                // Header di baris 3
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

                $sheet->getStyle('A3:G3')->applyFromArray($headerStyle);
                $sheet->getRowDimension(3)->setRowHeight(35);

                $highestRow = $sheet->getHighestRow();

                // Print Area
                $sheet->getPageSetup()->setPrintArea("A1:G{$highestRow}");

                // Ukuran kertas & orientasi
                $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
                $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

                // Semua kolom muat dalam 1 halaman
                $sheet->getPageSetup()->setFitToWidth(1);
                $sheet->getPageSetup()->setFitToHeight(0);

                // Ulangi header pada setiap halaman
                $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(3, 3);

                // Margin
                $sheet->getPageMargins()->setTop(0.4)->setBottom(0.4)->setLeft(0.25)->setRight(0.25);

                // Posisi di tengah halaman
                $sheet->getPageSetup()->setHorizontalCentered(true);

                // Tampilkan grid saat dicetak (opsional)
                $sheet->setPrintGridlines(true);

                // Freeze header
                $sheet->freezePane('A4');
                $sheet->freezePane('A4');
            },
        ];
    }
}
