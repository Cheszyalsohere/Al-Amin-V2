<?php

use App\Enums\LeadStatus;
use App\Models\{Lead, User};
use Livewire\Livewire;
use App\Livewire\Admin\LeadsTable;
use App\Livewire\Admin\LeadDetail;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guest tidak bisa akses admin leads', function () {
    $this->get('/admin/leads')->assertRedirect('/login');
});

test('admin melihat daftar lead', function () {
    Lead::factory()->create(['nama' => 'Andi Pratama']);
    $this->actingAs(User::factory()->create());
    Livewire::test(LeadsTable::class)->assertSee('Andi Pratama');
});

test('filter status & search bekerja', function () {
    Lead::factory()->create(['nama' => 'Baru Satu', 'status' => LeadStatus::Baru]);
    Lead::factory()->create(['nama' => 'Sudah Daftar', 'status' => LeadStatus::Daftar]);
    $this->actingAs(User::factory()->create());

    Livewire::test(LeadsTable::class)
        ->set('status', 'daftar')->assertSee('Sudah Daftar')->assertDontSee('Baru Satu')
        ->set('status', '')->set('search', 'Baru')->assertSee('Baru Satu')->assertDontSee('Sudah Daftar');
});

test('ubah status mencatat timeline', function () {
    $lead = Lead::factory()->create(['status' => LeadStatus::Baru]);
    $this->actingAs(User::factory()->create());

    Livewire::test(LeadDetail::class, ['lead' => $lead])
        ->call('ubahStatus', 'dikontak');

    expect($lead->fresh()->status)->toBe(LeadStatus::Dikontak);
    expect($lead->events()->where('event_type', 'status_changed')->exists())->toBeTrue();
});
