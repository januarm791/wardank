@extends('layouts.kasir')

@section('title', 'Daftar Transaksi')
@section('header', 'Daftar Transaksi')

@section('content')
<div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Daftar Penjualan</h2>
    <a href="{{ route('penjualan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-3 inline-block">Tambah Penjualan</a>

    <table class="w-full border-collapse border border-gray-300 mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">No Faktur</th>
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Pelanggan</th>
                <th class="border px-4 py-2">Total Bayar</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan as $jual)
            <tr class="text-center">
                <td class="border px-4 py-2">{{ $jual->no_faktur }}</td>
                <td class="border px-4 py-2">{{ $jual->tgl_faktur }}</td>
                <td class="border px-4 py-2">{{ $jual->pelanggan->nama }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($jual->total_bayar, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('penjualan.show', $jual->id) }}" class="bg-green-500 text-white px-3 py-1 rounded">Detail</a>
                    <form action="{{ route('penjualan.destroy', $jual->id) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
