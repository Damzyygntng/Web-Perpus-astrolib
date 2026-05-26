<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;

class PetugasKelolaBukuController extends Controller
{
    public function index(Request $request)
{
    $kategori = Kategori::all();

    $query = Buku::query();

    if($request->kategori){

        $query->where('kategori_id', $request->kategori);
    }

    $bukus = $query->latest()->get();

    foreach($bukus as $buku){

        $buku->dipinjam = Peminjaman::where('buku_id', $buku->id)
            ->count();
    }

    return view('petugas.kelolabuku', compact('bukus', 'kategori'));
}

    public function store(Request $request)
    {
        $cover = null;

        if($request->hasFile('cover')){

            $file = $request->file('cover');

            $namaFile = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('gambar'), $namaFile);

            $cover = 'gambar/'.$namaFile;
        }

        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'halaman' => $request->halaman,
            'isbn' => $request->isbn,
            'sinopsis' => $request->sinopsis,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'cover' => $cover,
        ]);

        return back()->with('success', 'Buku berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'kategori_id' => $request->kategori_id,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn' => $request->isbn,
            'halaman' => $request->halaman,
            'stok' => $request->stok,
            'sinopsis' => $request->sinopsis,
        ];

        if($request->hasFile('cover')){

            $file = $request->file('cover');

            $namaFile = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('gambar'), $namaFile);

            $data['cover'] = 'gambar/'.$namaFile;
        }

        $buku->update($data);

        return back()->with('success', 'Buku berhasil diupdate');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        $buku->delete();

        return back()->with('success', 'Buku berhasil dihapus');
    }
}