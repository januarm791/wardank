@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="max-w-6xl mx-auto mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">📋 Daftar Pelanggan</h2>
        <a href="{{ route('pelanggan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Pelanggan</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-300 rounded shadow-sm">
        <thead class="bg-gray-200">
            <tr class="text-left">
                <th class="p-2">#</th>
                <th class="p-2">Kode</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Email</th>
                <th class="p-2">Telp</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggan as $p)
                <tr class="border-t">
                    <td class="p-2">{{ $loop->iteration }}</td>
                    <td class="p-2">{{ $p->kode_pelanggan }}</td>
                    <td class="p-2">{{ $p->nama }}</td>
                    <td class="p-2">{{ $p->email }}</td>
                    <td class="p-2">{{ $p->no_telp }}</td>
                    <td class="p-2 space-x-1">
                        <a href="{{ route('pelanggan.edit', $p->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">✏ Edit</a>
                        <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data?')">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">🗑 Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
