<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // tampil data kategori
    public function index()
    {
        $kategori = Kategori::all();

        return view('admin.kategori', compact('kategori'));
    }

    // tambah kategori
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required'
    ]);

    Kategori::create([
        'nama' => $request->nama
    ]);

    return redirect()->back();
}

    // edit kategori
    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required'
    ]);

    $kategori = Kategori::findOrFail($id);

    $kategori->update([
        'nama' => $request->nama
    ]);

    return redirect()->back();
}

    // hapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        return redirect()->back();
    }
}