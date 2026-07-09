<?php

namespace App\Livewire\Admin;

use App\Enums\LeadStatus;
use App\Models\Lead;
use App\Support\SiteSettings;
use Livewire\Component;

class LeadDetail extends Component
{
    public Lead $lead;

    public function ubahStatus(string $status): void
    {
        $newStatus = LeadStatus::tryFrom($status);

        if ($newStatus === null) {
            return;
        }

        $this->lead->update(['status' => $newStatus]);
        $this->lead->refresh();
    }

    public function render()
    {
        return view('livewire.admin.lead-detail', [
            'statuses' => LeadStatus::cases(),
            'waNumber' => SiteSettings::get('wa_number'),
        ])->layout('layouts.admin');
    }
}
