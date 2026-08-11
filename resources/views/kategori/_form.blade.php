<div>
    <x-input-label for="nama_kategori" :value="__('Nama Kategori')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
    <x-text-input id="nama_kategori" name="nama_kategori" type="text"
                  class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                  :value="old('nama_kategori', $kategori->nama_kategori ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
</div>