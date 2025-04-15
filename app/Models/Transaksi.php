<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model {
    use HasFactory;

    protected $table = 'transaksis';
    protected $fillable = ['kode_transaksi', 'tanggal_transaksi', 'total_harga'];
}
