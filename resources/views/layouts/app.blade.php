<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan') }} &middot; Dashboard</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,400&family=Jost:wght@300;400;500;600&display=swap');

        :root{
            --ink:#152219;
            --ink-soft:#1e2f24;
            --ink-line: rgba(247,241,227,.08);
            --parchment:#f7f1e3;
            --parchment-soft:#efe6d2;
            --gold:#b6905a;
            --gold-deep:#8a6a3c;
            --charcoal:#2b241c;
            --sage:#93a08c;
        }
        .font-display{ font-family:'Cormorant Garamond', serif; }
        .font-body{ font-family:'Jost', sans-serif; }
        body{ background: var(--parchment); }

        .paper-texture{
            background-image: repeating-linear-gradient(0deg, rgba(43,36,28,.02) 0px, rgba(43,36,28,.02) 1px, transparent 1px, transparent 3px);
        }

        .sidebar-link{
            display:flex; align-items:center; gap:.75rem;
            padding:.65rem .9rem; border-radius:.35rem;
            color: rgba(247,241,227,.65);
            font-size:.85rem; letter-spacing:.03em;
            transition: background .2s ease, color .2s ease;
            border-left: 2px solid transparent;
        }
        .sidebar-link:hover{ background: rgba(247,241,227,.05); color: var(--parchment); }
        .sidebar-link.active{
            background: rgba(182,144,90,.12);
            color: var(--parchment);
            border-left: 2px solid var(--gold);
        }
        .sidebar-link.active svg{ color: var(--gold); }
        .sidebar-link svg{ width:1.1rem; height:1.1rem; flex-shrink:0; color: rgba(247,241,227,.45); }

        .brass-btn{
            background: linear-gradient(180deg, var(--gold) 0%, var(--gold-deep) 100%);
            transition: filter .2s ease;
        }
        .brass-btn:hover{ filter: brightness(1.08); }

        .stat-card{
            background: var(--parchment-soft);
            border: 1px solid rgba(43,36,28,.08);
        }
    </style>
</head>
<body class="font-body antialiased text-[color:var(--charcoal)]">

<div x-data="{ sidebarOpen: false }" class="min-h-screen flex">

    {{-- ============ SIDEBAR ============ --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-[color:var(--ink)] flex flex-col transition-transform duration-300 lg:static lg:translate-x-0">

        <div class="flex items-center gap-3 px-6 py-6 border-b border-[color:var(--ink-line)]">
            <span class="w-9 h-9 rounded-full border border-[color:var(--gold-deep)] flex items-center justify-center">
                <span class="font-display text-lg text-[color:var(--gold)]">Kai</span>
            </span>
            <div class="leading-tight">
                <p class="font-display text-xl text-[color:var(--parchment)]">Reading Room</p>
                <p class="text-[10px] tracking-[0.25em] uppercase text-[color:var(--parchment)]/40 text-white">Sistem Perpustakaan</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-6">

            <div>
                <p class="px-3 mb-2 text-[10px] tracking-[0.25em] uppercase text-[color:var(--parchment)]/30">Ringkasan</p>
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Dashboard
                </a>
            </div>

            <div>
                <p class="px-3 mb-2 text-[10px] tracking-[0.25em] uppercase text-[color:var(--parchment)]/30">Koleksi Pustaka</p>
                <div class="space-y-1">
                    <a href="{{ route('buku.index') }}" class="sidebar-link {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                        Data Buku
                    </a>
                    <a href="{{ route('author.index') }}" class="sidebar-link {{ request()->routeIs('author.*') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                        Data Author
                    </a>
                    <a href="{{ route('kategori.index') }}" class="sidebar-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" /></svg>
                        Data Kategori
                    </a>
                </div>
            </div>

            <div>
                <p class="px-3 mb-2 text-[10px] tracking-[0.25em] uppercase text-[color:var(--parchment)]/30">Akademik</p>
                <div class="space-y-1">
                    <a href="{{ route('kelas.index') }}" class="sidebar-link {{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443" /></svg>
                        Data Kelas
                    </a>
                    <a href="{{ route('siswa.index') }}" class="sidebar-link {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg>
                        Data Siswa
                    </a>
                </div>
            </div>

            <div>
                <p class="px-3 mb-2 text-[10px] tracking-[0.25em] uppercase text-[color:var(--parchment)]/30">Akun</p>
                <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.281z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    Profil Saya
                </a>
            </div>
        </nav>

        <div class="p-4 border-t border-[color:var(--ink-line)]">
            <div class="flex items-center gap-3 px-2 mb-3">
                <div class="w-8 h-8 rounded-full bg-[color:var(--gold-deep)]/30 flex items-center justify-center text-[color:var(--gold)] font-display text-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="leading-tight min-w-0">
                    <p class="text-sm text-[color:var(--parchment)] truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-[color:var(--parchment)]/40 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-left hover:!bg-red-900/20 hover:!text-red-300">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Overlay untuk mobile --}}
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen=false" class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

    {{-- ============ MAIN CONTENT ============ --}}
    <div class="flex-1 flex flex-col min-w-0 paper-texture">

        {{-- Top bar --}}
        <header class="sticky top-0 z-20 flex items-center justify-between gap-4 px-6 py-4 bg-[color:var(--parchment)]/90 backdrop-blur border-b border-[color:var(--charcoal)]/8">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-[color:var(--charcoal)]">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" /></svg>
                </button>
                @isset($header)
                    <div class="font-body">{{ $header }}</div>
                @endisset
            </div>
        </header>

        <main class="flex-1 px-6 py-8">
            {{ $slot }}
        </main>
    </div>
</div>

</body>
</html>