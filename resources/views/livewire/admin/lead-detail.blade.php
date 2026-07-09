<div class="max-w-4xl mx-auto px-8 py-10">
    <a href="{{ route('admin.leads') }}" class="text-sm text-muted hover:text-ink">&larr; Kembali ke Leads</a>

    <div class="mt-4 flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-ink tracking-tight">{{ $lead->nama }}</h1>
            <p class="text-sm text-muted mt-1">{{ $lead->kelas }} &middot; {{ $lead->asal_sekolah }} &middot; {{ $lead->program_minat ? (\App\Enums\ProgramType::tryFrom($lead->program_minat)?->label() ?? $lead->program_minat) : '—' }}</p>
        </div>

        <span class="inline-block text-xs font-medium px-2.5 py-1 rounded-pill {{ $lead->status->badgeClasses() }}">
            {{ $lead->status->label() }}
        </span>
    </div>

    <div class="flex items-center gap-3 mt-6">
        <a href="https://wa.me/{{ \App\Support\Phone::wa($lead->no_hp) }}" target="_blank" rel="noopener"
            class="border border-line text-ink text-sm font-medium px-5 py-2.5 rounded-pill hover:bg-surface-2">
            WA siswa
        </a>
        <a href="https://wa.me/{{ \App\Support\Phone::wa($lead->no_hp_ortu) }}" target="_blank" rel="noopener"
            class="border border-line text-ink text-sm font-medium px-5 py-2.5 rounded-pill hover:bg-surface-2">
            WA ortu
        </a>
    </div>

    <div class="mt-10">
        <p class="text-sm font-medium text-ink mb-3">Status</p>
        <div class="flex items-center gap-2">
            @foreach ($statuses as $s)
                <button type="button" wire:click="ubahStatus('{{ $s->value }}')"
                    class="text-sm px-4 py-1.5 rounded-pill {{ $lead->status === $s ? 'bg-ink text-white' : 'border border-line text-muted hover:text-ink' }}">
                    {{ $s->label() }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="mt-10">
        <p class="text-sm font-medium text-ink mb-3">Timeline</p>

        <ul class="space-y-4">
            @forelse ($lead->events as $event)
                <li class="flex gap-3">
                    <span class="mt-1.5 w-2 h-2 rounded-full bg-ink shrink-0"></span>
                    <div>
                        <p class="text-sm text-ink">
                            @if ($event->event_type === 'status_changed')
                                Status diubah ke <span class="font-medium">{{ \App\Enums\LeadStatus::from($event->new_status)->label() }}</span>
                            @else
                                Lead dibuat
                            @endif
                        </p>
                        <p class="text-xs text-muted mt-0.5">{{ $event->actor }} &middot; {{ $event->created_at->diffForHumans() }}</p>
                    </div>
                </li>
            @empty
                <li class="text-sm text-muted">Belum ada aktivitas.</li>
            @endforelse
        </ul>
    </div>
</div>
