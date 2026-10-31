<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\buku;
use Illuminate\Http\Request;

class BukuApiController extends Controller
{
    public function index()
    {
        $buku = buku::with(['author', 'kategori'])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data buku berhasil diambil',
            'data' => $buku
        ], 200);
    }

    public function show($id)
    {
        $buku = buku::with(['author', 'kategori'])->find($id);

        if (!$buku) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail buku berhasil diambil',
            'data' => $buku
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'stock' => 'required|integer|min:0',
        ]);

        $buku = buku::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan',
            'data' => $buku
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $buku = buku::find($id);

        if (!$buku) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'stock' => 'required|integer|min:0',
        ]);

        $buku->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil diperbarui',
            'data' => $buku
        ], 200);
    }

    public function destroy($id)
    {
        $buku = buku::find($id);

        if (!$buku) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        $buku->delete();

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus'
        ], 200);
    }
}
