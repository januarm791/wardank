@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Barang</h1>
        <form action="{{ route('barang.update', $barang) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Nama Barang</label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}"
                    class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Satuan</label>
                <input type="text" name="satuan" value="{{ old('satuan', $barang->satuan) }}"
                    class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Harga Jual</label>
                <input type="number" name="harga_jual" value="{{ old('harga_jual', $barang->harga_jual) }}"
                    class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Stok</label>
                <input type="number" name="stok" value="{{ old('stok', $barang->stok) }}"
                    class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Gambar</label>
                <input type="file" name="gambar" class="w-full p-2 border rounded">

                @if ($barang->gambar)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Lama"
                            class="w-32 h-32 object-cover rounded border">
                        <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                    </div>
                @endif
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
@endsection
