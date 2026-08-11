{{-- Form ini dipakai bersama oleh create.blade.php dan edit.blade.php --}}

<div>
    <x-input-label for="judul_buku" :value="__('Judul Buku')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
    <x-text-input id="judul_buku" name="judul_buku" type="text"
                  class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                  :value="old('judul_buku', $buku->judul_buku ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('judul_buku')" class="mt-2" />
</div>

{{-- Relasi: Buku belongsTo Author (1 author bisa punya banyak buku) --}}
<div class="mt-4">
    <x-input-label for="author_id" :value="__('Author')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
    <select id="author_id" name="author_id" required
            class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)] bg-transparent">
        <option value="">-- Pilih Author --</option>
        @foreach ($authors as $author)
            <option value="{{ $author->id }}" @selected(old('author_id', $buku->author_id ?? '') == $author->id)>
                {{ $author->nama_author }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('author_id')" class="mt-2" />
</div>

{{-- Relasi: Buku belongsTo Kategori (1 kategori bisa punya banyak buku) --}}
<div class="mt-4">
    <x-input-label for="kategori_id" :value="__('Kategori')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
    <select id="kategori_id" name="kategori_id" required
            class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)] bg-transparent">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($kategoris as $kategori)
            <option value="{{ $kategori->id }}" @selected(old('kategori_id', $buku->kategori_id ?? '') == $kategori->id)>
                {{ $kategori->nama_kategori }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('kategori_id')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="stock" :value="__('Stok')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
    <x-text-input id="stock" name="stock" type="number" min="0"
                  class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                  :value="old('stock', $buku->stock ?? 0)" required />
    <x-input-error :messages="$errors->get('stock')" class="mt-2" />
</div>