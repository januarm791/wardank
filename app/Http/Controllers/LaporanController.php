<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function penjualan()
    {
        $penjualan = Penjualan::with('pelanggan')->get();

        $chart = Penjualan::selectRaw('MONTH(tgl_faktur) as bulan, SUM(total_bayar) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $chartLabels = $chart->map(fn ($item) => Carbon::create()->month($item->bulan)->locale('id')->isoFormat('MMMM'));
        $chartData = $chart->pluck('total');

        return view('laporan.penjualan', compact('penjualan', 'chartLabels', 'chartData'));
    }
}
