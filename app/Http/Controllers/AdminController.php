<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;

class AdminController extends Controller
{
public function loginAdmin(Request $request)
{
    $credentials = $request->only('email', 'password');

    // cek email + password dulu
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // cek role
        if ($user->role === 'admin') {
            return redirect('/dashboard-admin');
        } else {
            Auth::logout();
            return back()->with('error', 'Bukan akun admin!');
        }
    }

    // kalau email / password salah
    return back()->with('error', 'Email atau password salah!');
}

public function index()
{
    $data = Peminjaman::with(['user', 'buku'])->get();
   return view('admin.kelolapeminjaman', compact('data'));
}

public function terima($id)
{
    $pinjam = Peminjaman::findOrFail($id);
    $pinjam->status = 'disetujui';
    $pinjam->save();

    return back();
}

public function tolak($id)
{
    $pinjam = Peminjaman::findOrFail($id);
    $pinjam->status = 'ditolak';
    $pinjam->save();

    return back();
}

}
