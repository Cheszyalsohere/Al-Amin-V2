<?php

namespace App\Livewire\Admin;

use App\Models\SiteStat;
use Livewire\Component;

class StatsManager extends Component
{
    public array $form = ['id' => null, 'nilai' => '', 'label' => ''];

    protected function rules(): array
    {
        return [
            'form.nilai' => ['required', 'string', 'max:20'],
            'form.label' => ['required', 'string', 'max:120'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        SiteStat::updateOrCreate(
            ['id' => $this->form['id']],
            [
                'nilai' => $this->form['nilai'],
                'label' => $this->form['label'],
            ]
        );
        $this->reset('form');
    }

    public function edit(int $id): void
    {
        $s = SiteStat::findOrFail($id);
        $this->form = $s->only('id', 'nilai', 'label');
    }

    public function togglePublish(int $id): void
    {
        $s = SiteStat::findOrFail($id);
        $s->update(['is_published' => ! $s->is_published]);
    }

    public function delete(int $id): void
    {
        SiteStat::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.stats-manager', ['items' => SiteStat::orderBy('sort_order')->get()])
            ->layout('layouts.admin');
    }
}
