<!DOCTYPE html>
<html>
<head>
    <title>Laporan Uang Masuk</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Uang Masuk</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $jual)
            <tr>
                <td>{{ $jual->created_at->format('d-m-Y') }}</td>
                <td>{{ $jual->pelanggan->nama ?? '-' }}</td>
                <td>Rp{{ number_format($jual->total_bayar, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align: right; margin-top: 20px;">
        Total Uang Masuk: Rp{{ number_format($total, 0, ',', '.') }}
    </h3>
</body>
</html>
