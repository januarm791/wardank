@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Transaksi Pembelian</h1>
    
    <a href="{{ route('pembelian.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
        Tambah Pembelian
    </a>

    <div class="bg-white p-6 rounded shadow-md">
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Kode</th>
                    <th class="p-2 border">Tanggal</th>
                    <th class="p-2 border">Pemasok</th>
                    <th class="p-2 border">Total</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembelian as $item)
                <tr class="border">
                    <td class="p-2 border">{{ $item->kode_masuk }}</td>
                    <td class="p-2 border">{{ $item->tanggal_masuk }}</td>
                    <td class="p-2 border">{{ $item->pemasok->nama }}</td>
                    <td class="p-2 border">Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                    <td class="p-2 border text-center">
                        <a href="{{ route('pembelian.show', $item->id) }}" class="text-blue-500">Detail</a>
                        <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
