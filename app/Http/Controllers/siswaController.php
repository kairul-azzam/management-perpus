<?php


namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = siswa::with('kelas')->latest()->get();

        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        $kelasList = kelas::orderBy('namakelas')->get();

        return view('siswa.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'nis'      => 'required|string|max:50|unique:siswas,nis',
            'kelas_id' => 'required|exists:kelas,id',
            
        ]);

        siswa::create($validated);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(siswa $siswa)
    {
        $kelasList = kelas::orderBy('namakelas')->get();

        return view('siswa.edit', compact('siswa', 'kelasList'));
    }

    public function update(Request $request, siswa $siswa)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'nis'      => 'required|string|max:50|unique:siswas,nis,' . $siswa->id,
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa->update($validated);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy(siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
