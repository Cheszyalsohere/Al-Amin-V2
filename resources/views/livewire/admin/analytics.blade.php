<div class="max-w-6xl mx-auto px-8 py-10">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-ink tracking-tight">Analytics</h1>
        <p class="text-sm text-muted mt-1">Funnel konversi, sumber lead, dan traffic 30 hari terakhir</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-8">
        <div class="bg-surface rounded-card p-5">
            <p class="text-muted text-[13px] mb-4">Funnel konversi</p>

            <div class="space-y-4">
                @foreach ($funnel as $stage)
                    <div>
                        <div class="flex items-center justify-between text-sm mb-1.5">
                            <span class="text-ink font-medium">{{ $stage['label'] }}</span>
                            <span class="text-muted">{{ $stage['count'] }} &middot; {{ $stage['pct'] }}%</span>
                        </div>
                        <div class="h-2 rounded-pill bg-surface-2 overflow-hidden">
                            <div class="h-full rounded-pill bg-ink" style="width: {{ $stage['pct'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-surface rounded-card p-5">
            <p class="text-muted text-[13px] mb-4">Sumber lead</p>

            @if (count($sources) > 0)
                <canvas id="sourceChart" height="220"></canvas>
                <script type="application/json" id="sourceChartData">@json($sources)</script>
            @else
                <p class="py-8 text-center text-muted">Belum ada data sumber.</p>
            @endif
        </div>
    </div>

    <div>
        <p class="text-muted text-[13px] mb-3">Traffic (30 hari)</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-surface rounded-card p-5">
                <p class="text-muted text-[13px]">Kunjungan 30 hari</p>
                <p class="text-ink text-2xl font-medium mt-1">{{ $traffic['views'] }}</p>
            </div>
            <div class="bg-surface rounded-card p-5">
                <p class="text-muted text-[13px]">Pengunjung unik</p>
                <p class="text-ink text-2xl font-medium mt-1">{{ $traffic['unique'] }}</p>
            </div>
        </div>
    </div>
</div>
