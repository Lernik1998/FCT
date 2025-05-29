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
            'image' => 'spinning.jpg',
            'price' => 10.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-06-15',
            'user_id' => 4,
            'category_id' => 2,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Spinning',
            'description' => 'Ejercicio cardiovascular de alta intensidad realizado en bicicletas estáticas con cambios de ritmo y resistencia.',
            'image' => 'spinning.jpg',
            'price' => 10.00,
            'start_time' => '15:30:00',
            'end_time' => '17:00:00',
            'status' => 'active',
            'date' => '2025-06-15',
            'user_id' => 4,
            'category_id' => 2,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Remo indoor',
            'description' => 'Entrenamiento cardiovascular completo con máquina de remo.',
            'image' => 'remo.avif',
            'price' => 10.00,
            'start_time' => '13:00:00',
            'end_time' => '14:00:00',
            'status' => 'active',
            'date' => '2025-06-21',
            'user_id' => 4,
            'category_id' => 2,
            'slots' => 12,
        ]);

        Activity::create([
            'name' => 'Zumba',
            'description' => 'Ejercicio aeróbico que combina baile y movimientos dinámicos al ritmo de la música latina.',
            'image' => 'zumba.jpg',
            'price' => 10.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-06-17',
            'user_id' => 3,
            'category_id' => 3,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Dance fitness',
            'description' => 'Rutinas dinámicas con movimientos coreografiados y música moderna.',
            'image' => 'danceFit.avif',
            'price' => 9.00,
            'start_time' => '16:00:00',
            'end_time' => '17:00:00',
            'status' => 'active',
            'date' => '2025-06-18',
            'user_id' => 3,
            'category_id' => 3,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Ritmos latinos',
            'description' => 'Clase de baile con salsa, bachata y otros ritmos para mejorar coordinación y disfrutar.',
            'image' => 'latinrit.avif',
            'price' => 9.50,
            'start_time' => '17:30:00',
            'end_time' => '18:30:00',
            'status' => 'active',
            'date' => '2025-06-19',
            'user_id' => 3,
            'category_id' => 3,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Yoga',
            'description' => 'Disciplina que combina posturas físicas, respiración y meditación para mejorar el bienestar físico y mental.',
            'image' => 'yoga.avif',
            'price' => 10.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-06-26',
            'user_id' => 3,
            'category_id' => 4,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'TRX',
            'description' => 'Ejercicio en suspensión que utiliza el peso corporal para desarrollar fuerza, equilibrio y flexibilidad.',
            'image' => 'trx.jpg',
            'price' => 11.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-06-22',
            'user_id' => 3,
            'category_id' => 4,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Pesas',
            'description' => 'Entrenamiento de fuerza basado en el levantamiento de pesas para desarrollar masa muscular y resistencia.',
            'image' => 'pesas.avif',
            'price' => 10.00,
            'start_time' => '15:30:00',
            'end_time' => '16:30:00',
            'status' => 'active',
            'date' => '2025-06-15',
            'user_id' => 3,
            'category_id' => 5,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Boxeo',
            'description' => 'Entrenamiento de alta intensidad que combina golpes, movimientos de defensa y acondicionamiento físico.',
            'image' => 'boxeo.avif',
            'price' => 12.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-06-20',
            'user_id' => 3,
            'category_id' => 5,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Ejercicios con peso corporal',
            'description' => 'Entrenamiento funcional que utiliza el propio peso del cuerpo para fortalecer músculos y mejorar la resistencia.',
            'image' => 'body.avif',
            'price' => 10.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-06-18',
            'user_id' => 3,
            'category_id' => 6,
            'slots' => 10,
        ]);

        Activity::create([
            'name' => 'Pilates',
            'description' => 'Método de entrenamiento que mejora la postura, la flexibilidad y la fuerza a través de ejercicios de control.',
            'image' => 'pilates.jpg',
            'price' => 10.00,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'status' => 'active',
            'date' => '2025-06-24',
            'user_id' => 3,
            'category_id' => 6,
            'slots' => 10,
        ]);

        Activity::factory(1)->create([
            'status' => 'pending',
            'user_id' => 3,
            'category_id' => 4,
            'date' => '2025-06-28',
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'slots' => 10,
        ]);

        Activity::factory(1)->create([
            'status' => 'inactive',
            'user_id' => 3,
            'category_id' => 4,
            'date' => '2025-06-28',
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'slots' => 10,
        ]);
    }
}