<?php

use App\Models\SiteSetting;
use App\Support\SiteSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('fallback dipakai saat kosong', function () {
    expect(SiteSettings::get('wa_number'))->toBe('6285190909689');
});

test('nilai db menimpa fallback', function () {
    SiteSetting::create(['key' => 'wa_number', 'value' => '628111']);
    SiteSettings::forget();
    expect(SiteSettings::get('wa_number'))->toBe('628111');
});

test('nilai kosong di db tetap pakai fallback', function () {
    SiteSetting::create(['key' => 'jam_buka', 'value' => '']);
    SiteSettings::forget();
    expect(SiteSettings::get('jam_buka'))->toBe('Senin–Sabtu, 15.30–21.00');
});
