<?php

namespace App\Exports;

use App\Models\Penjualan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class UangMasukExport implements FromView
{
    protected $bulan;

    public function __construct($bulan = null)
    {
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        $query = Penjualan::with('pelanggan');

        if ($this->bulan) {
            $bulan = Carbon::parse($this->bulan);
            $query->whereMonth('created_at', $bulan->format('m'))
                  ->whereYear('created_at', $bulan->format('Y'));
        }

        $penjualan = $query->get();
        $total = $penjualan->sum('total_bayar');

        return view('laporan.uang-masuk-excel', compact('penjualan', 'total'));
    }
}
