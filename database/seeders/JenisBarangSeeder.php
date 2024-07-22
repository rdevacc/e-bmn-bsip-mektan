<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_barangs')->insert([
            [
                'nama' => 'BMN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Inventaris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Royalti',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pribadi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
