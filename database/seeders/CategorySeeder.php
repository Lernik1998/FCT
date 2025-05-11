<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Categorías base del sistema
     * 
     * @var array
     */
    protected $baseCategories = [
        [
            'name' => 'General',
            'description' => 'Acceso general a todos los calendarios'
        ],
        [
            'name' => 'Resistencia y cardio',
            'description' => 'Running en cinta, ciclismo indoor, HIIT cardiovascular, remo. Mejorar la coordinación, velocidad, fuerza, y resistencia.'
        ],
        [
            'name' => 'Baile',
            'description' => 'Zumba, dance fitness, ritmos latinos, aerodance. Ejercicios que combinan movimiento rítmico con música, mejorando la coordinación y el equilibrio.'
        ],
        [
            'name' => 'Flexibilidad y cuerpo-mente',
            'description' => 'Yoga, pilates, stretching, meditación guiada. Mejorar la movilidad, reducir el estrés, trabajar cuerpo y mente.'
        ],
        [
            'name' => 'Fuerza y acondicionamiento',
            'description' => 'Circuitos funcionales, pesas, core, TRX, calistenia. Entrenamientos enfocados en el desarrollo muscular mediante pesas y resistencia.'
        ],
        [
            'name' => 'Rehabilitación o movimiento suave',
            'description' => 'Movilidad articular, fisioterapia preventiva, ejercicios posturales, entrenamiento adaptado.'
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->baseCategories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']], // Busca por el nombre único
                $category // Datos a insertar/actualizar
            );
        }

        // Opcional: Limpiar categorías que no están en la lista base
        // Category::whereNotIn('name', array_column($this->baseCategories, 'name'))->delete();
    }
}