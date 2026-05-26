<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuController extends Controller
{
    // 🔹 HALAMAN KOLEKSI
    public function index()
    {
        $buku = Buku::all();

        $rekomendasi = Buku::whereIn('id', [2, 4, 8, 9, 10, 11])->get();

        $kategori = Kategori::all();

        return view('user.koleksibuku', compact('buku', 'rekomendasi', 'kategori'));
    }

    // 🔹 HALAMAN DETAIL
   public function show($id, Request $request)
{
    $buku = Buku::with('ulasans.user')->findOrFail($id);

    $showUlasan = $request->ulasan;

    return view('user.detail', compact(
        'buku',
        'showUlasan'
    ));
}

    public function pinjam($id)
    {
        $buku = Buku::findOrFail($id);

        return view('user.pinjam', compact('buku'));
    }

    // 🔹 HALAMAN ADMIN KELOLA BUKU
public function kelola(Request $request)
{
    $kategori = Kategori::all();

    $query = Buku::query();

    if ($request->kategori) {

        $query->where('kategori_id', $request->kategori);
    }

    $bukus = $query->withCount([
        'peminjamans as dipinjam' => function ($query) {
            $query->where('status', 'disetujui');
        }
    ])->get();

    return view('admin.buku', compact('bukus', 'kategori'));
}

// 🔹 TAMBAH BUKU
public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'penulis' => 'required',
        'kategori_id' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required',
        'isbn' => 'required',
        'halaman' => 'required',
        'stok' => 'required',
        'cover' => 'nullable|image|mimes:jpg,jpeg,png'
    ]);

    $cover = null;

    if ($request->hasFile('cover')) {

        $file = $request->file('cover');

       $cover = $file->getClientOriginalName();

        $file->move(public_path('gambar'), $cover);
    }

    Buku::create([
        'cover' => $cover,
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'kategori_id' => $request->kategori_id,
        'penerbit' => $request->penerbit,
        'tahun_terbit' => $request->tahun_terbit,
        'isbn' => $request->isbn,
        'halaman' => $request->halaman,
        'stok' => $request->stok,
        'sinopsis' => $request->sinopsis
    ]);

    return redirect()->back();
}

// 🔹 UPDATE BUKU
public function update(Request $request, $id)
{
    $buku = Buku::findOrFail($id);

    $cover = $buku->cover;

    if ($request->hasFile('cover')) {

        $file = $request->file('cover');

        $cover = $file->getClientOriginalName();

        $file->move(public_path('gambar'), $cover);
    }

    $buku->update([
        'cover' => $cover,
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'kategori_id' => $request->kategori_id,
        'penerbit' => $request->penerbit,
        'tahun_terbit' => $request->tahun_terbit,
        'isbn' => $request->isbn,
        'halaman' => $request->halaman,
        'stok' => $request->stok,
        'sinopsis' => $request->sinopsis
    ]);

    return redirect()->back();
}

// 🔹 HAPUS BUKU
public function destroy($id)
{
    $buku = Buku::findOrFail($id);

    $buku->delete();

    return redirect()->back();
}
}