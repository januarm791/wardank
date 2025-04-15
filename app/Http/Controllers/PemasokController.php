<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function index()
    {
        $pemasok = Pemasok::all();
        return view('admin.pemasok.index', compact('pemasok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemasok' => 'required|string|max:255',
        ]);

        Pemasok::create([
            'nama_pemasok' => $request->nama_pemasok,
        ]);

        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemasok' => 'required|string|max:255',
        ]);

        $pemasok = Pemasok::findOrFail($id);
        $pemasok->update([
            'nama_pemasok' => $request->nama_pemasok,
        ]);

        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        $pemasok->delete();

        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil dihapus!');
    }
}
