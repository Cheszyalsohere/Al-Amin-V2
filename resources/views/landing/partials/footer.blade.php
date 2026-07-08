<footer class="border-t border-line">
    <div class="max-w-6xl mx-auto px-6 md:px-11 py-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <p class="text-ink font-semibold mb-1">Al-Amin</p>
            <p class="text-muted text-sm">Bimbingan belajar &middot; Bangil, Pasuruan &middot; sejak 2012</p>
        </div>

        <div class="text-sm text-muted md:text-right">
            <p>WA {{ $settings['wa_display'] }}</p>
            <p>{{ $settings['jam_buka'] }}</p>

            @if (!empty($settings['instagram_url']) || !empty($settings['tiktok_url']))
                <div class="flex gap-4 mt-2 md:justify-end">
                    @if (!empty($settings['instagram_url']))
                        <a href="{{ $settings['instagram_url'] }}" class="text-ink hover:text-muted" target="_blank" rel="noopener">Instagram</a>
                    @endif
                    @if (!empty($settings['tiktok_url']))
                        <a href="{{ $settings['tiktok_url'] }}" class="text-ink hover:text-muted" target="_blank" rel="noopener">TikTok</a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</footer>
