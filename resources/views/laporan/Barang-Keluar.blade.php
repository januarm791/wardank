@extends('layouts.kasir')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Laporan Barang Keluar</h1>

    <div class="mb-4 flex justify-end gap-2">
        <a href="{{ route('laporan.barang-keluar.pdf') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Export PDF</a>
        <a href="{{ route('laporan.barang-keluar.excel') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Export Excel</a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border">Tanggal</th>
                    <th class="py-2 px-4 border">Nama Barang</th>
                    <th class="py-2 px-4 border">Jumlah</th>
                    <th class="py-2 px-4 border">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td class="py-2 px-4 border">{{ $item->created_at->format('d-m-Y') }}</td>
                    <td class="py-2 px-4 border">{{ $item->barang->nama_barang ?? '-' }}</td>
                    <td class="py-2 px-4 border">{{ $item->jumlah }}</td>
                    <td class="py-2 px-4 border">{{ $item->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
