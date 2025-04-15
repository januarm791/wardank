@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 max-w-2xl">

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-yellow-400 px-6 py-4">
                <h2 class="text-center text-white text-xl font-semibold">Edit Kategori</h2>
            </div>
            <div class="px-6 py-6">
                <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Nama Kategori</label>
                        <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                        💾 Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection
