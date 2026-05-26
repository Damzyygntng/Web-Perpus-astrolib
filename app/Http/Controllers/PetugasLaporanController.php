<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;


class PetugasLaporanController extends Controller
{
    public function buku()
    {
        $bukus = Buku::latest()->get();

        return view(
            'petugas.laporanbuku',
            compact('bukus')
        );
    }

    public function cetakBuku()
    {
        $bukus = Buku::latest()->get();

        $pdf = Pdf::loadView(
            'petugas.cetakbuku',
            compact('bukus')
        );

        return $pdf->download('laporan-buku.pdf');
    }

    public function peminjaman()
{
    $data = Peminjaman::with('user', 'buku')
        ->latest()
        ->get();

    return view(
        'petugas.laporanpeminjaman',
        compact('data')
    );
}

public function cetakPeminjaman()
{
    $data = Peminjaman::with('user', 'buku')
        ->latest()
        ->get();

    $pdf = Pdf::loadView(
        'petugas.cetakpeminjaman',
        compact('data')
    );

    return $pdf->download(
        'laporan-peminjaman.pdf'
    );
}

public function pengembalian()
{
    $data = Peminjaman::with('user', 'buku')
        ->whereNotNull('status_pengembalian')
        ->latest()
        ->get();

    return view(
        'petugas.laporanpengembalian',
        compact('data')
    );
}

public function cetakPengembalian()
{
    $data = Peminjaman::with('user', 'buku')
        ->whereNotNull('status_pengembalian')
        ->latest()
        ->get();

    $tanggal = now()->format('d F Y');

    $pdf = Pdf::loadView(
        'petugas.cetakpengembalian',
        compact('data', 'tanggal')
    );

    return $pdf->download(
        'laporan-pengembalian.pdf'
    );
}
}