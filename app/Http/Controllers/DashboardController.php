<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Ulasan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();

        $bukuDipinjam = Peminjaman::where('status', '!=', 'ditolak')->count();

        $totalUser = User::where('role', 'user')->count();

        $totalPetugas = User::where('role', 'petugas')->count();

        $totalUlasan = Ulasan::count();

        return view('admin.dashboard', compact(
            'totalBuku',
            'bukuDipinjam',
            'totalUser',
            'totalPetugas',
            'totalUlasan'
        ));
    }
}