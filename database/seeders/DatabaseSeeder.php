<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('admin')->insert([
            ['nombre' => 'azzed', 'correo' => 'az@example.com', 'contrasena' => bcrypt('123')],
            ['nombre' => 'azz', 'correo' => 'azed@example.com', 'contrasena' => bcrypt('456')],
        ]);
    }
}
