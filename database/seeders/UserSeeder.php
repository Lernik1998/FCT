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
            'name' => 'Esteban',
            'email' => 't@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'trainer',
            'image' => 'trainerDefault.avif',
            'description' => 'Con más de una década guiando a personas hacia su mejor versión, Esteban combina técnica, motivación y cercanía. Su enfoque personalizado y su pasión por el fitness inspiran a quienes entrenan con él día a día.',
            'experience_time' => '12',
            'category' => 'Resistencia y cardio',
        ]);

        User::create([
            'name' => 'Clara',
            'email' => 't2@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'trainer',
            'image' => 'trainer2.avif',
            'description' => 'Clara lleva 10 años transformando vidas a través del movimiento. Experta en entrenamiento funcional y bienestar integral, su energía contagiosa convierte cada clase en una experiencia única y motivadora.',
            'experience_time' => '10',
            'category' => 'Baile',
        ]);


        User::create([
            'name' => 'Lisa',
            'email' => 't3@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'trainer',
            'image' => 'trainer3.avif',
            'description' => 'Lisa es una profesional dedicada al crecimiento físico y mental de sus alumnos. Con un enfoque cercano y resultados visibles, ha acompañado a decenas de personas a lograr sus metas de forma sostenible.',
            'experience_time' => '7',
            'category' => 'Flexibilidad y cuerpo-mente',
        ]);

        User::create([
            'name' => 'Laura',
            'email' => 't4@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'trainer',
            'image' => 'trainer4.avif',
            'description' => 'Laura cree que el bienestar se construye desde la constancia. Con 10 años de experiencia, su formación en fitness y nutrición la convierten en una entrenadora versátil, empática y comprometida con cada alumno.',
            'experience_time' => '4',
            'category' => 'Fuerza y acondicionamiento',
        ]);

        User::create([
            'name' => 'Francisco',
            'email' => 't5@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'trainer',
            'image' => 'trainer5.avif',
            'description' => 'Francisco es un entrenador con experiencia en fitness y nutrición. Con un enfoque cercano y resultados visibles, ha acompañado a decenas de personas a lograr sus metas de forma sostenible.',
            'experience_time' => '2',
            'category' => 'Rehabilitación o movimiento suave',
        ]);

        User::create([
            'name' => 'Luis',
            'email' => 'tn@gmail.com',
            'password' => bcrypt('1234'),
            'role' => 'trainer',
            'image' => 'tn.avif',
            'description' => 'Luis es un entrenador apasionado por el bienestar integral. Especializado en fitness y hábitos saludables, combina motivación y conocimiento para guiar a cada persona hacia su mejor versión.',
            'experience_time' => '1',
        ]);


        // 100 usuarios
        User::factory(1)->create([
            'role' => 'user',
        ]);
    }
}
