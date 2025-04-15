<?php

namespace App\Exports;

use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangKeluarExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return BarangKeluar::with('barang')->get()->map(function ($item) {
            return [
                'tanggal' => $item->created_at->format('d-m-Y'),
                'nama_barang' => $item->barang->nama_barang ?? '-',
                'jumlah' => $item->jumlah,
                'keterangan' => $item->keterangan ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['Tanggal', 'Nama Barang', 'Jumlah', 'Keterangan'];
    }
}
