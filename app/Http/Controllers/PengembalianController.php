<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PengembalianController extends Controller
{

    // HALAMAN USER
    public function index()
{
  $data = Peminjaman::with('buku')
    ->where('user_id', Auth::id())
    ->where('status', 'disetujui')
    ->latest()
    ->get();

    // BOX SEDANG DIPINJAM
   $sedangDipinjam = Peminjaman::where(
    'user_id',
    Auth::id()
)
->where('status', 'disetujui')
->where('status_pengembalian', 'belum')
->count();

    // BOX RIWAYAT
    $riwayatPeminjaman = Peminjaman::where(
        'user_id',
        Auth::id()
    )
    ->count();

    return view(
        'user.pengembalian',

        compact(
            'data',
            'sedangDipinjam',
            'riwayatPeminjaman'
        )
    );
}


    // USER KONFIRMASI PENGEMBALIAN
   public function konfirmasi($id)
{
    $pinjam = Peminjaman::findOrFail($id);

    $today = Carbon::now();

    $deadline = Carbon::parse($pinjam->tanggal_kembali);

    $telat = $today->greaterThan($deadline)
        ? $today->diffInDays($deadline)
        : 0;

    $denda = $telat * 5000;

    $pinjam->status_pengembalian = 'menunggu';
    $pinjam->denda = $denda;

    $pinjam->save();

    return response()->json([
        'success' => true
    ]);
}

    // HALAMAN ADMIN
public function admin(Request $request)
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
        'admin.kelolapengembalian',
        compact('data')
    );
}


   // TERIMA
public function terima($id)
{
    $pinjam = Peminjaman::findOrFail($id);

    $pinjam->status_pengembalian =
    'disetujui';

    $pinjam->save();

    return back();
}


// TOLAK
public function tolak(Request $request, $id)
{
    $pinjam = Peminjaman::findOrFail($id);

    $pinjam->status_pengembalian = 'ditolak';

    $pinjam->alasan_penolakan =
    $request->alasan_penolakan;

    $pinjam->save();

    return back();
}
    
public function cetakBukti($id)
{
    $pinjam = Peminjaman::with('buku', 'user')->findOrFail($id);

    return view('user.cetak-bukti', compact('pinjam'));
}

public function ajukanLagi($id)
{
    $pinjam = Peminjaman::findOrFail($id);

    $pinjam->status_pengembalian = 'menunggu';
    $pinjam->alasan_penolakan = null;

    $pinjam->save();

    return redirect('/pengembalian');
}


}