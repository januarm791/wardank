@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            @php
                $stats = [
                    ['label' => 'Total Barang', 'value' => $totalBarang, 'color' => 'bg-blue-500'],
                    [
                        'label' => 'Total Pembelian',
                        'value' => 'Rp ' . number_format($totalPembelian, 0, ',', '.'),
                        'color' => 'bg-yellow-500',
                    ],
                    ['label' => 'Total Pelanggan', 'value' => $totalPelanggan, 'color' => 'bg-indigo-500'],
                    ['label' => 'Total Pemasok', 'value' => $totalPemasok, 'color' => 'bg-red-500'],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div
                    class="{{ $stat['color'] }} text-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h2 class="text-lg font-semibold">{{ $stat['label'] }}</h2>
                    <p class="text-3xl font-bold mt-1">{{ $stat['value'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- Grafik -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Penjualan & Pembelian</h2>
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');

        const salesChartData = {
            labels: @json($pembelianData->pluck('tanggal')),
            datasets: [{
                label: 'Pembelian',
                data: @json($pembelianData->pluck('total')),
                borderColor: '#ff6384',
                backgroundColor: 'rgba(255, 99, 132, 0.3)',
                tension: 0.4,
                fill: true
            }]
        };

        new Chart(ctx, {
            type: 'line',
            data: salesChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#555'
                        },
                        grid: {
                            color: '#ddd'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#555'
                        },
                        grid: {
                            color: '#ddd'
                        }
                    }
                }
            }
        });
    </script>
@endsection 