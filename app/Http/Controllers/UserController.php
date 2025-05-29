<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User; // Modelo de User
use App\Models\Activity; // Modelo de Activity
use App\Models\UserActivitiesReservations; // Modelo de UserActivitiesReservations
use App\Models\Category; // Modelo de Category


class UserController extends Controller
{
    // Vista principal del user
    public function index()
    {
        // Obtenemos el id del usuario
        $userId = auth()->id();
        $user = User::findOrFail($userId);

        $now = now();
        $currentDate = $now->format('Y-m-d');
        $currentTime = $now->format('H:i:s');

        // Obtenemos los ids de las actividades reservadas
        $reservedActivityIds = $user->reservations()->pluck('activity_id')->toArray();

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
            ->whereNotIn('id', $reservedActivityIds)
            ->limit(3)
            ->get();

        $activitiesQuery = Activity::with('category')
            ->where('status', 'active')
            ->whereNotIn('id', $reservedActivityIds) // <-- Excluir reservadas
            ->where(function ($query) use ($currentDate, $currentTime) {
                $query->where('date', '>', $currentDate)
                    ->orWhere(function ($q) use ($currentDate, $currentTime) {
                        $q->where('date', $currentDate)
                            ->where('start_time', '>', $currentTime);
                    });
            })
            ->whereHas('category', function ($q) {
                $q->where('name', '!=', 'General');
            });


        // Aplicar filtros
        if (request('search')) {
            $activitiesQuery->where(function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('description', 'like', '%' . request('search') . '%');
            });
        }

        // Filtrar por categoría
        if (request('category') && request('category') !== 'all') {
            $activitiesQuery->whereHas('category', function ($q) {
                $q->where('name', request('category'));
            });
        }

        // Obtenemos las actividades
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

    // Función para mostrar las estadísticas de un usuario
    public function stats()
    {
        // Obtenemos el id del usuario
        $userId = auth()->id();

        $user = User::findOrFail($userId);

        // Obtengo todas las reservas del usuario
        $reservations = UserActivitiesReservations::where('user_id', $userId)->get();

        $totalMinutes = 0;

        //  Con el id de la actividad reservada, obtengo la duración de la actividad
        foreach ($reservations as $reservation) {
            $activity = Activity::findOrFail($reservation->activity_id);

            // Obtenemos la fecha de la actividad
            $date = \Carbon\Carbon::parse($reservation->activity_datetime)->toDateString();
            $start = \Carbon\Carbon::parse($date . ' ' . $activity->start_time);
            $end = \Carbon\Carbon::parse($date . ' ' . $activity->end_time);

            $minutes = $start->diffInMinutes($end);

            // Logs
            \Log::info("Minutes for activity {$activity->id}: {$minutes}");

            \Log::info('Total reservations: ' . $reservations->count());

            \Log::info("Total minutes so far: {$totalMinutes}");

            $totalMinutes += $minutes;
        }

        $totalHours = $totalMinutes / 60;
        $totalHoursFormatted = number_format($totalHours, 1) . 'h'; // Formateo la hora

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
