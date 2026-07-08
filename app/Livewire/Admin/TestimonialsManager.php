<?php

namespace App\Livewire\Admin;

use App\Models\Testimonial;
use Livewire\Component;

class TestimonialsManager extends Component
{
    public array $form = ['id' => null, 'nama' => '', 'sekolah' => '', 'quote' => '', 'rating' => 5];

    protected function rules(): array
    {
        return [
            'form.nama' => ['required', 'string', 'max:120'],
            'form.sekolah' => ['nullable', 'string'],
            'form.quote' => ['required', 'string'],
            'form.rating' => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        Testimonial::updateOrCreate(
            ['id' => $this->form['id']],
            [
                'nama' => $this->form['nama'],
                'sekolah' => $this->form['sekolah'],
                'quote' => $this->form['quote'],
                'rating' => $this->form['rating'],
            ]
        );
        $this->reset('form');
        $this->form['rating'] = 5;
    }

    public function edit(int $id): void
    {
        $t = Testimonial::findOrFail($id);
        $this->form = $t->only('id', 'nama', 'sekolah', 'quote', 'rating');
    }

    public function togglePublish(int $id): void
    {
        $t = Testimonial::findOrFail($id);
        $t->update(['is_published' => ! $t->is_published]);
    }

    public function delete(int $id): void
    {
        Testimonial::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.testimonials-manager', ['items' => Testimonial::orderBy('sort_order')->get()])
            ->layout('layouts.admin');
    }
}
