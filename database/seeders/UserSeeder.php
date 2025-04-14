<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User; // Modelo de Usuario para crear datos inicales

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeder de Usuarios iniciales, uno de cada tipo
        User::create([
            'name' => 'Lernik',
            'email' => 'lernik10@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'trainer',
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'a@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'user',
            'email' => 'u@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'trainer',
            'email' => 't@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'trainer',
        ]);

        User::create([
            'name' => 'trainer',
            'email' => 't2@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'trainer',
        ]);

        User::create([
            'name' => 'trainer',
            'email' => 't3@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'trainer',
        ]);

        User::create([
            'name' => 'trainer',
            'email' => 't4@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'trainer',
        ]);
    }
}
