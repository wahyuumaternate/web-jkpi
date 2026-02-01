<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PesertaMultiSheetExport implements WithMultipleSheets
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Return multiple sheets
     */
    public function sheets(): array
    {
        $sheets = [];

        // Sheet 1: Data Peserta
        $sheets[] = new PesertaExport($this->filters);

        // Sheet 2: Statistik
        $sheets[] = new StatistikExport($this->filters);

        // Sheet 3: Data by Status
        $sheets[] = new PesertaByStatusExport($this->filters);

        return $sheets;
    }
}
