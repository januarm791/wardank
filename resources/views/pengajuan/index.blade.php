@extends('layouts.kasir')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-gray-700">Daftar Pengajuan Barang</h1>

        {{-- Tombol Tambah dan Export --}}
        <div class="flex items-center gap-3 mt-4">
            <a href="{{ route('pengajuan.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
                + Tambah Pengajuan
            </a>
            <a href="{{ route('export.excel') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                Export Excel
            </a>
            <a href="{{ route('export.pdf') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow">
                Export PDF
            </a>
        </div>

        {{-- Tabel Data --}}
        <div class="overflow-x-auto mt-6 bg-white rounded shadow">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-600 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama Pengaju</th>
                        <th class="px-4 py-2 border">Nama Barang</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Qty</th>
                        <th class="px-4 py-2 border text-center">Status</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border">{{ $item->nama_pengaju ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $item->nama_barang }}</td>
                            <td class="px-4 py-2 border text-center">
                                {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-2 border text-center">{{ $item->jumlah }}</td>
                            <td class="px-4 py-2 border text-center">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only toggle-status" data-id="{{ $item->id }}"
                                        {{ $item->status === 'Terpenuhi' ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 rounded-full shadow-inner relative transition peer-checked:bg-green-500">
                                        <div
                                            class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition transform
                                            {{ $item->status === 'Terpenuhi' ? 'translate-x-5' : '' }}">
                                        </div>
                                    </div>
                                </label>
                            </td>
                            <td class="px-4 py-2 border text-center">
                                <form action="{{ route('pengajuan.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Toast notification --}}
        <div id="toast-success"
            class="hidden fixed bottom-5 right-5 flex items-center p-4 mb-4 w-72 text-green-800 bg-green-100 rounded-lg shadow"
            role="alert">
            <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="text-sm font-medium">Status berhasil diperbarui</span>
        </div>
    </div>

    {{-- Script switch on/off status --}}
    <script>
        const showToast = () => {
            const toast = document.getElementById('toast-success');
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        };

        document.querySelectorAll('.toggle-status').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const id = this.dataset.id;
                const status = this.checked ? 'Terpenuhi' : 'Belum Terpenuhi';

                fetch(`/pengajuan/${id}/update-status`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            status: status
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log('Status updated:', data);
                        this.nextElementSibling.querySelector('.dot').classList.toggle('translate-x-5',
                            this.checked);
                        showToast();
                    })
                    .catch(err => {
                        alert('Gagal mengubah status!');
                        console.error(err);
                    });
            });
        });
    </script>
@endsection
