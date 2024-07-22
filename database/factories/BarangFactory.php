<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $keterangan = [
            'Kondisi Baik',
            'Kondisi Rusak',
            'Kondisi Hilang',
        ];
        
        return [
            'jenis_id' => rand(1, 2),
            'uraian_id' => rand(1, 14),
            'kode_barang' => fake()->numerify('##########'),
            'nup' => fake()->numberBetween(1, 200),
            'nama' => fake()->words(rand(3, 7), true),
            'tahun' => fake()->numberBetween(2017, 2023),
            'kuantitas' => 1,
            'lokasi' => 'BBPSI MEKTAN',
            'nilai' => fake()->numberBetween(2000000, 35000000),
            'keterangan' => fake()->randomElement($keterangan),
            'created_at' => Carbon::now()->subDays(rand(0, 120)),
            'updated_at' => Carbon::now(),
        ];
    }
}
