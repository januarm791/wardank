<?php

namespace App\Exports;

use App\Models\Barang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanBarangExport implements FromView
{
    public function view(): View
    {
        $barang = Barang::with('kategori')->get();
        $totalNilai = $barang->sum(function ($item) {
            return $item->stok * $item->harga_jual;
        });

        return view('admin.laporan.barang_excel', compact('barang', 'totalNilai'));
    }
}
