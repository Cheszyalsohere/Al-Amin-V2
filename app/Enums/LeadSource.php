<?php

namespace App\Enums;

enum LeadSource: string
{
    case Website = 'website';
    case Instagram = 'instagram';
    case Tiktok = 'tiktok';
    case Whatsapp = 'whatsapp';
    case Temen = 'temen';
    case Google = 'google';
    case Lainnya = 'lainnya';

    public function label(): string
    {
        return match ($this) {
            self::Website => 'Website',
            self::Instagram => 'Instagram',
            self::Tiktok => 'TikTok',
            self::Whatsapp => 'WhatsApp',
            self::Temen => 'Temen / Referral',
            self::Google => 'Google',
            self::Lainnya => 'Lainnya',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($c) => [$c->value => $c->label()])->all();
    }
}
