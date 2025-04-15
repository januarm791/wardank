@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient text-white text-center" style="background: linear-gradient(45deg, #007bff, #6610f2);">
            <h4 class="fw-bold">Daftar Kategori</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="text-primary fw-bold">Kelola Kategori</h5>
                <a href="{{ route('kategori.create') }}" class="btn btn-success px-4">+ Tambah Kategori</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->nama_kategori }}</td>
                                <td>
                                    <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (session('success'))
                <div class="alert alert-success text-center mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
