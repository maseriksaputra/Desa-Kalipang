<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = \App\Models\User::where('role', 'pegawai')->get();
        return view('admin.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('admin.pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'department' => 'required|string|max:255',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'pegawai',
            'department' => $request->department,
        ]);

        return redirect()->route('admin.pegawai.index')->with('success', 'Akun pegawai berhasil ditambahkan.');
    }

    public function edit(\App\Models\User $pegawai)
    {
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, \App\Models\User $pegawai)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$pegawai->id,
            'department' => 'required|string|max:255',
        ]);

        $pegawai->update([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
        ]);

        if ($request->password) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $pegawai->update(['password' => \Illuminate\Support\Facades\Hash::make($request->password)]);
        }

        return redirect()->route('admin.pegawai.index')->with('success', 'Akun pegawai berhasil diperbarui.');
    }

    public function destroy(\App\Models\User $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('admin.pegawai.index')->with('success', 'Akun pegawai berhasil dihapus.');
    }
}
