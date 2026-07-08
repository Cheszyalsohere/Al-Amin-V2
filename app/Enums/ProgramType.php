<?php

namespace App\Enums;

enum ProgramType: string
{
    case Smp = 'smp';
    case SmaIpa = 'sma_ipa';
    case SmaIps = 'sma_ips';
    case Utbk = 'utbk';
    case Olimpiade = 'olimpiade';

    public function label(): string
    {
        return match ($this) {
            self::Smp => 'SMP Reguler',
            self::SmaIpa => 'SMA IPA',
            self::SmaIps => 'SMA IPS',
            self::Utbk => 'UTBK / SNBT',
            self::Olimpiade => 'Olimpiade',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($c) => [$c->value => $c->label()])->all();
    }
}
