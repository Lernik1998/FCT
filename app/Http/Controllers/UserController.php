<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; // Modelo de User
use App\Models\Activity; // Modelo de Activity

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // Obtengo los datos del user actual, obtengo el id del user actual
    //     $userId = auth()->id();

    //     $user = User::findOrFail($userId);

    //     // Obtengo todas las actividades disponibles
    //     $activities = Activity::all();

    //     // dd($user);
    //     return inertia('User/UserIndex', compact('user', 'activities'));
    // }

    public function index()
    {
        // Obtener el usuario autenticado
        $userId = auth()->id();
        $user = User::findOrFail($userId);

        // Primeras 3 actividades con imagen
        $featuredActivities = Activity::query()
            ->select(['id', 'name', 'description', 'date', 'category_id', 'image', 'start_time', 'end_time', 'price'])
            ->limit(3)
            ->get();

        // Obtener actividades con paginación y búsqueda
        $activities = Activity::query()
            ->where('status', 'active') // Solo las activas
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->select(['id', 'name', 'description', 'date', 'category_id', 'start_time', 'end_time', 'price'])
            ->paginate(10)
            ->appends(['search' => request('search')]);

        return inertia('User/UserIndex', [
            'user' => $user,
            'activities' => $activities,
            'filters' => ['search' => request('search')],
            'popularAct' => $featuredActivities
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
        return inertia('User/UserStats', [
            'user' => $user,
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
