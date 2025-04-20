<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category; // Importación del modelo Category

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Resistencia y cardio',
            'description' => 'Running en cinta, ciclismo indoor, HIIT cardiovascular, remo. Mejorar la coordinación, velocidad, fuerza, y resistencia.',
        ]);

        Category::create([
            'name' => 'Baile',
            'description' => 'Zumba, dance fitness, ritmos latinos, aerodance. Ejercicios que combinan movimiento rítmico con música, mejorando la coordinación y el equilibrio.',
        ]);

        Category::create([
            'name' => 'Flexibilidad y cuerpo-mente',
            'description' => 'Yoga, pilates, stretching, meditación guiada. Mejorar la movilidad, reducir el estrés, trabajar cuerpo y mente.',
        ]);

        Category::create([
            'name' => 'Fuerza y acondicionamiento',
            'description' => 'Circuitos funcionales, pesas, core, TRX, calistenia. Entrenamientos enfocados en el desarrollo muscular mediante pesas y resistencia.',
        ]);

        Category::create([
            'name' => 'Rehabilitación o movimiento suave',
            'description' => 'Movilidad articular, fisioterapia preventiva, ejercicios posturales, entrenamiento adaptado.',
        ]);
    }
}
