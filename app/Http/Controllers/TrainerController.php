<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // dd('jejje');
        // Verifico el rol del usuario autenticado
        $user = auth()->user();

        // Obtengo todos los entrenadores
        $trainers = User::where('role', 'trainer')->get();

        // dd($trainers);

        // if (!$user) {
        //     return inertia('Public/Trainer', ['trainers' => $trainers]);
        // }

        return inertia('Public/Trainer', ['trainers' => $trainers]);

        // dd($user);


        // if ($user->role === null) {
        //     return inertia('Public/Trainer');
        // }

        // switch ($user->role) {
        //     case 'trainer':
        //         return inertia('Trainer/TrainerIndex');
        //     case 'admin':
        //     // return inertia('Admin/AdminIndex');
        //     case 'user':


        //     // dd($trainers);
        //    

        //     default:
        //        
        //         return inertia('Public/Trainer', ['trainers' => $trainers]);

        // }
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
        //Obtengo el entrenador con el id
        $trainer = User::findOrFail($id);

        //Retornar el entrenador
        return inertia('Trainer/TrainerShow', compact('trainer'));
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
}
