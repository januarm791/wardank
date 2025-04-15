@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">Tambah Barang</h1>
    
    <form action="{{ route('produk.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-2">Kode Barang</label>
            <input type="text" name="kode_barang" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-2">Nama Barang</label>
            <input type="text" name="nama_barang" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-2">Produk</label>
            <select name="produk_id" class="w-full px-4 py-2 border rounded-lg">
                @foreach($produk as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-2">Satuan</label>
            <input type="text" name="satuan" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-2">Harga Jual</label>
            <input type="number" name="harga_jual" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-2">Stok</label>
            <input type="number" name="stok" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Simpan
        </button>
    </form>
</div>
@endsection
