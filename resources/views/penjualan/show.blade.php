@extends('layouts.kasir')

@section('title', 'Detail Penjualan')

@section('content')
<div class="container mt-4">
    <h4>Detail Penjualan - {{ $penjualan->no_faktur }}</h4>
    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($penjualan->tgl_faktur)->format('d M Y') }}</p>
    <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->nama }}</p>
    <p><strong>Total Bayar:</strong> Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</p>

    <h5>Barang Terjual</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan->detailPenjualan as $detail)
                <tr>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">🔙 Kembali</a>
</div>
@endsection
