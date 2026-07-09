<?php

use App\Models\{Lead, PageView, User};
use Livewire\Livewire;
use App\Livewire\Admin\Analytics;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guest diblok', fn () => $this->get('/admin/analytics')->assertRedirect('/login'));

test('analytics menampilkan funnel, sumber, traffic', function () {
    Lead::factory()->count(4)->create();
    PageView::create(['path' => '/', 'is_unique' => true]);
    $this->actingAs(User::factory()->create());
    Livewire::test(Analytics::class)->assertOk()->assertViewHas('funnel')->assertViewHas('sources');
});
