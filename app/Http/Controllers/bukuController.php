<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Kategori;

use App\Models\buku;
use Illuminate\Http\Request;

class bukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // BukuController
    public function index()
    {
        return view('buku.index', ['buku' => Buku::with(['author', 'kategori'])->latest()->get()]);
    }
    public function create()
    {
        return view('buku.create', [
            'authors' => Author::all(),
            'kategoris' => Kategori::all(),
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'stock' => 'required|integer|min:0',
        ]);
        Buku::create($validated);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }
    public function edit(Buku $buku)
    {
        return view('buku.edit', [
            'buku' => $buku,
            'authors' => Author::all(),
            'kategoris' => Kategori::all(),
        ]);
    }
    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'stock' => 'required|integer|min:0',
        ]);
        $buku->update($validated);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
