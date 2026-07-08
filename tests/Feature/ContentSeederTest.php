<?php

use App\Models\Faq;
use App\Models\Program;
use App\Models\SiteSetting;
use App\Models\SiteStat;
use App\Models\Testimonial;
use App\Models\User;
use Database\Seeders\ContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('content seeder mengisi konten & admin', function () {
    $this->seed(ContentSeeder::class);

    expect(SiteStat::count())->toBe(3);
    expect(Program::count())->toBe(3);
    expect(Faq::count())->toBe(8);
    expect(Testimonial::count())->toBe(12);
    expect(SiteSetting::where('key', 'wa_number')->value('value'))->toBe('6285190909689');
    expect(User::where('email', 'admin@alamin.test')->exists())->toBeTrue();
});

test('seeder idempotent (jalan 2x tidak duplikat)', function () {
    $this->seed(ContentSeeder::class);
    $this->seed(ContentSeeder::class);
    expect(Program::count())->toBe(3);
});
