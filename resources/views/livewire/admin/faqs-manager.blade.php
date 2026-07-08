<div class="max-w-6xl mx-auto px-8 py-10">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-ink tracking-tight">FAQ</h1>
        <p class="text-sm text-muted mt-1">{{ $items->count() }} pertanyaan</p>
    </div>

    <form wire:submit="save" class="border border-line rounded-card p-6 mb-8 grid grid-cols-1 gap-4">
        <input type="hidden" wire:model="form.id">

        <div>
            <label class="block text-sm text-muted mb-1">Pertanyaan</label>
            <input type="text" wire:model="form.pertanyaan" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink">
            @error('form.pertanyaan') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-muted mb-1">Jawaban</label>
            <textarea wire:model="form.jawaban" rows="3" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink"></textarea>
            @error('form.jawaban') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="bg-ink text-white text-sm px-5 py-2 rounded-pill">Simpan</button>
            @if ($form['id'])
                <button type="button" wire:click="$set('form.id', null)" class="text-sm text-muted px-3 py-2">Batal edit</button>
            @endif
        </div>
    </form>

    <div class="border-t border-line">
        @forelse ($items as $item)
            <div class="flex items-center justify-between gap-4 py-4 border-b border-line">
                <div>
                    <p class="text-ink font-medium">{{ $item->pertanyaan }}</p>
                    <p class="text-sm text-muted mt-0.5">{{ Str::limit($item->jawaban, 100) }}</p>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="button" wire:click="togglePublish({{ $item->id }})"
                        class="text-xs px-3 py-1.5 rounded-pill {{ $item->is_published ? 'bg-ink text-white' : 'border border-line text-muted' }}">
                        {{ $item->is_published ? 'Terbit' : 'Draf' }}
                    </button>
                    <button type="button" wire:click="edit({{ $item->id }})" class="text-xs px-3 py-1.5 rounded-pill border border-line text-ink">Edit</button>
                    <button type="button" wire:click="delete({{ $item->id }})" wire:confirm="Hapus FAQ ini?" class="text-xs px-3 py-1.5 rounded-pill border border-line text-error">Hapus</button>
                </div>
            </div>
        @empty
            <p class="py-8 text-center text-muted">Belum ada FAQ.</p>
        @endforelse
    </div>
</div>
