<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UangMasukExport;
use Carbon\Carbon;

class LaporanUangController extends Controller
{
    public function uangMasuk(Request $request)
    {
        $query = Penjualan::with('pelanggan')->orderBy('created_at', 'desc');

        if ($request->filled('bulan')) {
            $bulan = Carbon::parse($request->bulan);
            $query->whereMonth('created_at', $bulan->format('m'))
                  ->whereYear('created_at', $bulan->format('Y'));
        }

        $penjualan = $query->get();
        $total = $penjualan->sum('total_bayar');

        return view('laporan.uang-masuk', compact('penjualan', 'total'));
    }

    public function uangMasukPDF(Request $request)
    {
        $query = Penjualan::with('pelanggan');

        if ($request->filled('bulan')) {
            $bulan = Carbon::parse($request->bulan);
            $query->whereMonth('created_at', $bulan->format('m'))
                  ->whereYear('created_at', $bulan->format('Y'));
        }

        $penjualan = $query->get();
        $total = $penjualan->sum('total_bayar');

        $pdf = Pdf::loadView('laporan.uang-masuk-pdf', compact('penjualan', 'total'));
        return $pdf->download('laporan-uang-masuk.pdf');
    }

    public function uangMasukExcel(Request $request)
    {
        return Excel::download(new UangMasukExport($request->bulan), 'laporan-uang-masuk.xlsx');
    }
}
