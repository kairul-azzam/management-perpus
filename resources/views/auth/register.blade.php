<x-guest-layout>

    {{-- ============================================================
         DESAIN: "READING ROOM" — Tema Perpustakaan Elegan & Timeless
         Struktur mengikuti persis file register bawaan Breeze
         (urutan field, x-primary-button, dsb) — hanya tampilan
         yang diubah lewat class & <style>.
         ------------------------------------------------------------
         Cara pakai gambar custom:
         Ganti background pada class ".library-cover" di bawah dengan
         gambar rak buku / ruang baca milik Anda sendiri, contoh:

            .library-cover {
                background-image: url('/images/library-hero.jpg');
            }
    ============================================================ --}}

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Jost:wght@300;400;500;600&display=swap');

        :root{
            --ink:#152219;
            --parchment:#f7f1e3;
            --gold:#b6905a;
            --gold-deep:#8a6a3c;
            --charcoal:#2b241c;
        }

        .font-display{ font-family:'Cormorant Garamond', serif; }
        .font-body{ font-family:'Jost', sans-serif; }

        .library-cover{
            /* GANTI baris di bawah ini dengan gambar Anda */
            background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=1200&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .library-overlay{
            background:
                linear-gradient(180deg, rgba(10,14,10,.35) 0%, rgba(10,14,10,.72) 65%, rgba(10,14,10,.9) 100%),
                linear-gradient(90deg, rgba(10,14,10,.55) 0%, rgba(10,14,10,.25) 40%, rgba(10,14,10,.05) 100%);
        }

        .paper-texture{
            background-image:
                repeating-linear-gradient(0deg, rgba(43,36,28,.025) 0px, rgba(43,36,28,.025) 1px, transparent 1px, transparent 3px);
        }

        .catalog-input{
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(43,36,28,.28);
            border-radius: 0;
            padding: .55rem .1rem;
            transition: border-color .25s ease;
        }
        .catalog-input:focus{
            border-bottom-color: var(--gold-deep);
            box-shadow: none;
            outline: none;
            --tw-ring-shadow: 0 0 #0000 !important;
        }

        /* Restyle x-primary-button (indigo bawaan) jadi warna brass/gold */
        .brass-primary-btn{
            background: linear-gradient(180deg, var(--gold) 0%, var(--gold-deep) 100%) !important;
            border-color: transparent !important;
        }
        .brass-primary-btn:hover{
            filter: brightness(1.08);
        }
    </style>

    <div class="min-h-screen w-full flex font-body">

        {{-- ============ LEFT: IMAGE PANEL (custom image + dark overlay) ============ --}}
        <div class="library-cover relative hidden lg:flex lg:w-[54%] items-end">
            <div class="library-overlay absolute inset-0"></div>

            <div class="relative z-10 p-14 xl:p-20 text-parchment w-full">
                <div class="w-14 h-14 rounded-full border border-[color:var(--gold)] flex items-center justify-center mb-8">
                    <span class="font-display text-2xl text-[color:var(--gold)]">Kai</span>
                </div>

                <p class="font-display italic text-3xl xl:text-4xl leading-snug max-w-md text-[color:var(--gold)]">
                    &ldquo;Buku adalah teman yang tenang dan tetap setia.&rdquo;
                </p>
                <div class="mt-6 flex items-center gap-3 text-sm tracking-[0.2em] uppercase text-[color:var(--gold)]">
                    <span class="w-8 h-px bg-[color:var(--gold)]"></span>
                    <span>Charles W. Eliot</span>
                </div>

                <p class="mt-16 text-xs tracking-[0.35em] uppercase text-parchment/50 text-white">
                    Katalog No. 020.01 &middot; Pendaftaran Anggota Baru
                </p>
            </div>
        </div>

        {{-- ============ RIGHT: FORM PANEL ============ --}}
        <div class="relative flex-1 flex items-center justify-center bg-[color:var(--parchment)] paper-texture px-6 py-12 sm:px-10">

            <div class="w-full max-w-sm">

                <div class="flex flex-col items-center lg:items-start mb-10">
                    <div class="flex items-center gap-3 mb-1">
                        <span class="block w-9 h-9 rounded-full border border-[color:var(--gold-deep)] flex items-center justify-center">
                            <span class="font-display text-lg text-[color:var(--gold-deep)]">Kai</span>
                        </span>
                        <span class="font-body text-[11px] tracking-[0.3em] uppercase text-[color:var(--charcoal)]/60">
                            Perpustakaan
                        </span>
                    </div>
                    <h1 class="font-display text-4xl text-[color:var(--charcoal)] mt-4">
                        Daftar Sebagai Anggota
                    </h1>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
                        <x-text-input id="name" class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
                        <x-text-input id="email" class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />

                        <x-text-input id="password" class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />

                        <x-text-input id="password_confirmation" class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-[color:var(--charcoal)]/60 hover:text-[color:var(--gold-deep)] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[color:var(--gold-deep)] font-body" href="/">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="brass-primary-btn ms-4 !font-body !tracking-[0.15em] !uppercase">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>