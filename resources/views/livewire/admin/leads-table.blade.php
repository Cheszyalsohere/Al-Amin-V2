<div class="max-w-6xl mx-auto px-8 py-10">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-ink tracking-tight">Leads</h1>
            <p class="text-sm text-muted mt-1">{{ $leads->total() }} total lead</p>
        </div>

        <button type="button" disabled
            class="border border-line text-muted text-sm px-4 py-2 rounded-pill cursor-not-allowed">
            Export PDF
        </button>
    </div>

    <div class="flex flex-wrap items-center gap-2 mb-6">
        <button type="button" wire:click="$set('status', '')"
            class="text-sm px-4 py-1.5 rounded-pill {{ $status === '' ? 'bg-ink text-white' : 'border border-line text-muted' }}">
            Semua
        </button>
        @foreach ($statuses as $value => $label)
            <button type="button" wire:click="$set('status', '{{ $value }}')"
                class="text-sm px-4 py-1.5 rounded-pill {{ $status === $value ? 'bg-ink text-white' : 'border border-line text-muted' }}">
                {{ $label }}
            </button>
        @endforeach

        <div class="ml-auto">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari nama..."
                class="border border-line rounded-pill text-sm px-4 py-1.5 text-ink placeholder:text-muted focus:outline-none focus:ring-1 focus:ring-ink">
        </div>
    </div>

    <div class="border-t border-line">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-muted">
                    <th class="py-3 font-medium">Nama</th>
                    <th class="py-3 font-medium">Kelas</th>
                    <th class="py-3 font-medium">Program</th>
                    <th class="py-3 font-medium">Sumber</th>
                    <th class="py-3 font-medium">Status</th>
                    <th class="py-3 font-medium">Masuk</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($leads as $lead)
                    <tr class="border-b border-line hover:bg-surface-2">
                        <td class="py-3">
                            <a href="{{ route('admin.leads.show', $lead) }}" class="text-ink font-medium hover:underline">
                                {{ $lead->nama }}
                            </a>
                        </td>
                        <td class="py-3 text-ink">{{ $lead->kelas }}</td>
                        <td class="py-3 text-ink">{{ $lead->program_minat ? (\App\Enums\ProgramType::tryFrom($lead->program_minat)?->label() ?? $lead->program_minat) : '—' }}</td>
                        <td class="py-3 text-muted">{{ \App\Enums\LeadSource::tryFrom($lead->sumber)?->label() ?? $lead->sumber }}</td>
                        <td class="py-3">
                            <span class="inline-block text-xs font-medium px-2.5 py-1 rounded-pill {{ $lead->status->badgeClasses() }}">
                                {{ $lead->status->label() }}
                            </span>
                        </td>
                        <td class="py-3 text-muted">{{ $lead->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-muted">Belum ada lead.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $leads->links() }}
    </div>
</div>
