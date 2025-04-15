@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Laporan Barang</h1>

    <div class="mb-4 flex justify-end gap-2">
        <a href="{{ route('laporan.barang.excel') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Export Excel</a>
        <a href="{{ route('laporan.barang.pdf') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Export PDF</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">Kode</th>
                    <th class="py-2 px-4 border">Nama Barang</th>
                    <th class="py-2 px-4 border">Kategori</th>
                    <th class="py-2 px-4 border">Harga</th>
                    <th class="py-2 px-4 border">Stok</th>
                    <th class="py-2 px-4 border">Status Stok</th>
                    <th class="py-2 px-4 border">Total Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                    @php
                        $stok = $item->stok;
                        $status = 'Aman';
                        $statusClass = 'text-green-600 font-semibold';

                        if ($stok == 0) {
                            $status = 'Habis';
                            $statusClass = 'text-red-600 font-semibold';
                        } elseif ($stok < 5) {
                            $status = 'Menipis';
                            $statusClass = 'text-yellow-600 font-semibold';
                        }
                    @endphp
                    <tr>
                        <td class="py-2 px-4 border">{{ $item->kode_barang }}</td>
                        <td class="py-2 px-4 border">{{ $item->nama_barang }}</td>
                        <td class="py-2 px-4 border">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td class="py-2 px-4 border">Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td class="py-2 px-4 border">{{ $stok }}</td>
                        <td class="py-2 px-4 border {{ $statusClass }}">{{ $status }}</td>
                        <td class="py-2 px-4 border">Rp{{ number_format($stok * $item->harga_jual, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
