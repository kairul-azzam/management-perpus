<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-2xl text-[color:var(--charcoal)]">Ubah Buku</h2>
    </x-slot>

    <div class="max-w-xl stat-card rounded-md p-8">
        <form action="{{ route('buku.update', $buku->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('buku._form')

            <div class="flex items-center gap-3 mt-8">
                <button type="submit" class="brass-btn px-6 py-2.5 rounded-sm text-parchment text-sm tracking-[0.15em] uppercase">
                    Simpan Perubahan
                </button>
                <a href="{{ route('buku.index') }}" class="text-sm text-[color:var(--charcoal)]/50 hover:text-[color:var(--charcoal)]">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>