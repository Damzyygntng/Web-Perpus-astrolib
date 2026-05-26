<?php
// app/Http/Controllers/LaporanUserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanUserController extends Controller
{
   public function index(Request $request)
{
    $search = $request->search;

    $users = User::where('role', 'user')
        ->when($search, function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('lokasi', 'like', '%' . $search . '%');

            });

        })
        ->latest()
        ->get();

    return view('admin.laporanuser', compact('users'));
}

    public function cetakPdf() 
{
    $users = User::where('role', 'user')->latest()->get();

    Carbon::setLocale('id');

    $tanggal = Carbon::now()->translatedFormat('d F Y');

    $pdf = Pdf::loadView('admin.cetakuser', compact('users', 'tanggal'));

    $pdf->setPaper('A4', 'landscape');

    $pdf->setOptions([
        'isRemoteEnabled' => true,
        'isHtml5ParserEnabled' => true,
    ]);

    return $pdf->download('laporan-data-user.pdf');
}
}