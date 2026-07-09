<?php

use App\Livewire\Admin\Analytics;
use App\Models\Lead;
use App\Models\PageView;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guest diblok', fn () => $this->get('/admin/analytics')->assertRedirect('/login'));

test('analytics menampilkan funnel, sumber, traffic', function () {
    Lead::factory()->count(4)->create();
    PageView::create(['path' => '/', 'is_unique' => true]);
    $this->actingAs(User::factory()->create());
    Livewire::test(Analytics::class)->assertOk()->assertViewHas('funnel')->assertViewHas('sources');
});
