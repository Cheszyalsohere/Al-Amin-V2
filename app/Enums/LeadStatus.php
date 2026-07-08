<?php

namespace App\Enums;

enum LeadStatus: string
{
    case Baru = 'baru';
    case Dikontak = 'dikontak';
    case Daftar = 'daftar';
    case ClosedLost = 'closed_lost';

    public function label(): string
    {
        return match ($this) {
            self::Baru => 'Baru',
            self::Dikontak => 'Dikontak',
            self::Daftar => 'Daftar',
            self::ClosedLost => 'Closed',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($c) => [$c->value => $c->label()])->all();
    }

    /**
     * Small pill badge tint classes (admin-only allowance for semantic color).
     */
    public function badgeClasses(): string
    {
        return match ($this) {
            self::Baru => 'bg-amber-50 text-amber-800',
            self::Dikontak => 'bg-blue-50 text-blue-800',
            self::Daftar => 'bg-green-50 text-green-800',
            self::ClosedLost => 'bg-gray-100 text-gray-700',
        };
    }
}
