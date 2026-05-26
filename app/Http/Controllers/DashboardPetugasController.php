<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardPetugasController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();

        $bukuDipinjam = Peminjaman::where('status', 'disetujui')->count();

         return view('petugas.petugas', compact(
            'totalBuku',
            'bukuDipinjam'
        ));
    }
}