<?php

use App\Models\{Program, Faq, Testimonial, SiteStat, SiteSetting, User};

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('content seeder mengisi konten & admin', function () {
    $this->seed(\Database\Seeders\ContentSeeder::class);

    expect(SiteStat::count())->toBe(3);
    expect(Program::count())->toBe(3);
    expect(Faq::count())->toBe(8);
    expect(Testimonial::count())->toBe(12);
    expect(SiteSetting::where('key', 'wa_number')->value('value'))->toBe('6285190909689');
    expect(User::where('email', 'admin@alamin.test')->exists())->toBeTrue();
});

test('seeder idempotent (jalan 2x tidak duplikat)', function () {
    $this->seed(\Database\Seeders\ContentSeeder::class);
    $this->seed(\Database\Seeders\ContentSeeder::class);
    expect(Program::count())->toBe(3);
});
