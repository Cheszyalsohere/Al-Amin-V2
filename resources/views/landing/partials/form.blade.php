<section id="daftar" class="bg-surface">
    <div class="max-w-6xl mx-auto px-6 md:px-11 py-16 md:py-24">
        <div class="max-w-lg mb-10">
            <h2 class="text-ink font-semibold tracking-tight text-3xl md:text-4xl mb-3">Amankan tempatmu</h2>
            <p class="text-muted leading-relaxed">Isi form di bawah, admin kami hubungi via WhatsApp dalam 1&times;24 jam untuk atur jadwal mulai belajar.</p>
        </div>

        <form method="POST" action="{{ route('leads.store') }}" class="max-w-2xl bg-white border border-line rounded-2xl p-6 md:p-8 space-y-5">
            @csrf

            <div class="hidden" aria-hidden="true">
                <label for="website">Jangan diisi</label>
                <input type="text" name="website" id="website" tabindex="-1" autocomplete="off" value="{{ old('website') }}">
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-ink mb-1.5">Nama lengkap</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                    class="w-full rounded-xl border-line focus:border-ink focus:ring-ink text-sm">
                @error('nama')
                    <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-ink mb-1.5">No. WA kamu</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                        class="w-full rounded-xl border-line focus:border-ink focus:ring-ink text-sm">
                    @error('no_hp')
                        <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_hp_ortu" class="block text-sm font-medium text-ink mb-1.5">No. WA orang tua</label>
                    <input type="text" name="no_hp_ortu" id="no_hp_ortu" value="{{ old('no_hp_ortu') }}"
                        class="w-full rounded-xl border-line focus:border-ink focus:ring-ink text-sm">
                    @error('no_hp_ortu')
                        <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="asal_sekolah" class="block text-sm font-medium text-ink mb-1.5">Asal sekolah <span class="text-muted font-normal">(opsional)</span></label>
                <input type="text" name="asal_sekolah" id="asal_sekolah" value="{{ old('asal_sekolah') }}"
                    class="w-full rounded-xl border-line focus:border-ink focus:ring-ink text-sm">
                @error('asal_sekolah')
                    <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid md:grid-cols-3 gap-5">
                <div>
                    <label for="kelas" class="block text-sm font-medium text-ink mb-1.5">Kelas</label>
                    <select name="kelas" id="kelas" class="w-full rounded-xl border-line focus:border-ink focus:ring-ink text-sm">
                        <option value="">Pilih kelas</option>
                        @foreach ($kelasOptions as $kelas)
                            <option value="{{ $kelas }}" @selected(old('kelas') === $kelas)>{{ $kelas }}</option>
                        @endforeach
                    </select>
                    @error('kelas')
                        <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="program_minat" class="block text-sm font-medium text-ink mb-1.5">Program diminati</label>
                    <select name="program_minat" id="program_minat" class="w-full rounded-xl border-line focus:border-ink focus:ring-ink text-sm">
                        <option value="">Pilih program</option>
                        @foreach ($programOptions as $value => $label)
                            <option value="{{ $value }}" @selected(old('program_minat') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('program_minat')
                        <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sumber" class="block text-sm font-medium text-ink mb-1.5">Tau Al-Amin dari mana?</label>
                    <select name="sumber" id="sumber" class="w-full rounded-xl border-line focus:border-ink focus:ring-ink text-sm">
                        <option value="">Pilih sumber</option>
                        @foreach ($sumberOptions as $value => $label)
                            <option value="{{ $value }}" @selected(old('sumber') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('sumber')
                        <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="bg-ink text-white font-medium px-6 py-3 rounded-[980px]">Daftar via WhatsApp</button>
        </form>
    </div>
</section>
