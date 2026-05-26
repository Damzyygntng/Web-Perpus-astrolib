<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();

        return view('admin.user', compact('users'));
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'lokasi' => $request->lokasi,
            'role' => 'user'
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        User::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back();
    }
}