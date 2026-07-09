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

    protected function rules(): array
    {
        return [
            'values.wa_number' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'values.wa_display' => ['nullable', 'string', 'max:40'],
            'values.jam_buka' => ['nullable', 'string', 'max:120'],
            'values.instagram_url' => ['nullable', 'string', 'max:255'],
            'values.tiktok_url' => ['nullable', 'string', 'max:255'],
            'values.owner_nama' => ['nullable', 'string', 'max:120'],
            'values.owner_peran' => ['nullable', 'string', 'max:160'],
            'values.owner_penghargaan' => ['nullable', 'string', 'max:160'],
            'values.owner_bio' => ['nullable', 'string', 'max:2000'],
            'values.owner_kutipan' => ['nullable', 'string', 'max:500'],
        ];
    }

    protected function messages(): array
    {
        return [
            'values.wa_number.required' => 'Nomor WhatsApp wajib diisi.',
            'values.wa_number.regex' => 'Nomor WhatsApp hanya boleh angka (format 62..., bukan 08...).',
        ];
    }

    public function save(): void
    {
        $this->validate();

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
