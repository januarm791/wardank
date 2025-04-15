<?php
namespace App\Http\Controllers;

use App\Models\BarangKeluar; // Pastikan model ini sesuai
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\BarangKeluarExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanBarangKeluarController extends Controller
{
    public function index()
    {
        $data = BarangKeluar::with('barang')->orderBy('created_at', 'desc')->get();
        return view('laporan.barang-keluar', compact('data'));
    }

    public function exportPdf()
    {
        $data = BarangKeluar::with('barang')->get();
        $pdf = Pdf::loadView('laporan.barang-keluar-pdf', compact('data'));
        return $pdf->download('laporan-barang-keluar.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new BarangKeluarExport, 'laporan-barang-keluar.xlsx');
    }
}
