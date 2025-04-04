<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalRapat extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'tanggal',
        'waktu',
        'tempat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}