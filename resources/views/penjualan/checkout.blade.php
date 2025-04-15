{{-- resources/views/penjualan/checkout.blade.php --}}
@extends('layouts.kasir')
@section('title', 'Pembayaran')
@section('content')
    <div class="container mx-auto p-4 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">Pembayaran</h2>

        <p><strong>Pelanggan:</strong> {{ $pelanggan->nama }}</p>

        <table class="w-full mt-4 mb-4 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Barang</th>
                    <th class="p-2">Harga</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="p-2">{{ $item['nama'] }}</td>
                        <td class="p-2">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td class="p-2">{{ $item['jumlah'] }}</td>
                        <td class="p-2">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="bg-gray-100 font-bold">
                    <td colspan="3" class="p-2 text-right">Total</td>
                    <td class="p-2">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <form action="{{ route('penjualan.store') }}" method="POST">
            @csrf
            @foreach ($data['barang_id'] as $i => $id)
                <input type="hidden" name="barang_id[]" value="{{ $id }}">
                <input type="hidden" name="jumlah[]" value="{{ $data['jumlah'][$i] }}">
            @endforeach
            <input type="hidden" name="pelanggan_id" value="{{ $data['pelanggan_id'] }}">

            <div class="mb-4">
                <label class="block font-semibold">Uang Bayar</label>
                <input type="number" name="uang_bayar" min="{{ $total }}" required
                    class="border px-3 py-2 w-full rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Transaksi</button>
        </form>
    </div>
@endsection
