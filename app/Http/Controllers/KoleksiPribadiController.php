<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KoleksiPribadi;
use App\Models\Peminjaman;

class KoleksiPribadiController extends Controller
{
    public function store($id)
    {
        $cek = KoleksiPribadi::where('user_id', Auth::id())
            ->where('buku_id', $id)
            ->first();

        if (!$cek) {

            KoleksiPribadi::create([
                'user_id' => Auth::id(),
                'buku_id' => $id
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil');
    }

    public function index()
    {
        $koleksi = KoleksiPribadi::with('buku')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $peminjaman = Peminjaman::where('user_id', Auth::id())->get();

        $sedangDipinjam = Peminjaman::where('user_id', Auth::id())
            ->where('status', 'disetujui')
            ->count();

        return view('user.koleksiprib', compact(
            'koleksi',
            'peminjaman',
            'sedangDipinjam'
        ));
    }
}