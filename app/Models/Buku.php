<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
    'judul',
    'penulis',
    'penerbit',
    'tahun_terbit',
    'halaman',
    'isbn',
    'sinopsis',
    'stok',
    'cover',
    'kategori_id'
    ];

    public function kategori()
{
    return $this->belongsTo(Kategori::class);
}

    public function ulasan()
{
    return $this->hasMany(Ulasan::class);
}

public function peminjamans()
{
    return $this->hasMany(Peminjaman::class);
}

public function ulasans()
{
    return $this->hasMany(Ulasan::class);
}
}
