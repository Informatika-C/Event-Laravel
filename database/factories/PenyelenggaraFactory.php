<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penyelenggara>
 */
class PenyelenggaraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_penyelenggara' => $this->faker->name(),
            'no_telp' => $this->faker->phoneNumber(),
            'logo' => $this->faker->imageUrl(),
        ];
    }
}
