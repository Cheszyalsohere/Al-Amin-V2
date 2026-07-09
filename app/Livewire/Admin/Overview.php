<?php

namespace App\Livewire\Admin;

use App\Models\Lead;
use App\Support\LeadMetrics;
use Livewire\Component;

class Overview extends Component
{
    public function render()
    {
        return view('livewire.admin.overview', [
            'totals' => LeadMetrics::totals(),
            'trend' => LeadMetrics::trend(30),
            'recent' => Lead::latest()->limit(8)->get(),
        ])->layout('layouts.admin');
    }
}
