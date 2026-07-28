<?php

namespace App\Exports;

use App\Exports\Peserta\DaerahExport;
use App\Exports\Peserta\JadwalExport;
use App\Exports\Peserta\AdminExport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PesertaCategoryMultiSheetExport implements WithMultipleSheets
{
    protected $status;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    /**
     * Return multiple sheets organized by category
     */
    public function sheets(): array
    {
        $sheets = [];

        // Sheet 1: Data Daerah
        $sheets[] = new DaerahExport($this->status);

        // Sheet 2: Kedatangan, Kepulangan & Kegiatan
        $sheets[] = new JadwalExport($this->status);

        // Sheet 3: Ajudan & Narahubung
        $sheets[] = new AdminExport($this->status);

        return $sheets;
    }
}
