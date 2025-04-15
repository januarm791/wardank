<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanBarangExport;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanBarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->get();
        $totalNilai = $barang->sum(fn($item) => $item->stok * $item->harga_jual);
        return view('admin.laporan.barang', compact('barang', 'totalNilai'));
    }

    public function exportExcel()
    {
        return Excel::download(new LaporanBarangExport, 'laporan_barang.xlsx');
    }

    public function exportPDF()
    {
        $barang = Barang::with('kategori')->get();
        $totalNilai = $barang->sum(fn($item) => $item->stok * $item->harga_jual);
        $pdf = PDF::loadView('admin.laporan.barang_pdf', compact('barang', 'totalNilai'));
        return $pdf->download('laporan_barang.pdf');
    }
}
