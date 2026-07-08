<?php

namespace App\Support;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteSettings
{
    public const DEFAULTS = [
        'wa_number' => '6285190909689',
        'wa_display' => '0851-9090-9689',
        'jam_buka' => 'Senin–Sabtu, 15.30–21.00',
        'instagram_url' => '',
        'tiktok_url' => '',
        'owner_nama' => 'Rr. Heri Sulistyowarni, S.Pd',
        'owner_peran' => 'Owner & Pembimbing · Al-Amin Bimbingan Belajar',
        'owner_penghargaan' => 'Juara 2 Guru Idola — Radar Bromo',
        'owner_bio' => '',
        'owner_kutipan' => '',
    ];

    public static function all(): array
    {
        $stored = Cache::remember('site_settings', 3600, fn () => SiteSetting::pluck('value', 'key')->all());

        return array_merge(self::DEFAULTS, array_filter($stored, fn ($v) => $v !== null && $v !== ''));
    }

    public static function get(string $key, $default = null)
    {
        return self::all()[$key] ?? $default ?? (self::DEFAULTS[$key] ?? null);
    }

    public static function forget(): void
    {
        Cache::forget('site_settings');
    }
}
