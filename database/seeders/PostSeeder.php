<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::create([
            'title' => 'Motivación',
            'content' => 'La motivación es el motor que nos impulsa a alcanzar nuestras metas. Descubre estrategias para mantenerla alta incluso en los días más difíciles y transforma tus sueños en realidad.',
            'image' => 'post1.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Mentalidad',
            'content' => 'Una mentalidad fuerte es la base del éxito. Aprende a cultivar pensamientos positivos, superar limitaciones y desarrollar la resiliencia necesaria para enfrentar cualquier desafío.',
            'image' => 'post2.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Objetivos',
            'content' => 'Establecer objetivos claros y alcanzables es fundamental para el crecimiento personal. Te enseñamos el método SMART para definir metas efectivas y crear un plan de acción realista.',
            'image' => 'post3.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Intensidad',
            'content' => 'La intensidad en el entrenamiento marca la diferencia entre resultados mediocres y extraordinarios. Descubre cómo optimizar tus sesiones para maximizar ganancias sin sobreentrenamiento.',
            'image' => 'post4.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Compartir',
            'content' => 'Compartir conocimientos y experiencias nos enriquece a todos. Exploramos el poder de la comunidad y cómo el apoyo mutuo acelera nuestro desarrollo personal y profesional.',
            'image' => 'post5.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Sprints',
            'content' => 'Los sprints no son solo para atletas. Esta técnica de entrenamiento mejora tu capacidad cardiovascular, quema grasa eficientemente y puede aplicarse a la productividad diaria.',
            'image' => 'post6.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Pesas',
            'content' => 'El entrenamiento con pesas transforma tu cuerpo y mente. Guía completa sobre técnicas adecuadas, frecuencia de entrenamiento y cómo progresar de forma segura y efectiva.',
            'image' => 'post7.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Maratón',
            'content' => 'Prepararse para un maratón es una jornada de superación personal. Consejos sobre planificación, nutrición específica y mentalidad para cruzar esa línea de meta con éxito.',
            'image' => 'post8.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Nutrición',
            'content' => 'La nutrición adecuada es el combustible para un cuerpo y mente saludables. Aprende los principios básicos de una alimentación balanceada que optimiza tu rendimiento diario.',
            'image' => 'post9.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Verduras',
            'content' => 'Las verduras son pilares de una dieta saludable. Descubre sus múltiples beneficios, cómo incorporarlas creativamente en tus comidas y las más nutritivas para cada temporada.',
            'image' => 'post10.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Limón',
            'content' => 'El limón es un superalimento con múltiples usos. Desde reforzar tu sistema inmunológico hasta usos en limpieza ecológica, explora todas las propiedades de este cítrico versátil.',
            'image' => 'post11.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Proteina',
            'content' => 'Las proteínas son esenciales para la reparación y crecimiento muscular. Guía sobre fuentes de calidad, cantidades óptimas y el momento ideal para su consumo según tus objetivos.',
            'image' => 'post12.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Café',
            'content' => 'El café puede ser un aliado para tu rendimiento cuando se consume adecuadamente. Analizamos sus beneficios, la dosis óptima y el mejor momento para tomarlo según tu ritmo circadiano.',
            'image' => 'post13.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Respiración',
            'content' => 'Dominar técnicas de respiración reduce el estrés y mejora el rendimiento. Métodos prácticos para controlar la ansiedad, aumentar la concentración y oxigenar mejor tu cuerpo.',
            'image' => 'post14.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Descanso',
            'content' => 'El descanso de calidad es tan importante como el entrenamiento. Cómo mejorar tu sueño, estrategias de recuperación activa y señales de que necesitas un día de reposo.',
            'image' => 'post15.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Desayuno',
            'content' => 'El desayuno puede marcar el tono de tu día. Ideas nutritivas y rápidas para distintos estilos de vida, desde el ayuno intermitente hasta desayunos completos pre-entrenamiento.',
            'image' => 'post16.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Nueces',
            'content' => 'Las nueces son pequeños paquetes de nutrición. Comparativa de los distintos tipos, sus beneficios para la salud cerebral y cómo incorporarlas inteligentemente en tu dieta.',
            'image' => 'post17.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Hidratación',
            'content' => 'Mantenerte hidratado es crucial para todas las funciones corporales. Aprende a calcular tus necesidades individuales, señales de deshidratación y formas creativas de beber más agua.',
            'image' => 'post18.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Energía',
            'content' => 'Optimiza tus niveles de energía naturalmente. Combina nutrición, sueño y gestión del estrés para mantenerte vital durante todo el día sin depender de estimulantes artificiales.',
            'image' => 'post19.avif',
            'user_id' => 3,
        ]);

        Post::create([
            'title' => 'Especias',
            'content' => 'Las especias transforman comidas simples en experiencias gourmet mientras aportan beneficios saludables. Guía de las especias esenciales y sus propiedades medicinales ocultas.',
            'image' => 'post20.avif',
            'user_id' => 3,
        ]);
    }
}