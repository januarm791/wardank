@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="max-w-xl mx-auto mt-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Tambah Pelanggan</h2>

        <form action="{{ route('pelanggan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-semibold">Kode Pelanggan</label>
                <input name="kode_pelanggan" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Nama</label>
                <input name="nama" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block font-semibold">Alamat</label>
                <input name="alamat" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-semibold">No. Telepon</label>
                <input name="no_telp" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded">
            </div>
            <div class="flex justify-between">
                <a href="{{ route('pelanggan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">⬅ Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">💾 Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
