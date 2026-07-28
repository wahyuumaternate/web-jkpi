<?php

namespace App\Exports\Peserta;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class DaerahExport implements FromCollection, WithMapping, WithStyles, ShouldAutoSize, WithTitle, WithEvents
{
    protected $status;
    protected $rowGroups = [];

    // Cache koleksi supaya query tidak dijalankan berulang kali
    // (sekali untuk export, sekali lagi untuk hitung total).
    protected $cachedCollection;

    // Baris data pertama setelah judul (1) + baris kosong (2) + header (3)
    const HEADER_ROWS = 3;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function collection()
    {
        if ($this->cachedCollection === null) {
            $query = Peserta::with(['narahubung', 'kegiatan']);
            if ($this->status) {
                $query->where('status', $this->status);
            }
            $this->cachedCollection = $query->orderBy('created_at', 'desc')->get();
        }

        return $this->cachedCollection;
    }

    /**
     * Setiap Peserta menghasilkan 2 baris:
     * 1) Kepala Daerah
     * 2) Wakil Kepala Daerah
     * NOMOR PLAT & JUMLAH ROMBONGAN akan di-merge vertikal antara kedua baris ini.
     */
    public function map($item): array
    {
        static $no = 0;

        $rows = [];

        // Pastikan jumlah_rombongan selalu berupa angka (hindari null yang bikin tampilan aneh / warning)
        $jumlahRombongan = is_numeric($item->jumlah_rombongan) ? (int) $item->jumlah_rombongan : 0;

        // Jika kepala daerah ada
        if (!empty($item->nama_kepala_daerah)) {
            $no++;

            $rows[] = [$no, 'KEPALA DAERAH ' . strtoupper($item->nama_daerah), strtoupper($item->nama_kepala_daerah), strtoupper($item->ukuran_baju ?? ''), strtoupper($item->nama_pasangan_kepala_daerah ?? ''), strtoupper($item->ukuran_baju_pasangan ?? ''), strtoupper($item->ukuran_peci ?? ''), strtoupper($item->nomor_plat ?? ''), $jumlahRombongan];
        }

        // Jika wakil kepala daerah ada
        if (!empty($item->nama_wakil_kepala_daerah)) {
            $no++;

            $rows[] = [$no, 'WAKIL KEPALA DAERAH ' . strtoupper($item->nama_daerah), strtoupper($item->nama_wakil_kepala_daerah), strtoupper($item->ukuran_baju_wakil ?? ''), strtoupper($item->nama_pasangan_wakil_kepala_daerah ?? ''), strtoupper($item->ukuran_baju_pasangan_wakil ?? ''), strtoupper($item->ukuran_peci_wakil ?? ''), strtoupper($item->nomor_plat ?? ''), $jumlahRombongan];
        }

        $this->rowGroups[] = count($rows);

        return $rows;
    }

