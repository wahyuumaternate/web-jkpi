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
    protected $rowGroups = [];

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
        return $query->orderBy('created_at', 'asc')->orderBy('id', 'asc')->get();
    }

    public function headings(): array
    {
        return ['NO', 'JABATAN', 'NAMA', 'NAMA AJUDAN', 'TELEPON AJUDAN', 'NAMA NARAHUBUNG', 'TELEPON NARAHUBUNG', 'EMAIL NARAHUBUNG'];
    }

    protected function formatPhone(?string $phone): string
    {
        $phone = trim($phone ?? '');
        if ($phone === '') {
            return '-';
        }

        return "'{$phone}";
    }

    /**
     * Setiap Peserta menghasilkan sampai 2 baris:
     * 1) Kepala Daerah
     * 2) Wakil Kepala Daerah
     * Kolom AJUDAN & NARAHUBUNG (sama untuk kedua baris) akan di-merge vertikal
     * antar kedua baris ini di registerEvents.
     */
    public function map($item): array
    {
        static $no = 0;

        $narahubungNama = $item->narahubung->pluck('nama')->map(fn($v) => strtoupper($v))->implode(' | ');
        $narahubungTelepon = $item->narahubung->pluck('telepon')->map(fn($value) => $this->formatPhone($value))->implode(' | ');
        $narahubungEmail = $item->narahubung->pluck('email')->implode(' | ');

        $namaAjudan = strtoupper($item->nama_ajudan ?? '-');
        $teleponAjudan = $this->formatPhone($item->telepon_ajudan);
        $narahubungNama = $narahubungNama ?: '-';
        $narahubungTelepon = $narahubungTelepon ?: '-';
        $narahubungEmail = $narahubungEmail ?: '-';

        $rows = [];

        // Jika kepala daerah ada
        if (!empty($item->nama_kepala_daerah)) {
            $no++;
            $rows[] = [$no, 'KEPALA DAERAH ' . strtoupper($item->nama_daerah), strtoupper($item->nama_kepala_daerah), $namaAjudan, $teleponAjudan, $narahubungNama, $narahubungTelepon, $narahubungEmail];
        }

        // Jika wakil kepala daerah ada
        if (!empty($item->nama_wakil_kepala_daerah)) {
            $no++;
            $rows[] = [$no, 'WAKIL KEPALA DAERAH ' . strtoupper($item->nama_daerah), strtoupper($item->nama_wakil_kepala_daerah), $namaAjudan, $teleponAjudan, $narahubungNama, $narahubungTelepon, $narahubungEmail];
        }

        $this->rowGroups[] = count($rows);

        return $rows;
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

                $sheet->getStyle("A3:H{$highestRow}")->applyFromArray([
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

                $sheet->mergeCells('A1:H1');

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

                $sheet->getStyle('A3:H3')->applyFromArray($headerStyle);
                $sheet->getRowDimension(3)->setRowHeight(30);

                // ===== Zebra & merge kolom AJUDAN/NARAHUBUNG per pasangan baris (Kepala+Wakil) =====
                $firstDataRow = 4;
                $currentRow = $firstDataRow;
                $colors = ['FFFFFF', 'F2F2F2'];
                $index = 0;

                foreach ($this->rowGroups as $groupRows) {
                    $endRow = $currentRow + $groupRows - 1;

                    $sheet->getStyle("A{$currentRow}:H{$endRow}")->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => $colors[$index % 2]],
                        ],
                    ]);

                    // Merge kolom D-H (Ajudan & Narahubung) hanya jika ada Kepala + Wakil
                    if ($groupRows == 2) {
                        foreach (['D', 'E', 'F', 'G', 'H'] as $col) {
                            $sheet->mergeCells("{$col}{$currentRow}:{$col}{$endRow}");
                        }

                        $sheet
                            ->getStyle("D{$currentRow}:H{$endRow}")
                            ->getAlignment()
                            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                            ->setVertical(Alignment::VERTICAL_CENTER);
                    }

                    $currentRow = $endRow + 1;
                    $index++;
                }

                // Freeze pane
                $sheet->freezePane('A4');

                // ===== Print Area =====
                $highestRow = $sheet->getHighestRow();

                $sheet->getPageSetup()->setPrintArea("A1:H{$highestRow}");
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
