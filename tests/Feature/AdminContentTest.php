<?php

use App\Livewire\Admin\ProgramsManager;
use App\Livewire\Admin\SettingsForm;
use App\Models\Program;
use App\Models\User;
use App\Support\SiteSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('admin membuat & menghapus program', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test(ProgramsManager::class)
        ->set('form.kode', 'ALT')->set('form.nama', 'Program Alt')->set('form.deskripsi', 'desk')
        ->call('save');
    expect(Program::where('kode', 'ALT')->exists())->toBeTrue();

    $id = Program::where('kode', 'ALT')->value('id');
    Livewire::test(ProgramsManager::class)->call('delete', $id);
    expect(Program::find($id))->toBeNull();
});

test('toggle publish program', function () {
    $p = Program::create(['kode' => 'K', 'nama' => 'N', 'deskripsi' => 'd', 'is_published' => true]);
    $this->actingAs(User::factory()->create());
    Livewire::test(ProgramsManager::class)->call('togglePublish', $p->id);
    expect($p->fresh()->is_published)->toBeFalse();
});

test('menyimpan settings kontak', function () {
    $this->actingAs(User::factory()->create());
    Livewire::test(SettingsForm::class)
        ->set('values.wa_number', '628999')->set('values.jam_buka', 'Setiap hari')
        ->call('save');
    expect(SiteSettings::get('wa_number'))->toBe('628999');
});

test('settings menolak wa_number kosong atau non-angka', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test(SettingsForm::class)
        ->set('values.wa_number', '')
        ->call('save')
        ->assertHasErrors(['values.wa_number' => 'required']);

    Livewire::test(SettingsForm::class)
        ->set('values.wa_number', '0851-9090')
        ->call('save')
        ->assertHasErrors(['values.wa_number' => 'regex']);
});
