<?php

namespace App\Livewire\Admin;

use App\Models\Faq;
use Livewire\Component;

class FaqsManager extends Component
{
    public array $form = ['id' => null, 'pertanyaan' => '', 'jawaban' => ''];

    protected function rules(): array
    {
        return [
            'form.pertanyaan' => ['required', 'string', 'max:255'],
            'form.jawaban' => ['required', 'string'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        Faq::updateOrCreate(
            ['id' => $this->form['id']],
            [
                'pertanyaan' => $this->form['pertanyaan'],
                'jawaban' => $this->form['jawaban'],
            ]
        );
        $this->reset('form');
    }

    public function edit(int $id): void
    {
        $f = Faq::findOrFail($id);
        $this->form = $f->only('id', 'pertanyaan', 'jawaban');
    }

    public function togglePublish(int $id): void
    {
        $f = Faq::findOrFail($id);
        $f->update(['is_published' => ! $f->is_published]);
    }

    public function delete(int $id): void
    {
        Faq::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.faqs-manager', ['items' => Faq::orderBy('sort_order')->get()])
            ->layout('layouts.admin');
    }
}
