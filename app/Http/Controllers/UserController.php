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
    public function index()
    {
        // Obtengo los datos del user actual, obtengo el id del user actual
        $userId = auth()->id();

        $user = User::findOrFail($userId);

        // Obtengo todas las actividades disponibles
        $activities = Activity::all();

        // dd($user);

        return inertia('User/UserIndex', compact('user', 'activities'));
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
}
