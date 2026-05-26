<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Registercontroller extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'lokasi' => 'required',
        ]);

        $jabodetabek = ['jakarta', 'bogor', 'depok', 'tangerang', 'bekasi'];

        $lokasi = strtolower(trim($request->lokasi));
        $valid = false;

        foreach ($jabodetabek as $area) {
            if (str_contains($lokasi, $area)) {
                $valid = true;
                break;
            }
        }

        if (!$valid) {
            return back()->withErrors([
                'lokasi' => 'Lokasi harus termasuk Jabodetabek'
            ])->withInput();
        }

        // 🔥 SIMPAN USER
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'lokasi' => $request->lokasi
        ]);

        // 🔥 AUTO LOGIN (INI YANG BENER)
        Auth::login($user);

        // 🔥 REDIRECT
        return redirect()->route('home');
    }
}