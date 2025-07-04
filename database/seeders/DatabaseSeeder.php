<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Indicamos los seeders que queremos llamar
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            ActivitySeeder::class,
            PostSeeder::class,
            PlanSeeder::class,
        ]);
    }
}
