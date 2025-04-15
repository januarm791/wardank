<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\DetailPenjualan;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with('pelanggan')->orderByDesc('tanggal')->get();
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        return view('penjualan.create', compact('pelanggan', 'barang'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barang,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        $items = [];
        $total = 0;

        foreach ($request->barang_id as $index => $id) {
            $barang = Barang::findOrFail($id);
            $jumlah = $request->jumlah[$index];
            $subtotal = $barang->harga_jual * $jumlah;
            $total += $subtotal;

            $items[] = [
                'id' => $barang->id,
                'nama' => $barang->nama_barang,
                'harga' => $barang->harga_jual,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal
            ];
        }

        $pelanggan = Pelanggan::findOrFail($request->pelanggan_id);

        return view('penjualan.checkout', [
            'pelanggan' => $pelanggan,
            'items' => $items,
            'total' => $total,
            'data' => $request->all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'barang_id' => 'required|array',
            'jumlah' => 'required|array',
            'uang_bayar' => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();
        try {
            $penjualan = Penjualan::create([
                'no_faktur' => 'F' . time(),
                'tanggal' => now(),
                'total_bayar' => 0,
                'uang_bayar' => $request->uang_bayar,
                'kembalian' => 0,
                'pelanggan_id' => $request->pelanggan_id,
                'user_id' => Auth::id(),
            ]);

            $totalBayar = 0;

            foreach ($request->barang_id as $index => $barang_id) {
                $barang = Barang::findOrFail($barang_id);
                $jumlah = $request->jumlah[$index];
                $subtotal = $barang->harga_jual * $jumlah;

                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'barang_id' => $barang_id,
                    'harga_jual' => $barang->harga_jual,
                    'jumlah' => $jumlah,
                    'sub_total' => $subtotal,
                ]);

                $totalBayar += $subtotal;
                $barang->decrement('stok', $jumlah);
            }

            $penjualan->update([
                'total_bayar' => $totalBayar,
                'kembalian' => max(0, $request->uang_bayar - $totalBayar),
            ]);

            // ===== Cetak Struk =====
            try {
                $connector = new WindowsPrintConnector("POS-58"); // Ganti dengan nama printer kamu
                $printer = new Printer($connector);

                $printer->setJustification(Printer::JUSTIFY_CENTER);
                $printer->text("WARUNG POS\n");
                $printer->text("Jl. Contoh No.123\n");
                $printer->text("Telp: 0812-3456-7890\n");
                $printer->text("===============================\n");

                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer->text("No Faktur: {$penjualan->no_faktur}\n");
                $printer->text("Tanggal  : " . $penjualan->tanggal . "\n");
                $printer->text("Pelanggan: " . $penjualan->pelanggan->nama . "\n");
                $printer->text("--------------------------------\n");

                foreach ($penjualan->detailPenjualan as $item) {
                    $printer->text($item->barang->nama_barang . "\n");
                    $printer->text("{$item->jumlah} x " . number_format($item->harga_jual) . " = " . number_format($item->sub_total) . "\n");
                }

                $printer->text("--------------------------------\n");
                $printer->text("Total     : " . number_format($penjualan->total_bayar) . "\n");
                $printer->text("Bayar     : " . number_format($penjualan->uang_bayar) . "\n");
                $printer->text("Kembalian : " . number_format($penjualan->kembalian) . "\n");
                $printer->text("================================\n");
                $printer->text("Terima kasih!\n");
                $printer->pulse();
                $printer->feed(4);
                $printer->cut();
                $printer->close();
            } catch (\Exception $e) {
                // Bisa log error kalau printer gagal
            }

            DB::commit();
            return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil disimpan & struk dicetak!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('penjualan.index')->with('error', 'Gagal menyimpan transaksi!');
        }
    }

    public function show($id)
    {
        $penjualan = Penjualan::with('pelanggan', 'detailPenjualan.barang')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::with('detailPenjualan.barang')->findOrFail($id);

        foreach ($penjualan->detailPenjualan as $detail) {
            $detail->barang->increment('stok', $detail->jumlah);
            $detail->delete();
        }

        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
