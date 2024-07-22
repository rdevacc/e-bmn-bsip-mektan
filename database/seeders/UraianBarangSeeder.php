<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UraianBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('uraian_barangs')->insert([
            [
                'nama' => 'Lemari Es',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'AC Split',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Microphone Table Stand',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Laptop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Netbook',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Printer (Peralatan Personal Komputer)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Scanner (Peralatan Personal Komputer)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Motor Listrik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pompa Air',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Mesin Absensi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'LCD Projector/Infocus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Televisi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Power Supply Microphone',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Power Amplifier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
