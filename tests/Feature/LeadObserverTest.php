<?php

use App\Enums\LeadStatus;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function makeLead(): Lead
{
    return Lead::create([
        'nama' => 'Budi', 'no_hp' => '08123456789', 'no_hp_ortu' => '08987654321',
        'kelas' => '12 IPA', 'sumber' => 'website', 'status' => LeadStatus::Baru,
    ]);
}

test('lead baru mencatat event created', function () {
    $lead = makeLead();
    expect($lead->events()->where('event_type', 'created')->count())->toBe(1);
});

test('ubah status mencatat event & set timestamp', function () {
    $lead = makeLead();

    $lead->update(['status' => LeadStatus::Dikontak]);
    expect($lead->fresh()->contacted_at)->not->toBeNull();
    expect($lead->events()->where('event_type', 'status_changed')->count())->toBe(1);

    $lead->update(['status' => LeadStatus::Daftar]);
    expect($lead->fresh()->converted_at)->not->toBeNull();
    expect($lead->events()->where('new_status', 'daftar')->count())->toBe(1);
});

test('id lead berupa ulid (26 char)', function () {
    expect(strlen(makeLead()->id))->toBe(26);
});
