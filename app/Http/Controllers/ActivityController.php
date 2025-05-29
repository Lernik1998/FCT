<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // Actividades en la página publica
    public function index()
    {
        // Obtengo todas las actividades donde el status sea active
        $activities = Activity::where('status', 'active')
            ->get()
            ->unique('name') // Filtra por nombre
            ->values(); // Reindexa la colección

        return inertia('Public/Activity', compact('activities'));
    }

    // Muestra información de una activadad publica
    public function show(Activity $activity)
    {
        //Obtener la actividad
        $activity = Activity::findOrFail($activity->id);

        //Retornar la actividad
        return inertia('Public/Activity/ActivityCard', compact('activity'));
    }

    // Actividad de un usuario
    public function showUserActivity($id)
    {
        //Obtener la actividad
        $activity = Activity::findOrFail($id);

        //Retornar la actividad
        return inertia('User/ActivityOptions/ActivityShow', compact('activity'));
    }
}