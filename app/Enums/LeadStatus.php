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
}
