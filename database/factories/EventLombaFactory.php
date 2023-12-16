<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventLomba>
 */
class EventLombaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lomba' => $this->faker->name(),
            'deskripsi' => $this->faker->text(),
            'tempat' => $this->faker->address(),
            'tanggal_pendaftaran' => $this->faker->date(),
            'tanggal_penutupan_pendaftaran' => $this->faker->date(),
            'tanggal_pelaksanaan' => $this->faker->date(),
            'banner' => $this->faker->imageUrl(),
            'poster' => $this->faker->imageUrl(),
        ];
    }
}
