<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LombaKelompok>
 */
class LombaKelompokFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lomba_id' => \App\Models\Lomba::factory()->create()->id,
            'kelompok_id' => \App\Models\Kelompok::factory()->create()->id,
            'lunas' => $this->faker->boolean,
        ];
    }
}
