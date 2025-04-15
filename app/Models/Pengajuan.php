<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_barangs';
    protected $fillable = ['nama_pengaju', 'nama_barang', 'jumlah', 'tanggal_pengajuan', 'status'];
}
