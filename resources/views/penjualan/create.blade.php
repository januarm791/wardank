@extends('layouts.kasir')
@section('title', 'Transaksi - Pilih Barang')
@section('content')
    <div class="container mx-auto p-4 bg-white rounded shadow">
        <form action="{{ route('penjualan.checkout') }}" method="POST">
            @csrf

            {{-- Input Pelanggan --}}
            <label class="block font-bold mb-1">Pelanggan</label>
            <select name="pelanggan_id" class="border p-2 w-full mb-4" required>
                @foreach ($pelanggan as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>

            {{-- Input Barcode --}}
            <label class="block font-bold mb-1 mt-4">Scan Barcode / kode_barang Barang</label>
            <input type="text" id="scan-barcode" class="border p-2 w-full mb-4" placeholder="Scan barcode di sini" autofocus>

            {{-- Container Barang --}}
            <div id="barang-container">
                <div class="flex gap-2 mb-2">
                    <select name="barang_id[]" class="border px-2 py-1 w-2/3 rounded">
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} - Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="jumlah[]" class="border px-2 py-1 w-1/3 rounded" placeholder="Jumlah" min="1">
                </div>
            </div>

            {{-- Tombol Tambah Manual dan Checkout --}}
            <button type="button" onclick="tambahBarang()" class="bg-green-500 text-white px-3 py-1 rounded mb-4">+ Tambah Barang</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lanjut ke Pembayaran</button>
        </form>
    </div>

    {{-- Script --}}
    <script>
        const barangList = @json($barang);

        // Tambah barang dengan scanner barcode
        document.getElementById('scan-barcode').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const barcode = this.value.trim();
                this.value = '';

                const barang = barangList.find(b => b.kode_barang === barcode);
                if (barang) {
                    tambahBarangDenganData(barang.id);
                } else {
                    alert('Barang dengan barcode "' + barcode + '" tidak ditemukan!');
                }
            }
        });

        // Tambah barang manual
        function tambahBarang() {
            const container = document.getElementById('barang-container');
            const html = `
                <div class="flex gap-2 mb-2">
                    <select name="barang_id[]" class="border px-2 py-1 w-2/3 rounded">
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} - Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="jumlah[]" class="border px-2 py-1 w-1/3 rounded" placeholder="Jumlah" min="1">
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        // Tambah barang otomatis setelah scan barcode
        function tambahBarangDenganData(idBarang) {
            const barang = barangList.find(b => b.id == idBarang);
            const container = document.getElementById('barang-container');

            const html = `
                <div class="flex gap-2 mb-2">
                    <select name="barang_id[]" class="border px-2 py-1 w-2/3 rounded">
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}" ${idBarang == {{ $b->id }} ? 'selected' : ''}>
                                {{ $b->nama_barang }} - Rp {{ number_format($b->harga_jual, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="jumlah[]" class="border px-2 py-1 w-1/3 rounded" placeholder="Jumlah" min="1" value="1">
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
@endsection
