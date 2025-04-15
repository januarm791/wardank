<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Carbon\Carbon;

class LaporanPenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with('pelanggan')->orderBy('tanggal', 'asc')->get();

        // Kelompokkan penjualan per bulan
        $grouped = $penjualan->groupBy(function ($item) {
            return Carbon::parse($item->tgl_faktur)->format('F Y');
        });

        // Siapkan data grafik
        $chartLabels = $grouped->keys();
        $chartData = $grouped->map(function ($group) {
            return $group->sum('total_bayar');
        })->values();

        return view('laporan.penjualan', compact('penjualan', 'chartLabels', 'chartData'));
    }
}
