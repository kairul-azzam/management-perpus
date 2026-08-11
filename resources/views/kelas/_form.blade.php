<div>
    <x-input-label for="namakelas" :value="__('Nama Kelas')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
    <x-text-input id="namakelas" name="namakelas" type="text"
                  class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                  :value="old('namakelas', $kelas->namakelas ?? '')" required autofocus placeholder="contoh: XII IPA 1" />
    <x-input-error :messages="$errors->get('namakelas')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="tingkat" :value="__('Tingkat')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
    <x-text-input id="tingkat" name="tingkat" type="text"
                  class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                  :value="old('tingkat', $kelas->tingkat ?? '')" required placeholder="contoh: 12" />
    <x-input-error :messages="$errors->get('tingkat')" class="mt-2" />
</div>