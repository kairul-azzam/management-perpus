<div>
    <x-input-label for="nama" :value="__('Nama Siswa')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
    <x-text-input id="nama" name="nama" type="text"
                  class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                  :value="old('nama', $siswa->nama ?? '')" required autofocus />
    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="nis" :value="__('NIS')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
    <x-text-input id="nis" name="nis" type="text"
                  class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                  :value="old('nis', $siswa->nis ?? '')" required />
    <x-input-error :messages="$errors->get('nis')" class="mt-2" />
</div>

{{-- Relasi: Siswa belongsTo Kelas (1 kelas bisa punya banyak siswa) --}}
<div class="mt-4">
    <x-input-label for="kelas_id" :value="__('Kelas')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
    <select id="kelas_id" name="kelas_id" required
            class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)] bg-transparent">
        <option value="">-- Pilih Kelas --</option>
        @foreach ($kelasList as $kelas)
            <option value="{{ $kelas->id }}" @selected(old('kelas_id', $siswa->kelas_id ?? '') == $kelas->id)>
                {{ $kelas->namakelas }} (Tingkat {{ $kelas->tingkat }})
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('kelas_id')" class="mt-2" />
</div>