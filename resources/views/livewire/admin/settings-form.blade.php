<div class="max-w-4xl mx-auto px-8 py-10">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-ink tracking-tight">Pengaturan</h1>
        <p class="text-sm text-muted mt-1">Kontak, sosial media, dan profil owner</p>
    </div>

    @if (session('saved'))
        <div class="mb-6 text-sm text-ink border border-line rounded-card px-4 py-3">
            {{ session('saved') }}
        </div>
    @endif

    <form wire:submit="save" class="space-y-8">
        <div class="border border-line rounded-card p-6">
            <h2 class="text-sm font-medium text-ink mb-4">Kontak</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-muted mb-1">Nomor WhatsApp</label>
                    <input type="text" wire:model="values.wa_number" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink">
                    @error('values.wa_number') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm text-muted mb-1">Tampilan Nomor WA</label>
                    <input type="text" wire:model="values.wa_display" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink">
                    @error('values.wa_display') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm text-muted mb-1">Jam Buka</label>
                    <input type="text" wire:model="values.jam_buka" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink">
                    @error('values.jam_buka') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm text-muted mb-1">Instagram URL</label>
                    <input type="text" wire:model="values.instagram_url" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink">
                    @error('values.instagram_url') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm text-muted mb-1">TikTok URL</label>
                    <input type="text" wire:model="values.tiktok_url" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink">
                    @error('values.tiktok_url') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="border border-line rounded-card p-6">
            <h2 class="text-sm font-medium text-ink mb-4">Profil Owner</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-muted mb-1">Nama</label>
                    <input type="text" wire:model="values.owner_nama" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink">
                    @error('values.owner_nama') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm text-muted mb-1">Peran</label>
                    <input type="text" wire:model="values.owner_peran" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink">
                    @error('values.owner_peran') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm text-muted mb-1">Penghargaan</label>
                    <input type="text" wire:model="values.owner_penghargaan" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink">
                    @error('values.owner_penghargaan') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm text-muted mb-1">Bio</label>
                    <textarea wire:model="values.owner_bio" rows="3" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink"></textarea>
                    @error('values.owner_bio') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm text-muted mb-1">Kutipan</label>
                    <textarea wire:model="values.owner_kutipan" rows="3" class="w-full border border-line rounded px-3 py-2 text-sm text-ink focus:outline-none focus:ring-1 focus:ring-ink"></textarea>
                    @error('values.owner_kutipan') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="bg-ink text-white text-sm px-5 py-2 rounded-pill">Simpan</button>
        </div>
    </form>
</div>
