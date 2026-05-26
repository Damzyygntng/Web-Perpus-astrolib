<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where('role', 'petugas')->get();

        return view('admin.petugas', compact('petugas'));
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas'
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        User::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back();
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return back();
    }
}