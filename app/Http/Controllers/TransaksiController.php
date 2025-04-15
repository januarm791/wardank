<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Menampilkan daftar transaksi
     */
    public function index()
    {
        $transaksis = Transaksi::latest()->get();
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Menampilkan form tambah transaksi
     */
    public function create()
    {
        return view('transaksi.create');
    }

    /**
     * Menyimpan transaksi baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_transaksi' => 'required|unique:transaksis,kode_transaksi|max:20',
            'tanggal_transaksi' => 'required|date',
            'total_harga' => 'required|numeric|min:0',
        ]);

        Transaksi::create($request->only(['kode_transaksi', 'tanggal_transaksi', 'total_harga']));

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit transaksi
     */
    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    /**
     * Memperbarui transaksi yang sudah ada
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'kode_transaksi' => 'required|max:20|unique:transaksis,kode_transaksi,' . $transaksi->id,
            'tanggal_transaksi' => 'required|date',
            'total_harga' => 'required|numeric|min:0',
        ]);

        $transaksi->update($request->only(['kode_transaksi', 'tanggal_transaksi', 'total_harga']));

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Menghapus transaksi dari database
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
