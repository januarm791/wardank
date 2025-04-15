<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Pemasok;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::with('pemasok', 'user')->latest()->get();
        return view('admin.pembelian.index', compact('pembelian'));
    }

    public function create()
    {
        $pemasok = Pemasok::all();
        $barang = Barang::all();
        return view('admin.pembelian.create', compact('pemasok', 'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemasok_id' => 'required|exists:pemasok,id',
            'tanggal_masuk' => 'required|date',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barang,id',
            'harga_beli' => 'required|array',
            'harga_beli.*' => 'numeric|min:0',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1'
        ]);

        $kode_masuk = 'PMB-' . strtoupper(uniqid());
        $total = 0;

        $pembelian = Pembelian::create([
            'kode_masuk' => $kode_masuk,
            'tanggal_masuk' => $request->tanggal_masuk,
            'total' => 0, 
            'pemasok_id' => $request->pemasok_id,
            'user_id' => Auth::id(),
        ]);

        foreach ($request->barang_id as $key => $barangId) {
            $hargaBeli = $request->harga_beli[$key];
            $jumlah = $request->jumlah[$key];
            $subTotal = $hargaBeli * $jumlah;
            $total += $subTotal;

            // Simpan detail pembelian
            DetailPembelian::create([
                'pembelian_id' => $pembelian->id,
                'barang_id' => $barangId,
                'harga_beli' => $hargaBeli,
                'jumlah' => $jumlah,
                'sub_total' => $subTotal,
            ]);

            // Update stok barang dan harga jual otomatis (20% dari harga beli)
            $barang = Barang::find($barangId);
            $barang->stok += $jumlah;
            $barang->harga_jual = $hargaBeli * 1.2;
            $barang->save();
        }

        // Update total pembelian
        $pembelian->update(['total' => $total]);

        return Redirect::route('pembelian.index')->with('success', 'Transaksi pembelian berhasil ditambahkan.');
    }

    public function show(Pembelian $pembelian)
    {
        $pembelian->load('detailPembelian.barang', 'pemasok', 'user');
        return view('admin.pembelian.show', compact('pembelian'));
    }

    public function destroy(Pembelian $pembelian)
    {
        // Hapus semua detail pembelian terkait
        foreach ($pembelian->detailPembelian as $detail) {
            $barang = Barang::find($detail->barang_id);
            if ($barang) {
                $barang->stok -= $detail->jumlah;
                $barang->save();
            }
            $detail->delete();
        }

        $pembelian->delete();

        return Redirect::route('pembelian.index')->with('success', 'Transaksi pembelian berhasil dihapus.');
    }
}
