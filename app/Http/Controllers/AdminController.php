<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pemasok;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Menghitung jumlah data dari masing-masing tabel
        $totalBarang = Barang::count();
        $totalPembelian = Pembelian::sum('total');
        $totalPelanggan = Pelanggan::count();
        $totalPemasok = Pemasok::count();

       
        // Ambil data pembelian untuk grafik
        $pembelianData = Pembelian::selectRaw('DATE(created_at) as tanggal, SUM(total) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('dashboard.dashboard-admin', compact(
            'totalBarang',
            'totalPembelian',
            'totalPelanggan',
            'totalPemasok',
            'pembelianData'
        ));
    }
}