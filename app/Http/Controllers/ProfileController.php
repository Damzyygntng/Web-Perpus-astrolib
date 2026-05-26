<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->lokasi = $request->lokasi;

        $user->save();

        return back()->with('success', 'Profile berhasil diupdate');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama salah');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/peminjaman')->with('success', 'Password berhasil diupdate');
    }

    public function updatePhoto(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $user = Auth::user();

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');

        // simpan ke storage
        $path = $file->store('uploads', 'public');

        // simpan nama file ke database
        $user->photo = basename($path);
        $user->save();
    }

    return redirect('/peminjaman')->with('success', 'Foto berhasil diupdate');
}
}


