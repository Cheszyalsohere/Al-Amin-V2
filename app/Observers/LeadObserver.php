<?php

namespace App\Observers;

use App\Enums\LeadStatus;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;

class LeadObserver
{
    public function created(Lead $lead): void
    {
        $lead->events()->create([
            'event_type' => 'created',
            'new_status' => $lead->status->value,
            'actor' => 'system',
        ]);
    }

    public function updating(Lead $lead): void
    {
        if (! $lead->isDirty('status')) {
            return;
        }

        $new = $lead->status instanceof LeadStatus ? $lead->status : LeadStatus::from($lead->status);

        if ($new === LeadStatus::Dikontak && $lead->contacted_at === null) {
            $lead->contacted_at = now();
        }
        if ($new === LeadStatus::Daftar && $lead->converted_at === null) {
            $lead->converted_at = now();
        }
    }

    public function updated(Lead $lead): void
    {
        if (! $lead->wasChanged('status')) {
            return;
        }

        $lead->events()->create([
            'event_type' => 'status_changed',
            'old_status' => $lead->getOriginal('status'),
            'new_status' => $lead->status->value,
            'actor' => Auth::user()?->name ?? 'system',
        ]);
    }
}
