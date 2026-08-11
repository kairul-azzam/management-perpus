<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;



namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = kelas::withCount('siswa')->orderBy('namakelas')->get();

        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'namakelas' => 'required|string|max:255',
            'tingkat'   => 'required|string|max:50',
        ]);

        kelas::create($validated);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, kelas $kelas)
    {
        $validated = $request->validate([
            'namakelas' => 'required|string|max:255',
            'tingkat'   => 'required|string|max:50',
        ]);

        $kelas->update($validated);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(kelas $kelas)
    {
        // siswa yang masih terdaftar di kelas ini akan gagal dihapus jika foreign key
        // di migration diset restrict/tanpa onDelete cascade — itu wajar & mencegah data siswa "yatim"
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}