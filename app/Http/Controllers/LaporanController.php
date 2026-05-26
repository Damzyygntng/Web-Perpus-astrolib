<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();

        return view('admin.laporanbuku', compact('bukus'));
    }

    public function cetakPdf()
{
    $bukus = Buku::all();

    Carbon::setLocale('id');

    $tanggal = Carbon::now()->translatedFormat('d F Y');

    $pdf = Pdf::loadView(
        'admin.cetak_laporan_buku',
        compact('bukus', 'tanggal')
    );

    $pdf->setPaper('A4', 'landscape');

    $pdf->setOptions([
        'isRemoteEnabled' => true,
        'isHtml5ParserEnabled' => true,
    ]);

    return $pdf->download('laporan-data-buku.pdf');
}
    
}