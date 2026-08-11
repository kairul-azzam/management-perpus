<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-2xl text-[color:var(--charcoal)]">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-10">

        {{-- ============ SAPAAN ============ --}}
        <div>
            <p class="font-display italic text-3xl text-[color:var(--charcoal)]">
                Selamat datang kembali, {{ explode(' ', Auth::user()->name)[0] }}.
            </p>
            <p class="text-sm text-[color:var(--charcoal)]/50 mt-1">
                {{ now()->translatedFormat('l, d F Y') }} &middot; Berikut ringkasan koleksi & data hari ini.
            </p>
        </div>

        {{-- ============ STAT CARDS ============ --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

            <div class="stat-card rounded-md p-5">
                <p class="text-[11px] tracking-[0.2em] uppercase text-[color:var(--charcoal)]/45">Total Buku</p>
                <p class="font-display text-4xl text-[color:var(--charcoal)] mt-2">{{ $totalBuku ?? 0 }}</p>
                <p class="text-xs text-[color:var(--gold-deep)] mt-1">{{ $totalStock ?? 0 }} eksemplar tersedia</p>
            </div>

            <div class="stat-card rounded-md p-5">
                <p class="text-[11px] tracking-[0.2em] uppercase text-[color:var(--charcoal)]/45">Author</p>
                <p class="font-display text-4xl text-[color:var(--charcoal)] mt-2">{{ $totalAuthor ?? 0 }}</p>
                <p class="text-xs text-[color:var(--charcoal)]/40 mt-1">penulis terdaftar</p>
            </div>

            <div class="stat-card rounded-md p-5">
                <p class="text-[11px] tracking-[0.2em] uppercase text-[color:var(--charcoal)]/45">Kategori</p>
                <p class="font-display text-4xl text-[color:var(--charcoal)] mt-2">{{ $totalKategori ?? 0 }}</p>
                <p class="text-xs text-[color:var(--charcoal)]/40 mt-1">klasifikasi buku</p>
            </div>

            <div class="stat-card rounded-md p-5">
                <p class="text-[11px] tracking-[0.2em] uppercase text-[color:var(--charcoal)]/45">Kelas</p>
                <p class="font-display text-4xl text-[color:var(--charcoal)] mt-2">{{ $totalKelas ?? 0 }}</p>
                <p class="text-xs text-[color:var(--charcoal)]/40 mt-1">rombongan belajar</p>
            </div>

            <div class="stat-card rounded-md p-5 col-span-2 md:col-span-1">
                <p class="text-[11px] tracking-[0.2em] uppercase text-[color:var(--charcoal)]/45">Siswa</p>
                <p class="font-display text-4xl text-[color:var(--charcoal)] mt-2">{{ $totalSiswa ?? 0 }}</p>
                <p class="text-xs text-[color:var(--charcoal)]/40 mt-1">anggota terdaftar</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- ============ BUKU TERBARU (relasi buku -> author, kategori) ============ --}}
            <div class="lg:col-span-3 stat-card rounded-md overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-[color:var(--charcoal)]/8">
                    <h3 class="font-display text-xl text-[color:var(--charcoal)]">Buku Terbaru</h3>
                    <a href="{{ route('buku.index') }}" class="text-xs tracking-[0.15em] uppercase text-[color:var(--gold-deep)] hover:text-[color:var(--charcoal)]">
                        Lihat semua
                    </a>
                </div>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-[11px] tracking-[0.15em] uppercase text-[color:var(--charcoal)]/40">
                            <th class="px-6 py-3 font-normal">Judul</th>
                            <th class="px-6 py-3 font-normal">Author</th>
                            <th class="px-6 py-3 font-normal">Kategori</th>
                            <th class="px-6 py-3 font-normal text-right">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($bukuTerbaru ?? []) as $buku)
                            <tr class="border-t border-[color:var(--charcoal)]/6">
                                <td class="px-6 py-3 text-[color:var(--charcoal)] font-medium">{{ $buku->judul_buku }}</td>
                                <td class="px-6 py-3 text-[color:var(--charcoal)]/70">{{ $buku->author->nama_author ?? '—' }}</td>
                                <td class="px-6 py-3">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[11px] bg-[color:var(--gold)]/15 text-[color:var(--gold-deep)]">
                                        {{ $buku->kategori->nama_kategori ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right text-[color:var(--charcoal)]/70">{{ $buku->stock }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-[color:var(--charcoal)]/40">
                                    Belum ada data buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ============ SISWA PER KELAS (relasi kelas -> siswa) ============ --}}
            <div class="lg:col-span-2 stat-card rounded-md overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-[color:var(--charcoal)]/8">
                    <h3 class="font-display text-xl text-[color:var(--charcoal)]">Siswa per Kelas</h3>
                    <a href="{{ route('kelas.index') }}" class="text-xs tracking-[0.15em] uppercase text-[color:var(--gold-deep)] hover:text-[color:var(--charcoal)]">
                        Lihat semua
                    </a>
                </div>

                <ul class="divide-y divide-[color:var(--charcoal)]/6">
                    @forelse (($kelasList ?? []) as $kelas)
                        <li class="flex items-center justify-between px-6 py-3">
                            <div>
                                <p class="text-[color:var(--charcoal)] font-medium">{{ $kelas->namakelas }}</p>
                                <p class="text-xs text-[color:var(--charcoal)]/40">Tingkat {{ $kelas->tingkat }}</p>
                            </div>
                            <span class="font-display text-2xl text-[color:var(--gold-deep)]">
                                {{ $kelas->siswa_count ?? $kelas->siswa->count() }}
                            </span>
                        </li>
                    @empty
                        <li class="px-6 py-8 text-center text-[color:var(--charcoal)]/40">
                            Belum ada data kelas.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- ============ KATEGORI TERPOPULER (relasi kategori -> buku) ============ --}}
        <div class="stat-card rounded-md overflow-hidden">
            <div class="px-6 py-4 border-b border-[color:var(--charcoal)]/8">
                <h3 class="font-display text-xl text-[color:var(--charcoal)]">Koleksi per Kategori</h3>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-px bg-[color:var(--charcoal)]/6">
                @forelse (($kategoriList ?? []) as $kategori)
                    <div class="bg-[color:var(--parchment-soft)] px-5 py-4">
                        <p class="text-sm text-[color:var(--charcoal)]/70 truncate">{{ $kategori->nama_kategori }}</p>
                        <p class="font-display text-2xl text-[color:var(--charcoal)] mt-1">
                            {{ $kategori->buku_count ?? $kategori->buku->count() }}
                        </p>
                    </div>
                @empty
                    <div class="bg-[color:var(--parchment-soft)] px-5 py-8 col-span-full text-center text-[color:var(--charcoal)]/40">
                        Belum ada data kategori.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>