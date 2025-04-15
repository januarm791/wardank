@extends('layouts.kasir')

@section('title', 'Daftar Penjualan')
@section('header', 'Daftar Penjualan')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-lg p-6 rounded-xl">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('penjualan.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition-all">
                + Tambah Penjualan
            </a>
        </div>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg mb-5 shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabel Penjualan --}}
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md">
                <thead class="bg-blue-600 text-white text-sm uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4 text-center">No</th>
                        <th class="py-3 px-4 text-center">No Faktur</th>
                        <th class="py-3 px-4 text-center">Tanggal</th>
                        <th class="py-3 px-4 text-left">Pelanggan</th>
                        <th class="py-3 px-4 text-right">Total Bayar</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penjualan as $p)
                        <tr class="border-t border-gray-200 hover:bg-gray-50 transition-all">
                            <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 font-semibold text-center">{{ $p->no_faktur }}</td>
                            <td class="py-3 px-4 text-center">{{ \Carbon\Carbon::parse($p->tgl_faktur)->format('d M Y') }}</td>
                            <td class="py-3 px-4 text-left">{{ $p->pelanggan->nama }}</td>
                            <td class="py-3 px-4 text-right">Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('penjualan.show', $p->id) }}"
                                       class="bg-info text-white text-sm px-3 py-1.5 rounded hover:bg-blue-500 transition-all">
                                        Detail
                                    </a>
                                    <form action="{{ route('penjualan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white text-sm px-3 py-1.5 rounded hover:bg-red-600 transition-all">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-gray-500 italic">Tidak ada transaksi penjualan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
