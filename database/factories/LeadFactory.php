<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'no_hp' => '0812'.fake()->numerify('########'),
            'no_hp_ortu' => '0813'.fake()->numerify('########'),
            'kelas' => fake()->randomElement(['9 SMP', '10 IPA', '11 IPS', '12 IPA']),
            'program_minat' => fake()->randomElement(['smp', 'sma_ipa', 'sma_ips', 'utbk']),
            'sumber' => fake()->randomElement(['website', 'instagram', 'tiktok', 'temen', 'google']),
            'status' => fake()->randomElement(['baru', 'dikontak', 'daftar', 'closed_lost']),
            'created_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
