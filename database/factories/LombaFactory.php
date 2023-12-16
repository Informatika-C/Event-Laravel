<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lomba>
 */
class LombaFactory extends Factory
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
            'max_anggota' => $this->faker->randomNumber(),
            'biaya_registrasi' => $this->faker->randomNumber(),
            'keterangan' => $this->faker->text(),
            'ruangan_lomba' => $this->faker->text(),
            'kuota_lomba' => $this->faker->randomNumber(),
            'pelaksanaan_lomba' => $this->faker->date(),
        ];
    }
}
