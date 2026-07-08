<section id="program" class="max-w-6xl mx-auto px-6 md:px-11 py-16 md:py-24">
    <h2 class="text-ink font-semibold tracking-tight text-3xl md:text-4xl mb-12 max-w-lg">
        Program belajar
    </h2>

    <div class="grid md:grid-cols-3 gap-6">
        @php
            $images = ['smp' => 'program-smp.jpg', 'sma_ipa' => 'program-sma.jpg', 'sma_ips' => 'program-sma.jpg', 'utbk' => 'program-utbk.jpg'];
        @endphp

        @foreach ($programs as $p)
            @php
                $isUtbk = str_contains(strtolower($p->kode ?? ''), 'utbk');
                $image = $images[strtolower($p->kode ?? '')] ?? 'program-sma.jpg';
            @endphp
            <div class="border rounded-2xl overflow-hidden {{ $isUtbk ? 'border-ink' : 'border-line' }}">
                <div class="relative">
                    <img
                        src="{{ asset('img/' . $image) }}"
                        onerror="this.style.background='#F5F5F7';this.removeAttribute('src')"
                        alt="{{ $p->nama }}"
                        class="w-full h-40 object-cover"
                    >
                    @if ($isUtbk)
                        <span class="absolute top-3 right-3 bg-ink text-white text-xs font-medium px-3 py-1 rounded-[980px]">Intensif</span>
                    @endif
                </div>

                <div class="p-6">
                    <h3 class="text-ink font-semibold text-lg mb-2">{{ $p->nama }}</h3>
                    <p class="text-muted text-sm leading-relaxed mb-4">{{ $p->deskripsi }}</p>

                    @if (!empty($p->tags))
                        <div class="flex flex-wrap gap-2">
                            @foreach ($p->tags as $tag)
                                <span class="text-xs text-muted bg-surface px-2.5 py-1 rounded-[980px]">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
