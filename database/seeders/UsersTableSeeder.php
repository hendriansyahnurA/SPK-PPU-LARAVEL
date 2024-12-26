<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan admin
        DB::table('users')->insert([
            'name' => 'Admin User',
            'username' => 'admin',
            'password' => bcrypt('password'), // Ganti 'password' dengan password yang diinginkan
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Menambahkan user biasa
        DB::table('users')->insert([
            'name' => 'Regular User',
            'username' => 'evaluator',
            'password' => bcrypt('password'), // Ganti 'password' dengan password yang diinginkan
            'role' => 'user',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
