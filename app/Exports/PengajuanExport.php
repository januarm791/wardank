<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengajuanExport implements FromCollection
{
    public function collection()
    {
        return Pengajuan::all();
    }
}
