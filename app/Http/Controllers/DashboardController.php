<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Author;
use App\Models\Kategori;
use App\Models\Kelas;
use App\Models\Siswa;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    return view('dashboard', [
        'totalBuku'     => Buku::count(),
        'totalStock'    => Buku::sum('stock'),
        'totalAuthor'   => Author::count(),
        'totalKategori' => Kategori::count(),
        'totalKelas'    => Kelas::count(),
        'totalSiswa'    => Siswa::count(),

        'bukuTerbaru'   => Buku::with(['author', 'kategori'])->latest()->take(5)->get(),
        'kelasList'     => Kelas::withCount('siswa')->get(),
        'kategoriList'  => Kategori::withCount('buku')->get(),
    ]);
}
}
