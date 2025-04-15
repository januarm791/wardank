@extends('layouts.kasir')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Laporan Uang Masuk</h1>

    <div class="mb-4 flex justify-between items-center">
        <!-- Filter Bulan -->
        <form action="{{ route('laporan.uang-masuk') }}" method="GET" class="flex items-center gap-2">
            <label for="bulan" class="text-sm font-medium">Pilih Bulan:</label>
            <input type="month" name="bulan" id="bulan" value="{{ request('bulan') }}" class="border rounded px-2 py-1">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Tampilkan</button>
        </form>

        <!-- Export Buttons -->
        <div class="flex gap-2">
            <a href="{{ route('laporan.uang-masuk.pdf', ['bulan' => request('bulan')]) }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Export PDF</a>
            <a href="{{ route('laporan.uang-masuk.excel', ['bulan' => request('bulan')]) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Export Excel</a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border">Tanggal</th>
                    <th class="py-2 px-4 border">Pelanggan</th>
                    <th class="py-2 px-4 border">Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $jual)
                <tr>
                    <td class="py-2 px-4 border">{{ $jual->created_at->format('d-m-Y') }}</td>
                    <td class="py-2 px-4 border">{{ $jual->pelanggan->nama ?? '-' }}</td>
                    <td class="py-2 px-4 border">Rp{{ number_format($jual->total_bayar, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 text-right text-xl font-semibold">
        Total Uang Masuk: Rp{{ number_format($total, 0, ',', '.') }}
    </div>
</div>
@endsection
