<?php

namespace App\Livewire\Admin;

use App\Enums\LeadStatus;
use App\Models\Lead;
use Livewire\Component;
use Livewire\WithPagination;

class LeadsTable extends Component
{
    use WithPagination;

    public string $status = '';
    public string $search = '';

    public function updating($name): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $leads = Lead::query()
            ->when($this->status, fn ($q) => $q->where('status', $this->status))
            ->when($this->search, fn ($q) => $q->where('nama', 'like', "%{$this->search}%"))
            ->latest()->paginate(15);

        return view('livewire.admin.leads-table', [
            'leads' => $leads,
            'statuses' => LeadStatus::options(),
        ])->layout('layouts.admin');
    }
}
