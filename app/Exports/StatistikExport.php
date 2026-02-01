<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Collection;

class StatistikExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithTitle
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Get statistics data
     */
    public function collection()
    {
        $query = Peserta::query();

        // Apply filters if any
        if (isset($this->filters['status']) && $this->filters['status'] != '') {
            $query->where('status', $this->filters['status']);
        }

        $stats = [['STATISTIK', 'JUMLAH'], ['', ''], ['Total Peserta', $query->count()], ['Status Verified', Peserta::where('status', 'verified')->count()], ['Status Unverified', Peserta::where('status', 'unverified')->count()], ['Status Cancelled', Peserta::where('status', 'cancelled')->count()], ['', ''], ['Email Verified', Peserta::whereNotNull('email_verified_at')->count()], ['Email Belum Verified', Peserta::whereNull('email_verified_at')->count()], ['', ''], ['Anggota JKPI', Peserta::where('is_anggota_jkpi', true)->count()], ['Bukan Anggota JKPI', Peserta::where('is_anggota_jkpi', false)->count()], ['', ''], ['Butuh Akomodasi', Peserta::where('butuh_akomodasi', true)->count()], ['Tidak Butuh Akomodasi', Peserta::where('butuh_akomodasi', false)->count()], ['', ''], ['Laki-laki', Peserta::where('jenis_kelamin', 'Laki-laki')->count()], ['Perempuan', Peserta::where('jenis_kelamin', 'Perempuan')->count()]];

        return collect($stats);
    }

    /**
     * Define headings
     */
    public function headings(): array
    {
        return ['STATISTIK PESERTA RAKERNAS XII JKPI 2026', ''];
    }

    /**
     * Apply styles
     */
    public function styles(Worksheet $sheet)
    {
        // Title
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '099AA7'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(30);

        // Header columns
        $sheet->getStyle('A2:B2')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E0E0E0'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // Data rows
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A3:B' . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
        ]);

        // Center align jumlah column
        $sheet
            ->getStyle('B3:B' . $highestRow)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Bold for category rows
        foreach ([3, 4, 5, 6, 8, 9, 11, 12, 14, 15, 17, 18] as $row) {
            $sheet
                ->getStyle('A' . $row)
                ->getFont()
                ->setBold(true);
        }

        return $sheet;
    }

    /**
     * Set sheet title
     */
    public function title(): string
    {
        return 'Statistik';
    }
}
