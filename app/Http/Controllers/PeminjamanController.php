<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Buku;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

       $buku = Buku::findOrFail($request->buku_id);

Peminjaman::create([
    'user_id' => Auth::id(),
    'buku_id' => $request->buku_id,
    'judul_buku' => $buku->judul,
    'tanggal_pinjam' => $request->tanggal_pinjam,
    'tanggal_kembali' => $request->tanggal_kembali,
    'status' => 'menunggu',
    'status_pengembalian' => 'belum',
]);

        return redirect('/pinjam/'.$request->buku_id)->with('success', true);
    }

    public function cetakBukti($id)
{
    $pinjam = Peminjaman::with('buku')
        ->where('user_id', Auth::id())
        ->findOrFail($id);

    $pdf = Pdf::loadView('user.bukti-pdf', compact('pinjam'));

    return $pdf->download('bukti-peminjaman.pdf');
}


}
