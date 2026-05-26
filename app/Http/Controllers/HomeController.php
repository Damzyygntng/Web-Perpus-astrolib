<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ambil user login

        return view('user.home', compact('user'));
    }

    public function riwayat()
{
    $peminjaman = Peminjaman::with('buku')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('user.riwayat', compact('peminjaman'));
}
}