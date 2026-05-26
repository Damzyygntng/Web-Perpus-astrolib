<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

   protected $fillable = [
    'user_id',
    'buku_id',
    'judul_buku',
    'tanggal_pinjam',
    'tanggal_kembali',
    'status',
    'status_pengembalian',
    'denda'
];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function buku()
{
    return $this->belongsTo(\App\Models\Buku::class, 'buku_id');
}
}