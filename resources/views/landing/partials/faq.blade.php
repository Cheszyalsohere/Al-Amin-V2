<section id="faq" class="max-w-6xl mx-auto px-6 md:px-11 py-16 md:py-24">
    <h2 class="text-ink font-semibold tracking-tight text-3xl md:text-4xl mb-10 max-w-lg">
        Pertanyaan yang sering ditanyakan
    </h2>

    <div class="max-w-3xl border-t border-line">
        @foreach ($faqs as $i => $faq)
            <details class="group border-b border-line py-5" @if ($i === 0) open @endif>
                <summary class="flex items-center justify-between gap-4 cursor-pointer list-none text-ink font-medium">
                    {{ $faq->pertanyaan }}
                    <span class="shrink-0 text-muted transition-transform group-open:rotate-45">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                            <path d="M12 5v14M5 12h14"></path>
                        </svg>
                    </span>
                </summary>
                <p class="text-muted leading-relaxed mt-4 max-w-2xl">{{ $faq->jawaban }}</p>
            </details>
        @endforeach
    </div>
</section>
