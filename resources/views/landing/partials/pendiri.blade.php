<section id="pendiri" class="bg-surface">
    <div class="max-w-6xl mx-auto px-6 md:px-11 py-16 md:py-24 grid md:grid-cols-[200px_1fr] gap-10 md:gap-14 items-start">
        <img
            src="{{ asset('img/owner.jpg') }}"
            onerror="this.style.background='#EBEBED';this.removeAttribute('src')"
            alt="{{ $settings['owner_nama'] }}"
            class="w-[160px] md:w-[200px] h-[200px] md:h-[250px] object-cover rounded-2xl"
        >

        <div>
            @if (!empty($settings['owner_penghargaan']))
                <span class="inline-flex items-center text-xs text-ink bg-white border border-line px-3 py-1.5 rounded-[980px] mb-5">
                    {{ $settings['owner_penghargaan'] }}
                </span>
            @endif

            <h2 class="text-ink font-semibold tracking-tight text-2xl md:text-3xl mb-2">{{ $settings['owner_nama'] }}</h2>
            <p class="text-muted mb-6">{{ $settings['owner_peran'] }}</p>

            @if (!empty($settings['owner_bio']))
                <div class="text-ink leading-relaxed space-y-4 max-w-2xl">
                    @foreach (explode("\n\n", $settings['owner_bio']) as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
