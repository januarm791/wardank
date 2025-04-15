@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">Edit Produk</h1>
    <form action="{{ route('produk.update', $produk->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-600 text-sm mb-2">Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
        </div>
        <button type="submit" 
                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
            Update
        </button>
    </form>
</div>
@endsection
