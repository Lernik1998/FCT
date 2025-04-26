<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Activity; // Importación del modelo Activity

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds. 
     */
    public function run(): void
    {
        Activity::create([
            'name' => 'Spinning',
            'description' => 'Ejercicio cardiovascular de alta intensidad realizado en bicicletas estáticas con cambios de ritmo y resistencia.',
            'image' => '/ownImages/activities/spinning.jpg',
            'price' => 10.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-05-05',
            'user_id' => 3,
            'category_id' => 5,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Pesas',
            'description' => 'Entrenamiento de fuerza basado en el levantamiento de pesas para desarrollar masa muscular y resistencia.',
            'image' => '/ownImages/activities/pesas.jpg',
            'price' => 10.00,
            'start_time' => '15:30:00',
            'end_time' => '16:30:00',
            'status' => 'active',
            'date' => '2025-05-05',
            'user_id' => 3,
            'category_id' => 3,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Zumba',
            'description' => 'Ejercicio aeróbico que combina baile y movimientos dinámicos al ritmo de la música latina.',
            'image' => '/ownImages/activities/zumba.jpg',
            'price' => 10.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-05-05',
            'user_id' => 3,
            'category_id' => 2,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Ejercicios con peso corporal',
            'description' => 'Entrenamiento funcional que utiliza el propio peso del cuerpo para fortalecer músculos y mejorar la resistencia.',
            'image' => '/ownImages/activities/fuerzaCorporal.jpg',
            'price' => 10.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-05-05',
            'user_id' => 3,
            'category_id' => 3,
            'slots' => 10,
        ]);


        Activity::create([
            'name' => 'Boxeo',
            'description' => 'Entrenamiento de alta intensidad que combina golpes, movimientos de defensa y acondicionamiento físico.',
            'image' => '/ownImages/activities/boxeo.jpg',
            'price' => 12.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-02-03',
            'user_id' => 3,
            'category_id' => 5,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'TRX',
            'description' => 'Ejercicio en suspensión que utiliza el peso corporal para desarrollar fuerza, equilibrio y flexibilidad.',
            'image' => '/ownImages/activities/trx.jpg',
            'price' => 11.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-02-04',
            'user_id' => 3,
            'category_id' => 4,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Pilates',
            'description' => 'Método de entrenamiento que mejora la postura, la flexibilidad y la fuerza a través de ejercicios de control.',
            'image' => '/ownImages/activities/pilates.jpg',
            'price' => 10.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-02-05',
            'user_id' => 3,
            'category_id' => 4,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Yoga',
            'description' => 'Disciplina que combina posturas físicas, respiración y meditación para mejorar el bienestar físico y mental.',
            'image' => '/ownImages/activities/yoga.avif',
            'price' => 10.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-02-06',
            'user_id' => 3,
            'category_id' => 4,
            'slots' => 10,
        ]);

        Activity::factory(10)->create([
            'status' => 'pending',
            'user_id' => 3,
            'category_id' => 4,
            'date' => '2025-02-07',
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'slots' => 10,
        ]);

        Activity::factory(10)->create([
            'status' => 'inactive',
            'user_id' => 3,
            'category_id' => 4,
            'date' => '2025-02-08',
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'slots' => 10,
        ]);
    }
}