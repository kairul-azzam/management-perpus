<div>
    <x-input-label for="nama_author" :value="__('Nama Author')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
    <x-text-input id="nama_author" name="nama_author" type="text"
                  class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                  :value="old('nama_author', $author->nama_author ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('nama_author')" class="mt-2" />
</div>