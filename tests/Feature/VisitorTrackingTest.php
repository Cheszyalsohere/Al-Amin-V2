<?php

use App\Models\PageView;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('kunjungan landing tercatat sebagai unique pertama kali', function () {
    $this->get('/')->assertOk();
    expect(PageView::where('path', '/')->count())->toBe(1);
    expect(PageView::first()->is_unique)->toBeTrue();
});

test('rute admin & login tidak dilacak', function () {
    $this->get('/login');
    expect(PageView::where('path', 'login')->count())->toBe(0);
});
