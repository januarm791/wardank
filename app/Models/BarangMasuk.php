<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';

    protected $fillable = [
        'nama_barang',
        'jumlah',
        'tanggal',
        'pemasok',
    ];
}
