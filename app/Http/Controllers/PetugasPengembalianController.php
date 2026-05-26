<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PetugasPengembalianController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'buku'])
            ->where('status', 'disetujui');

        // FILTER STATUS
        if($request->status){

            $query->where(
                'status_pengembalian',
                $request->status
            );
        }

        // SEARCH
        if($request->search){

            $query->where(function($q) use ($request){

                $q->whereHas('user', function($user) use ($request){

                    $user->where(
                        'name',
                        'like',
                        '%'.$request->search.'%'
                    );

                })->orWhereHas('buku', function($buku) use ($request){

                    $buku->where(
                        'judul',
                        'like',
                        '%'.$request->search.'%'
                    );

                });

            });
        }

        $data = $query->latest()->get();

        return view(
            'petugas.pengembalian',
            compact('data')
        );
    }

    // TERIMA
    public function terima($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->status_pengembalian =
        'dikembalikan';

        $pinjam->save();

        return back();
    }

    // TOLAK
    public function tolak(Request $request, $id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->status_pengembalian =
        'ditolak';

        $pinjam->alasan_penolakan =
        $request->alasan_penolakan;

        $pinjam->save();

        return back();
    }
}