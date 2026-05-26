<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\Buku;

class AdminPeminjamanController extends Controller
{
    public function index(Request $request)
{
    $query = Peminjaman::with('user', 'buku');

    if($request->status){
        $query->where('status', $request->status);
    }

    if($request->search){
        $query->whereHas('user', function($q) use ($request){
            $q->where('name', 'like', '%'.$request->search.'%');
        })->orWhereHas('buku', function($q) use ($request){
            $q->where('judul', 'like', '%'.$request->search.'%');
        });
    }

    $data = $query->latest()->get();

   return view('admin.kelolapeminjaman', compact('data'));
}

    public function terima($id)
{
    $pinjam = Peminjaman::findOrFail($id);

    $pinjam->status = 'disetujui';

    $pinjam->status_pengembalian = 'belum';

    $pinjam->save();

    $buku = Buku::find($pinjam->buku_id);

    if($buku && $buku->stok > 0){

        $buku->stok -= 1;

        $buku->save();
    }

    return response()->json([
        'success' => true
    ]);
}

   public function tolak(Request $request, $id)
{
    $pinjam = Peminjaman::findOrFail($id);

    $pinjam->status = 'ditolak';

    $pinjam->alasan_penolakan =
    $request->alasan_penolakan;

    $pinjam->save();

    return response()->json([
        'success' => true
    ]);
}
}