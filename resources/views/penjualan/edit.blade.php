@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>✏ Edit Transaksi</h4>
    <div class="card shadow-sm p-4">
        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label class="form-label">Kode Transaksi</label>
                <input type="text" name="kode_transaksi" class="form-control" value="{{ $transaksi->kode_transaksi }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal_transaksi" class="form-control" value="{{ $transaksi->tanggal_transaksi }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Total Harga</label>
                <input type="number" name="total_harga" class="form-control" value="{{ $transaksi->total_harga }}" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
