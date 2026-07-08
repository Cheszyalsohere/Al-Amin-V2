<section id="testimoni" class="max-w-6xl mx-auto px-6 md:px-11 py-16 md:py-24">
    <h2 class="text-ink font-semibold tracking-tight text-3xl md:text-4xl mb-12 max-w-lg">
        Cerita siswa
    </h2>

    <div class="grid md:grid-cols-2 gap-6">
        @php $avatars = ['avatar-1.jpg', 'avatar-2.jpg', 'avatar-3.jpg']; @endphp

        @foreach ($testimonials->take(6) as $i => $t)
            <div class="border border-line rounded-2xl p-6">
                <p class="text-ink leading-relaxed mb-5">&ldquo;{{ $t->quote }}&rdquo;</p>

                <div class="flex items-center gap-3">
                    <img
                        src="{{ asset('img/' . $avatars[$i % count($avatars)]) }}"
                        onerror="this.style.background='#F5F5F7';this.removeAttribute('src')"
                        alt=""
                        class="w-10 h-10 rounded-full object-cover"
                    >
                    <div>
                        <p class="text-ink font-medium text-sm">{{ $t->nama }}</p>
                        <p class="text-muted text-xs">{{ $t->sekolah }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
