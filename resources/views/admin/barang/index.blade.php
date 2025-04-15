@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Barang</h1>
        <a href="{{ route('barang.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Barang</a>

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 mt-3 rounded">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border">Gambar</th>
                        <th class="py-2 px-4 border">Kode</th>
                        <th class="py-2 px-4 border">Nama Barang</th>
                        <th class="py-2 px-4 border">Harga</th>
                        <th class="py-2 px-4 border">Stok</th>
                        <th class="py-2 px-4 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $item)
                        <tr>
                            <td class="py-2 px-4 border">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar {{ $item->nama_barang }}"
                                        class="w-16 h-16 object-cover rounded">
                                @else
                                    <span class="text-gray-500 italic">Tidak ada</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border">{{ $item->kode_barang }}</td>
                            <td class="py-2 px-4 border">{{ $item->nama_barang }}</td>
                            <td class="py-2 px-4 border">Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                            <td class="py-2 px-4 border">{{ $item->stok }}</td>
                            <td class="py-2 px-4 border flex gap-2">
                                <a href="{{ route('barang.edit', $item) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('barang.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Hapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
