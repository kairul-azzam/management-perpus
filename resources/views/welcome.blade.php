<x-guest-layout>

    {{-- ============================================================
         DESAIN: "READING ROOM" — Tema Perpustakaan Elegan & Timeless
         ------------------------------------------------------------
         Cara pakai gambar custom:
         Ganti background pada class ".library-cover" di bawah dengan
         gambar rak buku / ruang baca milik Anda sendiri, contoh:

            .library-cover {
                background-image: url('/images/library-hero.jpg');
            }

         Lapisan gelap (overlay) sudah disiapkan otomatis lewat
         ".library-overlay" agar gambar apa pun tetap elegan &
         teksnya tetap terbaca. Anda cukup ganti file gambarnya saja.
    ============================================================ --}}

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Jost:wght@300;400;500;600&display=swap');

        :root{
            --ink:#152219;
            --ink-soft:#1e2f24;
            --parchment:#f7f1e3;
            --parchment-soft:#efe6d2;
            --gold:#b6905a;
            --gold-deep:#8a6a3c;
            --charcoal:#2b241c;
            --sage:#93a08c;
        }

        .font-display{ font-family:'Cormorant Garamond', serif; }
        .font-body{ font-family:'Jost', sans-serif; }

        .library-cover{
            /* GANTI baris di bawah ini dengan gambar Anda */
            background-image: url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=1200&auto=format&fit=crop');
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

        .brass-btn{
            background: linear-gradient(180deg, var(--gold) 0%, var(--gold-deep) 100%);
            transition: filter .2s ease, transform .2s ease;
        }
        .brass-btn:hover{ filter: brightness(1.08); transform: translateY(-1px); }

        .seal{
            border: 1px solid rgba(182,144,90,.55);
        }
    </style>

    <div class="min-h-screen w-full flex font-body">

        {{-- ============ LEFT: IMAGE PANEL (custom image + dark overlay) ============ --}}
        <div class="library-cover relative hidden lg:flex lg:w-[54%] items-end">
            <div class="library-overlay absolute inset-0"></div>

            <div class="relative z-10 p-14 xl:p-20 text-parchment w-full">
                <div class="seal w-14 h-14 rounded-full flex items-center justify-center mb-8">
                    <span class="font-display text-2xl text-[color:var(--gold)]">Kai</span>
                </div>

                <p class="font-display italic text-3xl xl:text-4xl leading-snug max-w-md text-[color:var(--gold)]">
                    &ldquo;Sebuah ruangan tanpa buku, bagaikan raga tanpa jiwa.&rdquo;
                </p>
                <div class="mt-6 flex items-center gap-3 text-sm tracking-[0.2em] uppercase text-[color:var(--gold)]">
                    <span class="w-8 h-px bg-[color:var(--gold)]"></span>
                    <span>Cicero</span>
                </div>

                <p class="mt-16 text-xs tracking-[0.35em] uppercase text-parchment/50 text-white">
                    Katalog No. 823.914 &middot; Ruang Baca Utama
                </p>
            </div>
        </div>

        {{-- ============ RIGHT: FORM PANEL ============ --}}
        <div class="relative flex-1 flex items-center justify-center bg-[color:var(--parchment)] paper-texture px-6 py-12 sm:px-10">

            <div class="w-full max-w-sm">

                {{-- Brand / mark --}}
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
                        Selamat Datang Kembali
                    </h1>
                    <p class="font-body text-sm text-[color:var(--charcoal)]/60 mt-2">
                        Masuk untuk melanjutkan penjelajahan pustaka Anda.
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
                        <x-text-input id="email"
                                        class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                                        type="email"
                                        name="email"
                                        :value="old('email')"
                                        required autofocus autocomplete="username"
                                        placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="!font-body !text-xs !tracking-[0.15em] !uppercase !text-[color:var(--charcoal)]/70" />
                        <x-text-input id="password"
                                        class="catalog-input block mt-1 w-full font-body text-[color:var(--charcoal)]"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password"
                                        placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox"
                                   class="rounded-sm border-[color:var(--charcoal)]/30 text-[color:var(--gold-deep)] focus:ring-[color:var(--gold-deep)]"
                                   name="remember">
                            <span class="ms-2 text-sm text-[color:var(--charcoal)]/70 font-body">{{ __('Ingat saya') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-[color:var(--gold-deep)] hover:text-[color:var(--charcoal)] underline underline-offset-4 decoration-[color:var(--gold)]/50 font-body transition-colors"
                               href="{{ route('password.request') }}">
                                {{ __('Lupa kata sandi?') }}
                            </a>
                        @endif
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="brass-btn w-full py-3 rounded-sm text-parchment font-body text-sm tracking-[0.2em] uppercase shadow-sm focus:outline-none focus:ring-2 focus:ring-[color:var(--gold-deep)] focus:ring-offset-2 focus:ring-offset-[color:var(--parchment)]">
                            {{ __('Masuk') }}
                        </button>
                    </div>
                </form>

                <p class="mt-10 text-center lg:text-left text-xs text-[color:var(--charcoal)]/40 font-body tracking-wide">
                    Belum memiliki akun? <a href="{{ route('register') }}" class="text-[color:var(--gold-deep)] hover:text-[color:var(--charcoal)] underline underline-offset-4 decoration-[color:var(--gold)]/50 transition-colors">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>