<div class="max-w-6xl mx-auto px-8 py-10">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-ink tracking-tight">Overview</h1>
        <p class="text-sm text-muted mt-1">Ringkasan pendaftaran 30 hari terakhir</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-surface rounded-card p-5">
            <p class="text-muted text-[13px]">Pendaftar bulan ini</p>
            <p class="text-ink text-2xl font-medium mt-1">{{ $totals['bulan_ini'] }}</p>
        </div>
        <div class="bg-surface rounded-card p-5">
            <p class="text-muted text-[13px]">Total pendaftar</p>
            <p class="text-ink text-2xl font-medium mt-1">{{ $totals['total'] }}</p>
        </div>
        <div class="bg-surface rounded-card p-5">
            <p class="text-muted text-[13px]">Jadi murid</p>
            <p class="text-ink text-2xl font-medium mt-1">{{ $totals['daftar'] }}</p>
        </div>
        <div class="bg-surface rounded-card p-5">
            <p class="text-muted text-[13px]">Conversion rate</p>
            <p class="text-ink text-2xl font-medium mt-1">{{ $totals['conversion'] }}%</p>
        </div>
    </div>

    <div class="bg-surface rounded-card p-5 mb-8">
        <p class="text-muted text-[13px] mb-4">Tren pendaftaran (30 hari)</p>
        <canvas id="trendChart" height="80"></canvas>
        <script type="application/json" id="trendChartData">@json($trend)</script>
    </div>

    <div>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-medium text-ink">Lead terbaru</h2>
            <a href="{{ route('admin.leads') }}" class="text-sm text-muted hover:text-ink">Lihat semua</a>
        </div>

        <div class="border-t border-line">
            @forelse ($recent as $lead)
                <a href="{{ route('admin.leads.show', $lead) }}"
                   class="flex items-center justify-between gap-4 py-3 border-b border-line hover:bg-surface-2 px-2 -mx-2">
                    <div class="flex-1 min-w-0">
                        <p class="text-ink font-medium truncate">{{ $lead->nama }}</p>
                        <p class="text-muted text-sm truncate">{{ $lead->kelas }}</p>
                    </div>
                    <span class="inline-block text-xs font-medium px-2.5 py-1 rounded-pill shrink-0 {{ $lead->status->badgeClasses() }}">
                        {{ $lead->status->label() }}
                    </span>
                    <span class="text-muted text-sm shrink-0 w-32 text-right">{{ $lead->created_at->diffForHumans() }}</span>
                </a>
            @empty
                <p class="py-8 text-center text-muted">Belum ada lead.</p>
            @endforelse
        </div>
    </div>
</div>
