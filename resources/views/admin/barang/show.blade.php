@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Barang</h1>
    <div class="bg-white p-6 rounded shadow-md">
        <p><strong>Kode Barang:</strong> {{ $barang->kode_barang }}</p>
        <p><strong>Nama Barang:</strong> {{ $barang->nama_barang }}</p>
        <p><strong>Kategori:</strong> {{ $barang->kategori->nama_kategori }}</p>
        <p><strong>Satuan:</strong> {{ $barang->satuan }}</p>
        <p><strong>Harga Jual:</strong> Rp{{ number_format($barang->harga_jual, 0, ',', '.') }}</p>
        <p><strong>Stok:</strong> {{ $barang->stok }}</p>
        @if($barang->gambar)
            <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" class="mt-4 w-48 h-48 object-cover">
        @endif
        <a href="{{ route('barang.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mt-4 inline-block">Kembali</a>
    </div>
</div>
@endsection