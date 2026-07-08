<?php

namespace Database\Seeders;

use App\Models\Lead;
use Illuminate\Database\Seeder;

class DummyLeadSeeder extends Seeder
{
    public function run(): void
    {
        Lead::factory()->count(40)->create();
    }
}
