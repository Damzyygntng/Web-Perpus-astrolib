<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanPetugasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::where('role', 'petugas')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('admin.laporanpetugas', compact('users'));
    }

    public function cetak()
    {
        $users = User::where('role', 'petugas')->latest()->get();

        Carbon::setLocale('id');

        $tanggal = Carbon::now()->translatedFormat('d F Y');

        $pdf = Pdf::loadView('admin.cetakpetugas', compact('users', 'tanggal'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('laporan-petugas.pdf');
    }
}