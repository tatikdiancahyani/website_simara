<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_konsumsi',
        'tanggal_pengadaan',
        'jumlah',
        'anggaran',
        'harga',
        'pajak',
        'total',
    ];
}