<?php

namespace App\Livewire\Admin;

use App\Models\SiteSetting;
use App\Support\SiteSettings;
use Livewire\Component;

class SettingsForm extends Component
{
    public array $values = [];

    public function mount(): void
    {
        $this->values = SiteSettings::all();
    }

    public function save(): void
    {
        foreach ($this->values as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        SiteSettings::forget();
        session()->flash('saved', 'Pengaturan tersimpan.');
    }

    public function render()
    {
        return view('livewire.admin.settings-form')->layout('layouts.admin');
    }
}
