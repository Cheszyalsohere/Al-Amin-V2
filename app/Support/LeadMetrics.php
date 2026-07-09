<?php

namespace App\Support;

use App\Enums\LeadSource;
use App\Enums\LeadStatus;
use App\Models\Lead;
use Illuminate\Support\Carbon;

class LeadMetrics
{
    public static function totals(): array
    {
        $total = Lead::count();
        $daftar = Lead::where('status', LeadStatus::Daftar->value)->count();
        $bulanIni = Lead::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();

        return [
            'total' => $total,
            'bulan_ini' => $bulanIni,
            'daftar' => $daftar,
            'conversion' => $total > 0 ? round($daftar / $total * 100, 1) : 0.0,
        ];
    }

    public static function trend(int $days = 30): array
    {
        $start = now()->subDays($days - 1)->startOfDay();

        $counts = Lead::where('created_at', '>=', $start)
            ->get(['created_at'])
            ->groupBy(fn ($l) => $l->created_at->format('Y-m-d'))
            ->map->count();

        $labels = [];
        $data = [];
        for ($i = 0; $i < $days; $i++) {
            $day = $start->copy()->addDays($i)->format('Y-m-d');
            $labels[] = $day;
            $data[] = (int) ($counts[$day] ?? 0);
        }

        return ['labels' => $labels, 'data' => $data];
    }

    public static function byStatus(): array
    {
        $counts = Lead::get(['status'])->groupBy(fn ($l) => $l->status->value)->map->count();

        return collect(LeadStatus::cases())
            ->mapWithKeys(fn ($c) => [$c->value => (int) ($counts[$c->value] ?? 0)])->all();
    }

    public static function bySource(): array
    {
        $counts = Lead::get(['sumber'])->groupBy('sumber')->map->count();

        return collect(LeadSource::cases())
            ->mapWithKeys(fn ($c) => [$c->value => (int) ($counts[$c->value] ?? 0)])->all();
    }
}
