<?php
namespace App\Http\Controllers;

use App\Exports\PengajuanExport;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    // Export ke Excel
    public function exportExcel()
    {
        return response()->streamDownload(function () {
            echo Excel::raw(new PengajuanExport, \Maatwebsite\Excel\Excel::XLSX);
        }, 'pengajuan.xlsx');
    }
    

    // Export ke PDF
    public function exportPdf()
    {
        $pengajuan = Pengajuan::all();
        $pdf = Pdf::loadView('exports.pengajuan_pdf', compact('pengajuan'));

        return $pdf->stream('pengajuan.pdf');
    }
}
