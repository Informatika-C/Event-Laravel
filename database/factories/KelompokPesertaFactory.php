<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KelompokPeserta>
 */
class KelompokPesertaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kelompok_id' => \App\Models\Kelompok::factory()->create()->id,
            'peserta_id' => \App\Models\User::factory()->create()->id,
        ];
    }
}
