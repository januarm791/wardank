@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Transaksi Pembelian</h1>

    <div class="bg-white p-6 rounded shadow-md">
        <p><strong>Kode:</strong> {{ $pembelian->kode_masuk }}</p>
        <p><strong>Tanggal:</strong> {{ $pembelian->tanggal_masuk }}</p>
        <p><strong>Pemasok:</strong> {{ $pembelian->pemasok->nama }}</p>
        <p><strong>Total:</strong> Rp{{ number_format($pembelian->total, 0, ',', '.') }}</p>

        <h2 class="text-lg font-semibold mt-4">Detail Barang</h2>
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Nama Barang</th>
                    <th class="p-2 border">Harga Beli</th>
                    <th class="p-2 border">Jumlah</th>
                    <th class="p-2 border">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembelian->detailPembelian as $detail)
                <tr class="border">
                    <td class="p-2 border">{{ $detail->barang->nama_barang }}</td>
                    <td class="p-2 border">Rp{{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                    <td class="p-2 border">{{ $detail->jumlah }}</td>
                    <td class="p-2 border">Rp{{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('pembelian.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mt-4 inline-block">
            Kembali
        </a>
    </div>
</div>
@endsection
