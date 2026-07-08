<?php

namespace App\Livewire\Admin;

use App\Models\Program;
use Livewire\Component;

class ProgramsManager extends Component
{
    public array $form = ['id' => null, 'kode' => '', 'nama' => '', 'deskripsi' => '', 'tags' => ''];

    protected function rules(): array
    {
        return [
            'form.kode' => ['required', 'string', 'max:20'],
            'form.nama' => ['required', 'string', 'max:120'],
            'form.deskripsi' => ['required', 'string'],
            'form.tags' => ['nullable', 'string'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        Program::updateOrCreate(
            ['id' => $this->form['id']],
            [
                'kode' => $this->form['kode'],
                'nama' => $this->form['nama'],
                'deskripsi' => $this->form['deskripsi'],
                'tags' => array_filter(array_map('trim', explode(',', $this->form['tags'] ?? ''))),
            ]
        );
        $this->reset('form');
    }

    public function edit(int $id): void
    {
        $p = Program::findOrFail($id);
        $this->form = [...$p->only('id', 'kode', 'nama', 'deskripsi'), 'tags' => implode(', ', $p->tags ?? [])];
    }

    public function togglePublish(int $id): void
    {
        $p = Program::findOrFail($id);
        $p->update(['is_published' => ! $p->is_published]);
    }

    public function delete(int $id): void
    {
        Program::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.programs-manager', ['items' => Program::orderBy('sort_order')->get()])
            ->layout('layouts.admin');
    }
}
