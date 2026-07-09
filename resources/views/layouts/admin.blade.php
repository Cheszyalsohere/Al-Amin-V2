<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin &mdash; {{ config('app.name', 'Al-Amin Bimbingan Belajar') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/charts.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-bg text-ink">
    <div class="min-h-screen flex">
        <aside class="w-64 shrink-0 bg-surface border-r border-line flex flex-col">
            <div class="h-16 flex items-center px-6 border-b border-line">
                <a href="{{ route('landing') }}" class="text-ink font-semibold tracking-tight text-lg">Al-Amin</a>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-1">
                <a href="{{ route('admin.overview') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-card text-sm font-medium {{ request()->routeIs('admin.overview') ? 'bg-surface-2 text-ink' : 'text-muted hover:text-ink' }}">
                    Overview
                </a>
                <a href="{{ route('admin.leads') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-card text-sm font-medium {{ request()->routeIs('admin.leads*') ? 'bg-surface-2 text-ink' : 'text-muted hover:text-ink' }}">
                    Leads
                </a>
                <a href="{{ route('admin.konten') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-card text-sm font-medium {{ request()->routeIs('admin.konten*') ? 'bg-surface-2 text-ink' : 'text-muted hover:text-ink' }}">
                    Konten
                </a>
                <a href="{{ route('admin.testimoni') }}"
                   class="flex items-center gap-2 px-3 py-2 pl-6 rounded-card text-sm {{ request()->routeIs('admin.testimoni*') ? 'bg-surface-2 text-ink font-medium' : 'text-muted hover:text-ink' }}">
                    Testimoni
                </a>
                <a href="{{ route('admin.faq') }}"
                   class="flex items-center gap-2 px-3 py-2 pl-6 rounded-card text-sm {{ request()->routeIs('admin.faq*') ? 'bg-surface-2 text-ink font-medium' : 'text-muted hover:text-ink' }}">
                    FAQ
                </a>
                <a href="{{ route('admin.statistik') }}"
                   class="flex items-center gap-2 px-3 py-2 pl-6 rounded-card text-sm {{ request()->routeIs('admin.statistik*') ? 'bg-surface-2 text-ink font-medium' : 'text-muted hover:text-ink' }}">
                    Statistik
                </a>
                <a href="{{ route('admin.pengaturan') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-card text-sm font-medium {{ request()->routeIs('admin.pengaturan*') ? 'bg-surface-2 text-ink' : 'text-muted hover:text-ink' }}">
                    Pengaturan
                </a>
            </nav>

            <div class="px-6 py-4 border-t border-line">
                <p class="text-sm font-medium text-ink">Bu Heri</p>
                <p class="text-xs text-muted">Owner & Pembimbing</p>
            </div>
        </aside>

        <main class="flex-1 bg-bg">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
