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
            'name' => 'Deportes acuáticos',
            'description' => 'Actividades físicas que se realizan en el agua, como natación, surf o aquagym.',
        ]);

        Category::create([
            'name' => 'Danza',
            'description' => 'Ejercicios que combinan movimiento rítmico con música, mejorando la coordinación y el equilibrio.',
        ]);

        Category::create([
            'name' => 'Ejercicios de fuerza',
            'description' => 'Entrenamientos enfocados en el desarrollo muscular mediante pesas y resistencia.',
        ]);

        Category::create([
            'name' => 'Ejercicios de resistencia',
            'description' => 'Actividades físicas diseñadas para mejorar la capacidad aeróbica y la resistencia muscular.',
        ]);

        Category::create([
            'name' => 'Cardio',
            'description' => 'Ejercicios enfocados en mejorar la salud cardiovascular, como correr, saltar la cuerda o ciclismo.',
        ]);

    }
}
