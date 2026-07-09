<?php

namespace App\Livewire\Admin;

use App\Enums\LeadSource;
use App\Enums\LeadStatus;
use App\Models\PageView;
use App\Support\LeadMetrics;
use Livewire\Component;

class Analytics extends Component
{
    public function render()
    {
        return view('livewire.admin.analytics', [
            'funnel' => $this->funnel(),
            'sources' => $this->sources(),
            'traffic' => $this->traffic(),
        ])->layout('layouts.admin');
    }

    protected function funnel(): array
    {
        $byStatus = LeadMetrics::byStatus();
        $total = array_sum($byStatus);

        $stages = [
            LeadStatus::Baru,
            LeadStatus::Dikontak,
            LeadStatus::Daftar,
            LeadStatus::ClosedLost,
        ];

        return collect($stages)->map(function (LeadStatus $stage) use ($byStatus, $total) {
            $count = $byStatus[$stage->value] ?? 0;

            return [
                'label' => $stage->label(),
                'value' => $stage->value,
                'count' => $count,
                'pct' => $total > 0 ? round($count / $total * 100) : 0,
            ];
        })->all();
    }

    protected function sources(): array
    {
        $bySource = LeadMetrics::bySource();

        return collect($bySource)
            ->filter(fn ($count) => $count > 0)
            ->map(fn ($count, $key) => [
                'label' => LeadSource::from($key)->label(),
                'count' => $count,
            ])
            ->values()
            ->all();
    }

    protected function traffic(): array
    {
        $since = now()->subDays(30);

        return [
            'views' => PageView::where('created_at', '>=', $since)->count(),
            'unique' => PageView::where('created_at', '>=', $since)->where('is_unique', true)->count(),
        ];
    }
}
