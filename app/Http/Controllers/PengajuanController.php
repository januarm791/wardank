<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Produk; // Tambahkan Model Produk

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuan = Pengajuan::all();
        return view('pengajuan.index', compact('pengajuan'));
    }

    public function create()
    {
        return view('pengajuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengajuan' => 'required|date',
            'nama_pengaju' => 'nullable|string|max:255',
        ]);

        Pengajuan::create([
            'nama_pengaju' => $request->nama_pengaju ?? auth()->user()->name,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'status' => 'Pending',
        ]);

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan barang berhasil diajukan!');
    }


    public function destroy($id)
    {
        $pengajuan = Pengajuan::find($id);
        $pengajuan->delete();

        return redirect()->route('pengajuan.index')->with('success', 'Berhasil Hapus Data');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = $request->status;
        $pengajuan->save();

        return response()->json(['success' => true, 'status' => $pengajuan->status]);
    }
}
