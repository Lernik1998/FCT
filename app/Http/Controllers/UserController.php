<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User; // Modelo de User
use App\Models\Activity; // Modelo de Activity
use App\Models\UserActivitiesReservations; // Modelo de UserActivitiesReservations
use App\Models\Category; // Modelo de Category


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $user = User::findOrFail($userId);

        $now = now();
        $currentDate = $now->format('Y-m-d');
        $currentTime = $now->format('H:i:s');

        // Actividades destacadas (excluyendo General)
        $featuredActivities = Activity::with('category')
            ->where('status', 'active')
            ->whereHas('category', function ($q) {
                $q->where('name', '!=', 'General');
            })
            ->where(function ($query) use ($currentDate, $currentTime) {
                $query->where('date', '>', $currentDate)
                    ->orWhere(function ($q) use ($currentDate, $currentTime) {
                        $q->where('date', $currentDate)
                            ->where('start_time', '>', $currentTime);
                    });
            })
            ->select(['id', 'name', 'description', 'date', 'category_id', 'image', 'start_time', 'end_time', 'price', 'slots'])
            ->limit(3)
            ->get();

        // Query principal para actividades
        $activitiesQuery = Activity::with('category')
            ->where('status', 'active')
            ->where(function ($query) use ($currentDate, $currentTime) {
                $query->where('date', '>', $currentDate)
                    ->orWhere(function ($q) use ($currentDate, $currentTime) {
                        $q->where('date', $currentDate)
                            ->where('start_time', '>', $currentTime);
                    });
            })
            ->whereHas('category', function ($q) {
                $q->where('name', '!=', 'General'); // Excluir General por defecto
            });

        // Aplicar filtros
        if (request('search')) {
            $activitiesQuery->where(function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('description', 'like', '%' . request('search') . '%');
            });
        }

        if (request('category') && request('category') !== 'all') {
            $activitiesQuery->whereHas('category', function ($q) {
                $q->where('name', request('category'));
            });
        }

        $activities = $activitiesQuery
            ->select(['id', 'name', 'description', 'date', 'category_id', 'start_time', 'end_time', 'price', 'slots'])
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->paginate(10)
            ->appends(request()->query());

        // Obtener categorías excluyendo General
        $categories = Category::where('name', '!=', 'General')->get();

        // Obtengo estado de la membresía
        $hasMembership = $user->hasActiveMembership();

        return Inertia::render('User/UserIndex', [
            'user' => $user,
            'activities' => $activities,
            'popularAct' => $featuredActivities,
            'categories' => $categories,
            'filters' => request()->only(['search', 'category']),
            'hasMembership' => $hasMembership,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Función para mostrar las estadísticas de un usuario
    public function stats()
    {
        // dd('buenas');
        $userId = auth()->id();

        $user = User::findOrFail($userId);

        // Obtengo todas las reservas del usuario
        $reservations = UserActivitiesReservations::where('user_id', $userId)->get();


        // // Con el id de la actividad reservada, obtengo la duración de la actividad, para ello recorro reservations
        // foreach ($reservations as $reservation) {
        //     $activity = Activity::findOrFail($reservation->activity_id);
        //     $reservation->start_time = $activity->start_time;
        //     $reservation->end_time = $activity->end_time;
        // }

        foreach ($reservations as $reservation) {
            $activity = Activity::findOrFail($reservation->activity_id);

            $start = \Carbon\Carbon::parse($activity->start_time);
            $end = \Carbon\Carbon::parse($activity->end_time);

            $minutes = $start->diffInMinutes($end);
            $reservation->duration_minutes = $minutes;
            $reservation->duration_human = floor($minutes / 60) . 'h ' . ($minutes % 60) . 'm';
        }



        $totalMinutes = $reservations->sum('duration_minutes');
        $totalHoursFormatted = floor($totalMinutes / 60) . 'h ' . ($totalMinutes % 60) . 'm';

        // Obtengo el total de actividades reservadas
        $totalActivities = $reservations->count();


        return inertia('User/UserStats', [
            'user' => $user,
            'reservations' => $reservations,
            'totalHours' => $totalHoursFormatted,
            'totalActivities' => $totalActivities,
        ]);
    }

    // Función para mostrar la actividad con sus detalles
    public function showActivity(string $id)
    {
        $activity = Activity::findOrFail($id);
        return inertia('User/ActivityShow', [
            'activity' => $activity,
        ]);
    }
}
