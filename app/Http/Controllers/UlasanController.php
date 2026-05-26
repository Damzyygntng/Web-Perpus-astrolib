<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;

class UlasanController extends Controller
{
    public function index()
    {
        $ulasans = Ulasan::with('user', 'buku')->latest()->get();

        return view('admin.ulasan', compact('ulasans'));
    }

    public function store(Request $request)
    {
        Ulasan::create([
            'user_id' => auth()->id(),
            'buku_id' => $request->buku_id,
            'rating' => $request->rating,
            'komentar' => $request->ulasan,
        ]);

        return back();
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);

        $ulasan->delete();

        return back();
    }
}