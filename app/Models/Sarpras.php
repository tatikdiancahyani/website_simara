<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarpras extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sarpras',
        'tanggal_pengadaan',
        'jumlah',
        'anggaran',
        'harga',
        'pajak',
        'total',
    ];
}
