<?php

use App\Livewire\Admin\Overview;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guest tak bisa akses overview', function () {
    $this->get('/admin')->assertRedirect('/login');
});

test('overview menampilkan KPI & lead terbaru', function () {
    Lead::factory()->count(5)->create();
    $this->actingAs(User::factory()->create());
    Livewire::test(Overview::class)->assertOk()->assertViewHas('totals');
});

test('login mengarah ke /admin', function () {
    $u = User::factory()->create();
    $this->post('/login', ['email' => $u->email, 'password' => 'password'])->assertRedirect('/admin');
});
