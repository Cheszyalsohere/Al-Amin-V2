<?php

namespace Database\Seeders;

use App\Models\{Faq, Program, SiteSetting, SiteStat, Testimonial, User};
use App\Support\SiteSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@alamin.test'],
            ['name' => 'Bu Heri', 'nickname' => 'Bu Heri', 'password' => Hash::make('password')]
        );

        foreach ([
            ['98%', 'lolos PTN tahun lalu'],
            ['500+', 'alumni sejak 2012'],
            ['14 th', 'nemenin anak Bangil'],
        ] as $i => [$nilai, $label]) {
            SiteStat::updateOrCreate(['label' => $label], ['nilai' => $nilai, 'sort_order' => $i]);
        }

        $settings = [
            'wa_number' => '6285190909689',
            'wa_display' => '0851-9090-9689',
            'jam_buka' => 'Senin–Sabtu, 15.30–21.00',
            'instagram_url' => '',
            'tiktok_url' => '',
            'owner_nama' => 'Rr. Heri Sulistyowarni, S.Pd',
            'owner_peran' => 'Owner & Pembimbing · Al-Amin Bimbingan Belajar',
            'owner_penghargaan' => 'Juara 2 Guru Idola — Radar Bromo',
            'owner_bio' => "Hampir 39 tahun mengabdi sebagai guru di SMANBA (SMAN 1 Bangil) hingga purnabakti, beliau dikenal sebagai pendidik yang disiplin, penuh perhatian, dan berkomitmen tinggi membimbing generasi muda berprestasi — dihormati siswa maupun rekan sejawat.\n\nSejak 2012, dedikasinya berlanjut lewat Al-Amin. Selama kurang lebih 14 tahun beliau membina bimbel ini sebagai owner sekaligus pembimbing, membantu banyak pelajar Bangil meraih prestasi akademik dan tumbuh percaya diri dalam belajar.",
            'owner_kutipan' => 'Bagi banyak murid, beliau bukan sekadar guru, tapi sosok yang menularkan teladan, motivasi, dan semangat untuk terus belajar dan berkembang.',
        ];
        foreach ($settings as $k => $v) {
            SiteSetting::updateOrCreate(['key' => $k], ['value' => $v]);
        }

        foreach ([
            ['SMP', 'SMP Reguler', 'Kelas 7–9. Bangun fondasi Matematika, IPA, dan Bahasa Inggris sebelum semuanya kerasa berat.', ['kelas 7', 'kelas 8', 'kelas 9']],
            ['SMA', 'SMA Akademik', 'Kelas 10–12 IPA & IPS. Materi sekolah, persiapan ulangan, plus try out berkala biar nggak kaget pas ujian.', ['IPA', 'IPS', 'try out']],
            ['UTBK', 'UTBK / SNBT Intensif', 'Persiapan total menuju PTN. Latihan soal harian, simulasi mingguan, dan mentor yang nemenin satu per satu.', ['TPS', 'literasi', 'penalaran']],
        ] as $i => [$kode, $nama, $desk, $tags]) {
            Program::updateOrCreate(['kode' => $kode], ['nama' => $nama, 'deskripsi' => $desk, 'tags' => $tags, 'sort_order' => $i]);
        }

        $faqs = [
            ['Ada program kelas apa aja?', 'Lengkap dari jenjang SMP sampai SMA/SMK/MA — mulai persiapan ulangan harian, ujian semester, asesmen nasional, sampai kelas khusus persiapan seleksi masuk PTN (UTBK-SNBT).'],
            ['Buat siswa sekolah mana aja?', 'Fokus kami siswa di Bangil dan sekitarnya — SMAN 1 Bangil, MAN 1 Pasuruan, SMKN 1 Bangil, dan sekolah lain di area Bangil–Pasuruan.'],
            ['Kelasnya online atau tatap muka?', 'Tatap muka langsung di tempat kami di Bangil — kelas kecil biar tentor kenal tiap siswa. Konsultasi tugas atau PR juga bisa lanjut via WhatsApp di luar jam kelas.'],
            ['Berapa jumlah siswa dalam satu kelas?', 'Biar belajar tetap fokus dan efektif, jumlah siswa tiap kelas dibatasi — rata-rata cuma 5 sampai 15 siswa per kelas.'],
            ['Gimana jadwal pembelajarannya?', 'Seminggu 3 kali pertemuan, masing-masing 90 menit. Diatur di luar jam sekolah, dan pas mau ulangan atau ujian bisa minta tambahan jam belajar.'],
            ['Komponen biaya & sistem pembayarannya gimana?', 'Biaya terdiri dari biaya pendaftaran (sekali di awal) dan biaya program. Pembayaran fleksibel — bisa dilunasi di awal atau dicicil per bulan. Info nominal terbaru bisa ditanya langsung ke admin via WhatsApp.'],
            ['Kapan pendaftaran siswa baru dibuka?', 'Pendaftaran dibuka tiap awal semester ganjil. Tapi di tengah semester juga masih bisa daftar selama kuota kelas masih tersedia.'],
            ['Gimana cara daftarnya?', 'Isi form pendaftaran di halaman ini, nanti admin kami hubungi via WhatsApp dalam 1×24 jam buat atur jadwal mulai belajar.'],
        ];
        foreach ($faqs as $i => [$q, $a]) {
            Faq::updateOrCreate(['pertanyaan' => $q], ['jawaban' => $a, 'sort_order' => $i]);
        }

        $testi = [
            ['Muhammad Rafael Al Ghazali', 'SMAN 1 Bangil · Angkatan 41', 'Sangat membantu persiapan UTBK — materinya relevan banget sama tesnya. Alhamdulillah aku keterima di PTN sekarang.'],
            ['Muhammad Rwin Ramadhani', 'SMAN 1 Bangil · Angkatan 41', 'Dapet mentor yang pas, dan materi-materinya relevan banget buat belajar.'],
            ['Muhammad Ramzy Akramal Mazid', 'SMAN 1 Bangil · Angkatan 41', 'Alhamdulillah selama di Al Amin aku ngerasa kebantu banget — baik paham materi maupun makin jago ngerjain latihan soal.'],
            ['Moh. Miftahul Ulum', 'SMAN 1 Bangil · Angkatan 41', 'Penyampaian materinya jelas banget, apalagi buat pelajaran yang tadinya kerasa susah. Ruang ber-AC, nyaman pula.'],
            ['Azriel Mohammad Hasby', 'SMAN 1 Bangil · Angkatan 41', 'Asik dan seru — pengalaman belajarnya menyenangkan tapi pengetahuannya tetep mendalam.'],
            ['Zulfian Fairuz Nabil', 'SMAN 1 Bangil · Angkatan 41', 'Alhamdulillah penyampaian materinya mudah dipahami. Makin sukses dan berkembang terus, Al Amin!'],
            ['Aura Nuril Abiyyah', 'SMAN 1 Bangil · Angkatan 43', 'Niatnya cuma belajar, eh malah nemu keluarga kedua. Al Amin bukan sekadar tempat ngapalin pelajaran, tapi tempat tumbuh bareng.'],
            ['Dinda Naura Firdausy', 'SMAN 1 Bangil · Angkatan 43', 'Tentor & temennya seru, penjelasannya gampang dipahami apalagi pas minggu ujian. Makasih Al Amin, udah nemenin sampai keterima PTN impian.'],
            ['Amelia Salsabilatus Sholiha', 'SMAN 1 Bangil · Angkatan 43', 'Tentornya asik, suasananya nyaman. Jadwalnya fleksibel — malah bisa request mau diajar tentor siapa.'],
            ['Romiizah Jinaan Benzema', 'SMAN 1 Bangil', 'Tiap mau ulangan, langsung dijadwalin jam belajar biar nggak remed. First experience les yang berkesan banget.'],
            ['Nadhifairus Nurjannah', 'MAN 1 Pasuruan · Angkatan 33', 'Cara ngajar tentornya gampang dipahami, kelasnya nyaman & nggak terlalu rame — jadi belajarnya kondusif.'],
            ['Putri Nailul Farohah', 'SMAN 1 Bangil · Angkatan 43', 'Materi sekolah yang bikin pusing jadi lebih masuk akal — diajarin trik cepat. Bisa konsultasi tugas sekolah juga.'],
        ];
        foreach ($testi as $i => [$nama, $sekolah, $quote]) {
            Testimonial::updateOrCreate(['nama' => $nama], ['sekolah' => $sekolah, 'quote' => $quote, 'rating' => 5, 'sort_order' => $i]);
        }

        SiteSettings::forget();
    }
}
