<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class pm_kriteria_nilai extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pm_kriteria_nilai')->insert([
            'nama' => 'Sangat kurang',
            'nilai' => 1,
        ]);
        DB::table('pm_kriteria_nilai')->insert([
            'nama' => 'kurang',
            'nilai' => 2,
        ]);
        DB::table('pm_kriteria_nilai')->insert([
            'nama' => 'cukup',
            'nilai' => 3,
        ]);
        DB::table('pm_kriteria_nilai')->insert([
            'nama' => 'Memenuhi Persyaratan',
            'nilai' => 4,
        ]);
        DB::table('pm_kriteria_nilai')->insert([
            'nama' => 'Sangat Memenuhi Persyaratan',
            'nilai' => 5,
        ]);
    }
}
