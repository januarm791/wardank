@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Tambah Transaksi Pembelian</h1>

        <form action="{{ route('pembelian.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Pemasok</label>
                <select name="pemasok_id" class="w-full p-2 border rounded">
                    @foreach ($pemasok as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_pemasok }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="w-full p-2 border rounded">
            </div>

            <h2 class="text-lg font-semibold my-4">Detail Barang</h2>

            <div id="barang-container">
                <div class="barang-item mb-4">
                    <select name="barang_id[]" class="w-full p-2 border rounded">
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="harga_beli[]" placeholder="Harga Beli"
                        class="w-full p-2 border rounded mt-2">
                    <input type="number" name="jumlah[]" placeholder="Jumlah" class="w-full p-2 border rounded mt-2">
                </div>
            </div>

            <button type="button" id="tambah-barang" class="bg-green-500 text-white px-4 py-2 rounded mt-2">
                Tambah Barang
            </button>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Simpan</button>
        </form>
    </div>

    <script>
        document.getElementById('tambah-barang').addEventListener('click', function() {
            let container = document.getElementById('barang-container');
            let newItem = document.querySelector('.barang-item').cloneNode(true);
            container.appendChild(newItem);
        });
    </script>
@endsection
