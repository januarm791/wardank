@extends('layouts.kasir')

@section('title', 'Detail Transaksi')
@section('header', 'Detail Transaksi')

@section('content')
<div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Detail Penjualan</h2>

    <p><strong>No Faktur:</strong> {{ $penjualan->no_faktur }}</p>
    <p><strong>Tanggal:</strong> {{ $penjualan->tgl_faktur }}</p>
    <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->nama }}</p>
    <p><strong>Total Bayar:</strong> Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</p>

    <h3 class="text-xl font-semibold mt-4">Detail Barang</h3>
    <table class="w-full border-collapse border border-gray-300 mt-2">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Nama Barang</th>
                <th class="border px-4 py-2">Harga</th>
                <th class="border px-4 py-2">Jumlah</th>
                <th class="border px-4 py-2">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan->detailPenjualan as $detail)
            <tr class="text-center">
                <td class="border px-4 py-2">{{ $detail->barang->nama_barang }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">{{ $detail->jumlah }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('penjualan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mt-4 inline-block">Kembali</a>
</div>
@endsection
