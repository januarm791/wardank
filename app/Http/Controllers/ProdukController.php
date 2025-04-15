<php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Produk; 
class ProdukController extends Controller
{
    public function index()
    {
        $barang = Barang::latest()->get(); // Ambil semua barang
        return view('produk.index', compact('barang'));
    }

    public function create()
    {
        $produks = Produk::all(); // Ambil semua data produk
        return view('produk.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs|max:20',
            'nama_barang' => 'required|string|max:255',
            'produk_id' => 'required|exists:produks,id',
            'satuan' => 'required|string|max:50',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        Barang::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $produks = Produk::all(); // Tambahkan produk untuk dropdown
        return view('produk.edit', compact('barang', 'produks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|max:20|unique:barangs,kode_barang,' . $id,
            'nama_barang' => 'required|string|max:255',
            'produk_id' => 'required|exists:produks,id',
            'satuan' => 'required|string|max:50',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();
        return redirect()->route('produk.index')->with('success', 'Barang berhasil dihapus!');
    }
}
