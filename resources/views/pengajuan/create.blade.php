@extends('layouts.kasir')

@section('content')
    <div class="container max-w-xl mx-auto py-6">
        <h4 class="text-xl font-bold mb-4">Tambah Pengajuan Barang</h4>

        <form action="{{ route('pengajuan.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nama Pengaju (Opsional) --}}
            <div>
                <label class="block font-medium text-gray-700 mb-1">Nama Pengaju</label>
                <input type="text" name="nama_pengaju" class="w-full border rounded px-3 py-2" placeholder="Opsional">
            </div>

            {{-- Nama Barang --}}
            <div>
                <label class="block font-medium text-gray-700 mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Jumlah --}}
            <div>
                <label class="block font-medium text-gray-700 mb-1">Jumlah</label>
                <input type="number" name="jumlah" class="w-full border rounded px-3 py-2" required min="1">
            </div>

            {{-- Tanggal Pengajuan --}}
            <div>
                <label class="block font-medium text-gray-700 mb-1">Tanggal Pengajuan</label>
                <input type="date" name="tanggal_pengajuan" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Aksi --}}
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                    💾 Simpan
                </button>
                <a href="{{ route('pengajuan.index') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded shadow hover:bg-gray-400">
                    🔙 Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
