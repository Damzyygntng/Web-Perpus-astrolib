<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanBuku extends Model
{
    protected $table = 'pengajuan_buku';

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'cover',
        'stok',
        'status'
    ];
}