<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; // Modelo de User
use App\Models\PersonalizedTraining; // Modelo de PersonalizedTraining
use App\Models\Activity; // Modelo de Activity

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Verifico el rol del usuario autenticado
        $user = auth()->user();

        // Obtengo todos los entrenadores
        $trainers = User::where('role', 'trainer')->get();


        // Si el usuario no tiene rol, lo redirecciono a la pagina public
        // if ($user->role === null) {
        //     return inertia('Public/Trainer');
        // }

        if (!$user) {
            return inertia('Public/Trainer', ['trainers' => $trainers]);
        } else {

        }

        // Dependiendo del rol del usuario, retorno una pagina diferente
        switch ($user->role) {
            case 'trainer':
                return inertia('Trainer/TrainerIndex');
            case 'admin':
                // return inertia('Admin/AdminIndex');
                dd('Index del admin');
            case 'user':
                return inertia('User/UserIndex');

            default:

                return inertia('Public/Trainer', ['trainers' => $trainers]);

        }
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

        // Obtengo los planes personalizados del entrenador
        $plans = PersonalizedTraining::where('user_id', $trainer->id)->get();

        //Retornar el entrenador
        return inertia('Trainer/TrainerShow', compact('trainer', 'plans'));
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

    public function createActivityView()
    {
        return inertia('Trainer/Options/ActivityCreate');
    }

    public function storeActivity(Request $request)
    {
        // dd($request->all());

        // Validar los datos
        $request->validate([]);

        // Crear la actividad
        $activity = Activity::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $request['image'],  // Guardamos la ruta, no el archivo
            'price' => $request['price'],
            'duration' => $request['duration'],
            'date' => $request['date'],
            'user_id' => auth()->id(),
        ]);

        // Retornar una respuesta exitosa
        return redirect()->route('trainers.index');

    }
}
