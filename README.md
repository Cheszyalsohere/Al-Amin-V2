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

1. Set document root domain ke folder `public/`.
2. Upload seluruh kode (kecuali `node_modules`).
3. Build aset di lokal: `npm run build` → upload folder `public/build`.
4. Buat DB MySQL di hPanel, catat kredensial.
5. Copy `.env.example` → `.env`, isi `APP_URL`, DB (`DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`), `MAIL_*` (SMTP Hostinger), dan `ADMIN_GATE_CODE`.
6. `php artisan key:generate`
7. `php artisan migrate --force`
8. `php artisan db:seed --class=ContentSeeder --force` (hanya konten; dummy lead TIDAK jalan di production)
9. `php artisan storage:link`
10. Queue mulai `sync`; nanti pindah ke `database` + cron `php artisan schedule:run` tiap menit.
11. Taruh foto asli di `public/img/` (`hero.jpg`, `owner.jpg`, `program-sma.jpg`, `program-smp.jpg`, `program-utbk.jpg`, `gallery-1.jpg`..`gallery-3.jpg`, `avatar-1.jpg`..`avatar-3.jpg`) — ganti placeholder stok yang ada.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
