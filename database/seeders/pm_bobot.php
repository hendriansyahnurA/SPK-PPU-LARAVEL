<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pm_bobot extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pm_bobot')->insert([
            'selisih' => -4,
            'bobot' => 1,
            'keterangan' => "Kompetensi individu kekurangan 4 tingkat",
        ]);
        DB::table('pm_bobot')->insert([
            'selisih' => -3,
            'bobot' => 2,
            'keterangan' => "Kompetensi individu  kekurangan 3 tingkat",
        ]);
        DB::table('pm_bobot')->insert([
            'selisih' => -2,
            'bobot' => 3,
            'keterangan' => "Kompetensi individu kekurangan 2 tingkat",
        ]);
        DB::table('pm_bobot')->insert([
            'selisih' => -1,
            'bobot' => 4,
            'keterangan' => "Kompetensi individu kekurangan 1 tingkat",
        ]);
        DB::table('pm_bobot')->insert([
            'selisih' => 0,
            'bobot' => 5,
            'keterangan' => "Tidak ada selisih (kompetensi sesuai dgn yg dibutuhkan)",
        ]);
        DB::table('pm_bobot')->insert([
            'selisih' => 1,
            'bobot' => 4.5,
            'keterangan' => "Kompetensi individu kelebihan 1 tingkat",
        ]);
        DB::table('pm_bobot')->insert([
            'selisih' => 2,
            'bobot' => 3.5,
            'keterangan' => "Kompetensi individu kelebihan 2 tingkat",
        ]);
        DB::table('pm_bobot')->insert([
            'selisih' => 3,
            'bobot' => 2.5,
            'keterangan' => "Kompetensi individu kelebihan 3 tingkat",
        ]);
        DB::table('pm_bobot')->insert([
            'selisih' => 4,
            'bobot' => 1.5,
            'keterangan' => "Kompetensi individu kelebihan 4 tingkat",
        ]);
    }
}
