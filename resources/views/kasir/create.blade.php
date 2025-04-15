@extends('layouts.kasir')

@section('title', 'Tambah Transaksi')
@section('header', 'Tambah Transaksi')

@section('content')
<div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Tambah Penjualan</h2>
    
    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf
        
        <label class="block mb-2">Pelanggan:</label>
        <select name="pelanggan_id" class="w-full border px-4 py-2 mb-4">
            @foreach($pelanggan as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach
        </select>

        <h3 class="text-lg font-semibold">Pilih Barang</h3>
        <div id="barang-container">
            <div class="flex gap-2 mb-2">
                <select name="barang_id[]" class="border px-4 py-2 w-2/3">
                    @foreach($barang as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_barang }} - Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</option>
                    @endforeach
                </select>
                <input type="number" name="jumlah[]" class="border px-4 py-2 w-1/3" placeholder="Jumlah">
            </div>
        </div>

        <button type="button" onclick="tambahBarang()" class="bg-green-500 text-white px-4 py-2 rounded">+ Tambah Barang</button>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 block">Simpan Transaksi</button>
    </form>
</div>

<script>
    function tambahBarang() {
        let container = document.getElementById('barang-container');
        let barangHtml = `
            <div class="flex gap-2 mb-2">
                <select name="barang_id[]" class="border px-4 py-2 w-2/3">
                    @foreach($barang as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_barang }} - Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</option>
                    @endforeach
                </select>
                <input type="number" name="jumlah[]" class="border px-4 py-2 w-1/3" placeholder="Jumlah">
            </div>`;
        container.insertAdjacentHTML('beforeend', barangHtml);
    }
</script>
@endsection
