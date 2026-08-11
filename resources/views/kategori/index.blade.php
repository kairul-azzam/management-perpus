<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-2xl text-[color:var(--charcoal)]">Data Kategori</h2>
    </x-slot>

    <div class="space-y-6">

        @if (session('success'))
            <div class="stat-card border-l-4 !border-l-[color:var(--gold)] rounded-md px-5 py-3 text-sm text-[color:var(--charcoal)]">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <p class="text-sm text-[color:var(--charcoal)]/50">
                Satu Kategori bisa memiliki <span class="text-[color:var(--gold-deep)]">banyak Buku</span>.
            </p>
            <a href="{{ route('kategori.create') }}" class="brass-btn inline-flex items-center gap-2 px-5 py-2.5 rounded-sm text-parchment font-body text-sm tracking-[0.15em] uppercase">
                + Tambah Kategori
            </a>
        </div>

        <div class="stat-card rounded-md overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-[11px] tracking-[0.15em] uppercase text-[color:var(--charcoal)]/40">
                        <th class="px-6 py-3 font-normal">Nama Kategori</th>
                        <th class="px-6 py-3 font-normal">Jumlah Buku</th>
                        <th class="px-6 py-3 font-normal text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $item)
                        <tr class="border-t border-[color:var(--charcoal)]/6">
                            <td class="px-6 py-3 text-[color:var(--charcoal)] font-medium">{{ $item->nama_kategori }}</td>
                            <td class="px-6 py-3 text-[color:var(--charcoal)]/70">{{ $item->buku_count ?? $item->buku->count() }} judul</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('kategori.edit', $item->id) }}" class="text-xs uppercase tracking-wide text-[color:var(--gold-deep)] hover:text-[color:var(--charcoal)]">Ubah</a>
                                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini? Buku yang terkait bisa ikut terpengaruh.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs uppercase tracking-wide text-red-800/60 hover:text-red-800">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-6 py-8 text-center text-[color:var(--charcoal)]/40">Belum ada data kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>