<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanPengembalianController extends Controller
{
   public function index(Request $request)
{
    $search = $request->search;

    $data = Peminjaman::with(['user', 'buku'])

        ->when($search, function ($query) use ($search) {

            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })

            ->orWhereHas('buku', function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%');
            });

        })

        ->latest()
        ->get();

    return view('admin.laporanpengembalian', compact('data'));
}

    public function cetak()
{
    $data = Peminjaman::with(['user', 'buku'])
        ->latest()
        ->get();

    $tanggal = Carbon::now()->translatedFormat('d F Y');

    $pdf = Pdf::loadView(
        'admin.cetakpengembalian',
        compact('data', 'tanggal')
    )->setPaper('A4', 'landscape');

   return $pdf->download('laporan-pengembalian.pdf');
}
}