<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;

class PetugasPeminjamanController extends Controller
{
    public function index(Request $request)
{
    $query = Peminjaman::with('user', 'buku');

    // FILTER STATUS
    if($request->status){

        $query->where('status', $request->status);
    }

    // SEARCH
    if($request->search){

        $query->where(function($q) use ($request){

            $q->whereHas('user', function($user) use ($request){

                $user->where('name', 'like', '%'.$request->search.'%');

            })->orWhereHas('buku', function($buku) use ($request){

                $buku->where('judul', 'like', '%'.$request->search.'%');

            });

        });
    }

    $data = $query->latest()->get();

    return view('petugas.peminjaman', compact('data'));
}

    public function setujui($id)
{
    $pinjam = Peminjaman::findOrFail($id);

    $pinjam->status = 'disetujui';

    $pinjam->save();

    return response()->json([
        'success' => true
    ]);
}

    public function tolak(Request $request, $id)
{
    $pinjam = Peminjaman::findOrFail($id);

    $pinjam->status = 'ditolak';

    $pinjam->save();

    return response()->json([
        'success' => true
    ]);
}
}