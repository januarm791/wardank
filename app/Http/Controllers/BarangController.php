<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->get();
        return view('admin.barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama_barang' => 'required|string|max:100',
            'satuan' => 'required|string|max:20',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $kode_barang = 'BRG-' . strtoupper(uniqid());
        $gambarPath = $request->file('gambar') ? $request->file('gambar')->store('gambar_barang', 'public') : null;

        Barang::create([
            'kode_barang' => $kode_barang,
            'kategori_id' => $request->kategori_id,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'stok' => 0,
            'user_id' => Auth::id(),
            'gambar' => $gambarPath
        ]);

        return Redirect::route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        return view('admin.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kategori = Kategori::all();
        return view('admin.barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, Barang $barang)
    {
    $request->validate([
            'kategori_id' => 'sometimes|required|exists:kategori,id',
            'nama_barang' => 'sometimes|required|string|max:100',
            'satuan' => 'sometimes|required|string|max:20',
            'harga_jual' => 'sometimes|required|numeric|min:0',
            'stok' => 'sometimes|required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except(['gambar']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
                Storage::disk('public')->delete($barang->gambar);
            }

            // Upload gambar baru
            $gambarPath = $request->file('gambar')->store('gambar_barang', 'public');
            $data['gambar'] = $gambarPath;
        }

        $barang->update($data);

        return Redirect::route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();
        return Redirect::route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
