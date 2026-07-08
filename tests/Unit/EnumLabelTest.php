<?php

use App\Enums\LeadStatus;
use App\Enums\LeadSource;
use App\Enums\ProgramType;

test('lead status label & options', function () {
    expect(LeadStatus::Baru->label())->toBe('Baru');
    expect(LeadStatus::ClosedLost->label())->toBe('Closed');
    expect(LeadStatus::options())->toHaveKey('dikontak', 'Dikontak');
});

test('lead source & program labels', function () {
    expect(LeadSource::Temen->label())->toBe('Temen / Referral');
    expect(ProgramType::Utbk->label())->toBe('UTBK / SNBT');
    expect(ProgramType::options())->toHaveKey('smp', 'SMP Reguler');
});
