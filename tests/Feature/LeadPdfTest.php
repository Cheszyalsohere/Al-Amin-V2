<?php

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest tak bisa export', fn () => $this->get('/admin/leads/export/pdf')->assertRedirect('/login'));

test('admin mengunduh pdf', function () {
    Lead::factory()->count(3)->create();
    $this->actingAs(User::factory()->create());
    $res = $this->get('/admin/leads/export/pdf');
    $res->assertOk();
    expect($res->headers->get('content-type'))->toContain('application/pdf');
});

test('filter status diteruskan ke pdf', function () {
    Lead::factory()->create(['nama' => 'DaftarSatu', 'status' => 'daftar']);
    $this->actingAs(User::factory()->create());
    $this->get('/admin/leads/export/pdf?status=daftar')->assertOk();
});
