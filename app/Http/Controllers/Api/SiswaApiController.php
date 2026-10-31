<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\siswa;
use Illuminate\Http\Request;

class SiswaApiController extends Controller
{
    public function index()
    {
        $siswa = siswa::with('kelas')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diambil',
            'data' => $siswa
        ], 200);
    }

    public function show($id)
    {
        $siswa = siswa::with('kelas')->find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Siswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail siswa berhasil diambil',
            'data' => $siswa
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:50',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa = siswa::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Siswa berhasil ditambahkan',
            'data' => $siswa
        ], 201);
    }
}