    public function styles(Worksheet $sheet)
    {
        // Style dasar untuk seluruh area data akan diselesaikan di registerEvents,
        // karena kita butuh tahu highestRow SETELAH baris judul & header disisipkan.
        return [];
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

                // Jumlah baris data (2 baris per peserta) yang sudah ditulis mulai baris 1
                $lastDataRow = $sheet->getHighestRow();

                // Sisipkan 3 baris kosong di paling atas untuk judul (1), spacer (2), header (3)
                $sheet->insertNewRowBefore(1, self::HEADER_ROWS);

                $firstDataRow = self::HEADER_ROWS + 1;
                $highestRow = $lastDataRow + self::HEADER_ROWS;

                // ===== Judul =====
                $sheet->setCellValue('A1', 'DAFTAR KEPALA DAERAH DAN WAKIL KEPALA DAERAH (UPDATE WEBSITE ' . strtoupper(date('d F Y')) . ')');
                $sheet->mergeCells('A1:I1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);
                $sheet->getRowDimension(1)->setRowHeight(22);

                // ===== Header tabel (baris 3) =====
                $headings = [
                    'A3' => 'NO',
                    'B3' => 'JABATAN',
                    'C3' => 'NAMA',
                    'D3' => 'UKURAN BAJU',
                    'E3' => 'NAMA PASANGAN',
                    'F3' => 'BAJU PASANGAN',
                    'G3' => 'UKURAN PECI',
                    'H3' => 'NOMOR PLAT',
                    'I3' => 'JUMLAH ROMBONGAN',
                ];
                foreach ($headings as $cell => $text) {
                    $sheet->setCellValue($cell, $text);
                }

                $headerStyle = [
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '099AA7']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                ];
                $sheet->getStyle('A3:I3')->applyFromArray($headerStyle);
                $sheet->getRowDimension(3)->setRowHeight(35);

                // ===== Border & alignment untuk area data =====
                $sheet->getStyle("A{$firstDataRow}:I{$highestRow}")->applyFromArray([
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
                    'alignment' => ['vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
                ]);

                // ===== Belang-belang (zebra) per pasangan baris (Kepala + Wakil) =====
                $currentRow = $firstDataRow;
                $colors = ['FFFFFF', 'F2F2F2'];
                $index = 0;

                foreach ($this->rowGroups as $groupRows) {
                    $endRow = $currentRow + $groupRows - 1;

                    // Zebra sesuai 1 daerah
                    $sheet->getStyle("A{$currentRow}:I{$endRow}")->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => [
                                'rgb' => $colors[$index % 2],
                            ],
                        ],
                    ]);

                    // Merge hanya jika ada Kepala + Wakil
                    if ($groupRows == 2) {
                        $sheet->mergeCells("H{$currentRow}:H{$endRow}");
                        $sheet->mergeCells("I{$currentRow}:I{$endRow}");

                        $sheet
                            ->getStyle("H{$currentRow}:I{$endRow}")
                            ->getAlignment()
                            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                            ->setVertical(Alignment::VERTICAL_CENTER);
                    }

                    $currentRow = $endRow + 1;
                    $index++;
                }

                // ===== Baris total di bawah tabel =====
                $totalRow = $highestRow + 2;
                $sheet->setCellValue('B' . $totalRow, 'TOTAL JUMLAH ROMBONGAN');
                // Total dihitung langsung dari PHP (bukan formula SUM), agar tidak terjadi #REF!
                // akibat sebagian baris I ikut ter-merge.
                // Gunakan collection() yang sudah di-cache, dan pastikan hasilnya numerik.
                $totalRombongan = $this->collection()->sum(function ($item) {
                    return is_numeric($item->jumlah_rombongan) ? (int) $item->jumlah_rombongan : 0;
                });
                $sheet->setCellValue('I' . $totalRow, $totalRombongan);

                $sheet->getStyle('B' . $totalRow . ':I' . $totalRow)->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F2F2F2']],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                ]);
                $sheet
                    ->getStyle('B' . $totalRow)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $sheet
                    ->getStyle('I' . $totalRow)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // ===== Lebar kolom =====
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(28);
                $sheet->getColumnDimension('C')->setWidth(30);
                $sheet->getColumnDimension('D')->setWidth(12);
                $sheet->getColumnDimension('E')->setWidth(28);
                $sheet->getColumnDimension('F')->setWidth(14);
                $sheet->getColumnDimension('G')->setWidth(12);
                $sheet->getColumnDimension('H')->setWidth(14);
                $sheet->getColumnDimension('I')->setWidth(14);

                // ===== Print Area & Page Setup =====
                $sheet->getPageSetup()->setPrintArea("A1:I{$totalRow}");
                $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
                $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);

                // Muat semua kolom dalam 1 halaman
                $sheet->getPageSetup()->setFitToWidth(1);
                $sheet->getPageSetup()->setFitToHeight(0);

                // Margin
                $sheet->getPageMargins()->setTop(0.4)->setRight(0.25)->setLeft(0.25)->setBottom(0.4);

                // Header tabel diulang pada setiap halaman
                $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(3, 3);

                // Tampilkan garis grid saat dicetak (opsional)
                $sheet->setPrintGridlines(true);

                // Posisi di tengah halaman
                $sheet->getPageSetup()->setHorizontalCentered(true)->setVerticalCentered(false);
                $sheet->freezePane('A' . $firstDataRow);
            },
        ];
    }
}
