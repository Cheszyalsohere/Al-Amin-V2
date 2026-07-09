# Al-Amin Bimbingan Belajar

Landing page, form pendaftaran lead, dan panel admin (CRM sederhana) untuk bimbingan belajar Al-Amin. Dibangun dengan Laravel 12, Livewire, Tailwind, dan Pest.

## Stack

- Laravel 12 (PHP 8.3)
- Livewire untuk komponen interaktif admin
- Tailwind CSS + Vite untuk aset front-end
- Pest untuk testing
- SQLite in-memory untuk test suite (lihat `phpunit.xml`), MySQL untuk local/production

## Development

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=ContentSeeder
npm run dev
php artisan serve
```

## Testing

```bash
php artisan test
./vendor/bin/pint --test
npm run build
```

## CI

`.github/workflows/ci.yml` menjalankan Pint, Pest, dan build Vite di setiap push/PR ke `main`. Test suite berjalan di atas SQLite in-memory sehingga tidak butuh service database di CI.

## Deploy ke Hostinger (shared/Business)

> Aset harus di-build di lokal lalu di-upload — server Hostinger tidak menjalankan Node.
> `public/build/` (hasil Vite) dan `public/img/` (foto) ikut ter-commit di repo, jadi kalau deploy via git keduanya otomatis terbawa.

### A. Persiapan di lokal (sekali, sebelum deploy)

```bash
npm run build      # hasilkan public/build (WAJIB, di-commit / di-upload)
php artisan test   # pastikan hijau
```

Commit `public/build` bila berubah, lalu push (kalau deploy via git).

### B. Deploy di Hostinger

1. **Document root** domain diarahkan ke folder `public/` (hPanel → Domains → set root ke `.../public`).
2. **Ambil kode** — salah satu:
   - **Git** (Business, ada SSH): `git clone https://github.com/Cheszyalsohere/Al-Amin-V2.git` (atau `git pull` untuk update). `vendor/`, `public/build`, dan `public/img` ikut lewat repo.
   - **Upload manual**: upload semua KECUALI `node_modules/`. Pastikan `public/build/` dan `public/img/` ikut ter-upload.
3. **Dependency PHP** (kalau ada SSH + Composer): `composer install --no-dev --optimize-autoloader`. Kalau tak ada Composer di server, upload folder `vendor/` dari lokal.
4. **Buat DB MySQL** di hPanel → MySQL Databases; catat host, nama db, user, password.
5. **`.env`** — copy `.env.example` → `.env`, isi minimal:
   ```env
   APP_NAME="Al-Amin Bimbingan Belajar"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://domainmu.com

   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=nama_db_hostinger
   DB_USERNAME=user_db_hostinger
   DB_PASSWORD=password_db_hostinger

   ADMIN_GATE_CODE=            # isi kode rahasia untuk gerbang /login (kosong = gerbang mati)
   SESSION_SECURE_COOKIE=true  # karena HTTPS

   MAIL_MAILER=smtp
   MAIL_HOST=smtp.hostinger.com
   MAIL_PORT=465
   MAIL_USERNAME=admin@domainmu.com
   MAIL_PASSWORD=password_email
   MAIL_ENCRYPTION=ssl
   MAIL_FROM_ADDRESS=admin@domainmu.com

   LEAD_NOTIFY_ENABLED=true    # true jika mau email tiap lead masuk
   ADMIN_NOTIFY_EMAIL=admin@domainmu.com
   ```
   > `APP_ENV=production` penting: seeder lead dummy TIDAK akan jalan, dan error tidak dibocorkan.
6. **Artisan** (via SSH atau Terminal hPanel):
   ```bash
   php artisan key:generate
   php artisan migrate --force
   php artisan db:seed --class=ContentSeeder --force   # HANYA konten (bukan DatabaseSeeder — itu berisi dummy lead)
   php artisan storage:link
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
7. **Buat admin** (ContentSeeder sudah membuat `admin@alamin.test` / `password`). **Segera ganti** email & password lewat halaman Profil setelah login, atau buat user baru via tinker.
8. **Permission**: pastikan `storage/` dan `bootstrap/cache/` writable (Hostinger biasanya sudah).
9. **Queue**: mulai dengan `QUEUE_CONNECTION=sync` (email lead langsung). Untuk skala lebih besar, pindah ke `database` + tambah cron `php artisan schedule:run` tiap menit di hPanel → Cron Jobs.

### C. Update / tambah foto setelah live

- Update kode: `git pull` di server, lalu `php artisan migrate --force` (bila ada migrasi baru) dan `php artisan config:cache route:cache view:cache` ulang.
- Tambah/ganti foto: taruh file di `public/img/` (via git atau File Manager). Foto statis — tanpa build ulang, tanpa downtime. Kalau nama file baru, edit partial Blade terkait lalu `php artisan view:clear`.
- Foto default saat ini di `public/img/`: `hero.jpg`, `owner.jpeg`, `program-{smp,sma,utbk}.jpg`, `gallery-1..3.jpg`, `avatar-1..3.jpg` (owner sudah foto asli; sisanya placeholder stok — ganti sesuai kebutuhan).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
