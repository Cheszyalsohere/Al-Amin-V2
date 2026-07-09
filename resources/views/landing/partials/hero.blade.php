<section class="max-w-6xl mx-auto px-6 md:px-11 py-14 md:py-20 grid md:grid-cols-2 gap-12 md:gap-10 items-center">
    <div>
        <span class="inline-flex items-center gap-2 text-xs text-ink bg-surface px-3 py-1.5 rounded-[980px] mb-6">
            <span class="w-1.5 h-1.5 rounded-full bg-live"></span>
            Pendaftaran semester ganjil dibuka
        </span>

        <h1 class="text-ink font-semibold tracking-tight text-4xl md:text-5xl leading-[1.06]">
            Belajar bareng,<br>sampai paham.
        </h1>

        <p class="text-muted text-lg leading-relaxed mt-5 mb-7 max-w-[380px]">
            Bimbel SMP&ndash;SMA di Bangil. Kelas kecil, tentor yang kenal tiap siswa &mdash; dari PR harian sampai lolos PTN.
        </p>

        <div class="flex flex-wrap gap-3 mb-10">
            <a href="#daftar" class="bg-ink text-white font-medium px-6 py-3 rounded-[980px]">Daftar sekarang</a>
            <a href="#program" class="text-ink font-medium px-5 py-3 rounded-[980px] border border-line">Lihat program</a>
        </div>

        <div class="flex items-center gap-3">
            <div class="flex -space-x-3">
                @foreach (['avatar-1.jpg', 'avatar-2.jpg', 'avatar-3.jpg', 'avatar-1.jpg'] as $avatar)
                    <img src="{{ asset('img/' . $avatar) }}" alt="" class="w-9 h-9 rounded-full object-cover ring-2 ring-white">
                @endforeach
            </div>
            <p class="text-sm text-muted">500+ alumni<br>sejak 2012 di Bangil</p>
        </div>
    </div>

    <div class="relative">
        <img
            src="{{ asset('img/hero.jpg') }}"
            onerror="this.style.background='#F5F5F7';this.removeAttribute('src')"
            alt="Siswa belajar bersama tentor di kelas kecil"
            class="w-full h-[340px] object-cover rounded-2xl"
        >

        <div class="absolute left-4 bottom-4 bg-white rounded-2xl px-4 py-3 shadow-lg">
            <p class="text-ink font-semibold text-base leading-tight">98% lolos PTN</p>
            <p class="text-muted text-xs mt-0.5">angkatan tahun lalu</p>
        </div>

        <div class="absolute right-4 top-4 bg-white rounded-2xl px-4 py-3 shadow-lg">
            <p class="text-ink font-semibold text-base leading-tight">5&ndash;15 siswa</p>
            <p class="text-muted text-xs mt-0.5">per kelas</p>
        </div>
    </div>
</section>

<div class="border-t border-line bg-surface">
    <div class="max-w-6xl mx-auto px-6 md:px-11 py-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center md:text-left">
        <p class="text-sm text-muted"><span class="text-ink font-semibold">14 th</span> di Bangil</p>
        <p class="text-sm text-muted"><span class="text-ink font-semibold">3&times; seminggu</span> 90 menit</p>
        <p class="text-sm text-muted"><span class="text-ink font-semibold">SMP&ndash;SMA</span> sampai UTBK</p>
        <p class="text-sm text-muted"><span class="text-ink font-semibold">1&times;24 jam</span> admin balas</p>
    </div>
</div>
