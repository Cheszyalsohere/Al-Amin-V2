<?php

use App\Models\{Program, SiteSetting, User};
use App\Support\SiteSettings;
use Livewire\Livewire;
use App\Livewire\Admin\{ProgramsManager, SettingsForm};

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

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
