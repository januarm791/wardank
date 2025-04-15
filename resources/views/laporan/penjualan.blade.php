@extends('layouts.kasir')

@section('title', 'Laporan Penjualan')
@section('header', 'Laporan Penjualan')

@section('content')
<div class="container mx-auto">
    <div class="bg-white p-6 rounded-lg shadow-md">

        <h2 class="text-xl font-semibold mb-4">📋 Tabel Penjualan</h2>

        {{-- Filter & Search --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-4">
            <div class="flex gap-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                    <input type="date" id="tanggal-awal" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                    <input type="date" id="tanggal-akhir" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>
            </div>
            <div class="w-full md:w-1/3">
                <label class="block text-sm font-medium text-gray-700">Cari Transaksi</label>
                <input type="text" id="search-input" placeholder="Cari No Faktur atau Pelanggan..." class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
        </div>

        <div class="overflow-x-auto mb-6">
            <table id="penjualan-table" class="min-w-full table-auto text-center border border-gray-200">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-2">No</th>
                        <th class="p-2">No Faktur</th>
                        <th class="p-2">Tanggal</th>
                        <th class="p-2">Pelanggan</th>
                        <th class="p-2">Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penjualan as $p)
                        <tr class="border-b penjualan-row">
                            <td class="p-2">{{ $loop->iteration }}</td>
                            <td class="p-2 faktur">{{ $p->no_faktur }}</td>
                            <td class="p-2 tanggal">{{ \Carbon\Carbon::parse($p->tgl_faktur)->format('Y-m-d') }}</td>
                            <td class="p-2 pelanggan">{{ $p->pelanggan->nama }}</td>
                            <td class="p-2 text-right">Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 p-4">Tidak ada data penjualan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h2 class="text-xl font-semibold mb-4">📊 Grafik Total Penjualan per Bulan</h2>
        <canvas id="salesChart" height="100"></canvas>
    </div>
</div>

{{-- Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart
    const labels = @json($chartLabels);
    const data = @json($chartData);

    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Penjualan',
                data: data,
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    // Filter Data
    document.getElementById('search-input').addEventListener('input', filterTable);
    document.getElementById('tanggal-awal').addEventListener('change', filterTable);
    document.getElementById('tanggal-akhir').addEventListener('change', filterTable);

    function filterTable() {
        const search = document.getElementById('search-input').value.toLowerCase();
        const tAwal = document.getElementById('tanggal-awal').value;
        const tAkhir = document.getElementById('tanggal-akhir').value;

        document.querySelectorAll('.penjualan-row').forEach(row => {
            const faktur = row.querySelector('.faktur').textContent.toLowerCase();
            const pelanggan = row.querySelector('.pelanggan').textContent.toLowerCase();
            const tanggal = row.querySelector('.tanggal').textContent;

            const matchSearch = faktur.includes(search) || pelanggan.includes(search);
            const matchTanggal = (!tAwal || tanggal >= tAwal) && (!tAkhir || tanggal <= tAkhir);

            if (matchSearch && matchTanggal) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endsection
