<?php

use App\Enums\LeadStatus;
use App\Models\Lead;
use App\Support\LeadMetrics;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

function lead(array $o = []): Lead
{
    return Lead::create(array_merge([
        'nama' => 'X', 'no_hp' => '0812', 'no_hp_ortu' => '0813', 'kelas' => '12 IPA',
        'sumber' => 'website', 'status' => LeadStatus::Baru,
    ], $o));
}

test('totals menghitung total, daftar, conversion', function () {
    lead();
    lead(['status' => LeadStatus::Daftar]);
    lead(['status' => LeadStatus::Daftar]);
    $t = LeadMetrics::totals();
    expect($t['total'])->toBe(3);
    expect($t['daftar'])->toBe(2);
    expect($t['conversion'])->toBe(66.7);
});

test('conversion 0 saat tak ada lead', function () {
    expect(LeadMetrics::totals()['conversion'])->toBe(0.0);
});

test('trend mengembalikan N hari dengan 0 untuk hari kosong', function () {
    lead();
    $tr = LeadMetrics::trend(7);
    expect($tr['labels'])->toHaveCount(7);
    expect($tr['data'])->toHaveCount(7);
    expect(array_sum($tr['data']))->toBe(1);
});

test('bySource & byStatus menghitung', function () {
    lead(['sumber' => 'instagram']);
    lead(['sumber' => 'instagram']);
    expect(LeadMetrics::bySource()['instagram'])->toBe(2);
    expect(LeadMetrics::byStatus()['baru'])->toBeGreaterThanOrEqual(2);
});
