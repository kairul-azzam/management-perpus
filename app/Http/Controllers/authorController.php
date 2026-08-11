<?php

namespace App\Http\Controllers;

use App\Models\author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        // withCount menghitung jumlah buku tiap author tanpa perlu load semua relasi bukunya
        $author = author::withCount('buku')->orderBy('nama_author')->get();

        return view('author.index', compact('author'));
    }

    public function create()
    {
        return view('author.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_author' => 'required|string|max:255',
        ]);

        author::create($validated);

        return redirect()->route('author.index')->with('success', 'Author berhasil ditambahkan.');
    }

    public function edit(author $author)
    {
        return view('author.edit', compact('author'));
    }

    public function update(Request $request, author $author)
    {
        $validated = $request->validate([
            'nama_author' => 'required|string|max:255',
        ]);

        $author->update($validated);

        return redirect()->route('author.index')->with('success', 'Author berhasil diperbarui.');
    }

    public function destroy(author $author)
    {
        // author yang masih punya buku terkait akan gagal dihapus jika foreign key
        // di migration diset restrict/tanpa onDelete cascade — itu wajar & mencegah data buku "yatim"
        $author->delete();

        return redirect()->route('author.index')->with('success', 'Author berhasil dihapus.');
    }
}