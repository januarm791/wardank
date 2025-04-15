@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-center">
        <div class="w-full max-w-2xl">
            <!-- Card Tambah Pemasok -->
            <div class="bg-white shadow-md rounded-xl p-6">
                <h2 class="text-lg font-semibold text-gray-700 text-center mb-4">Tambah Pemasok</h2>
                <form action="{{ route('pemasok.store') }}" method="POST">
                    @csrf
                    <div class="flex items-center">
                        <input type="text" name="nama_pemasok" class="flex-1 p-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Masukkan nama pemasok" required>
                        <button type="submit" class="bg-blue-600 text-white font-semibold py-3 px-5 rounded-r-lg hover:bg-blue-700 transition duration-300">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>

            <!-- Card Daftar Pemasok -->
            <div class="bg-white shadow-md rounded-xl mt-6 p-6">
                <h2 class="text-lg font-semibold text-gray-700 text-center mb-4">Daftar Pemasok</h2>
                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <table class="w-full border-collapse">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="p-3 text-left">#</th>
                                <th class="p-3 text-left">Nama Pemasok</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($pemasok as $p)
                                <tr>
                                    <td class="p-3 font-medium text-gray-700">{{ $loop->iteration }}</td>
                                    <td class="p-3 text-gray-700">{{ $p->nama_pemasok }}</td>
                                    <td class="p-3 flex justify-center space-x-2">
                                        <button onclick="toggleModal('editModal{{ $p->id }}')" class="bg-yellow-400 text-white px-4 py-2 rounded-lg hover:bg-yellow-500 transition">
                                            Edit
                                        </button>
                                        <form action="{{ route('pemasok.destroy', $p->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus pemasok ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                  
                                <!-- Modal Edit -->
                                <div id="editModal{{ $p->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                                    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Edit Pemasok</h3>
                                        <form action="{{ route('pemasok.update', $p->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="mb-3">
                                                <label class="block text-gray-700 font-medium">Nama Pemasok</label>
                                                <input type="text" name="nama_pemasok" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ $p->nama_pemasok }}" required>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button type="submit" class="w-full bg-green-500 text-white font-bold py-3 rounded-lg hover:bg-green-600 transition">
                                                    Simpan
                                                </button>
                                                <button type="button" onclick="toggleModal('editModal{{ $p->id }}')" class="w-full bg-gray-400 text-white font-bold py-3 rounded-lg hover:bg-gray-500 transition">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Alert sukses --}}
                @if (session('success'))
                    <div class="bg-green-500 text-white text-center p-3 mt-4 rounded-lg shadow">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function toggleModal(id) {
        let modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }
</script>

@endsection
