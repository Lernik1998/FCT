<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; // Modelo de User
// use App\Models\PersonalizedTraining; // Modelo de PersonalizedTraining
use App\Models\Activity; // Modelo de Activity
use App\Models\Category; // Modelo de Category
use App\Models\Message; // Modelo de Message
use App\Models\UserActivitiesReservations; // Modelo de UserActivitiesReservations
use Illuminate\Support\Facades\Auth; // Facade para autenticación
use Inertia\Inertia; // Facade para Inertia

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
        // $plans = PersonalizedTraining::where('user_id', $trainer->id)->get();

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
        // Obtengo todas las categorias
        $categories = Category::all();

        return inertia('Trainer/Options/ActivityCreate', compact('categories'));
    }

    public function storeActivity(Request $request)
    { {
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
                'category_id' => $request['category_id'],
            ]);

            // Retornar una respuesta exitosa
            return redirect()->route('trainers.index');

        }
    }


    // RESERVATIONS
    // public function reservations()
    // {
    //     // Obtengo el entrenador con el id
    //     $trainer = User::findOrFail(auth()->id());

    //     // dd($trainer->id);

    //     // $idCategory = Category::where('name', $trainer->category)->first()->id;

    //     // dd($idCategory);

    //     // Obtengo las actividades del entrenador
    //     $activities = Activity::where('user_id', $trainer->id)->get();

    //     dd($activities);

    //     // Obtengo las reservas del entrenador
    //     $reservations = UserActivitiesReservations::where('user_id', $trainer->id)->get();

    //     return inertia('Trainer/TrainerReservations', compact('activities', 'reservations'));
    // }


    public function reservations()
    {
        // 1. Obtener el ID del entrenador autenticado
        $trainerId = auth()->id();

        // 2. Obtener las actividades que ha creado este entrenador
        $activities = Activity::where('user_id', $trainerId)
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        // 3. Obtener las reservas para estas actividades
        $reservations = UserActivitiesReservations::whereIn('activity_id', $activities->pluck('id'))
            ->with('user') // Opcional: si necesitas datos del usuario
            ->get();

        // 4. Pasar los datos a la vista
        return inertia('Trainer/TrainerReservations', [
            'activities' => $activities,
            'reservations' => $reservations
        ]);
    }


    // Personalized Training
    public function personalizedTraining()
    {
        // Obtengo los planes personalizados del entrenador
        // $plans = PersonalizedTraining::where('user_id', auth()->id())->get();

        return inertia('Trainer/TrainerPPlans');
    }

    public function createPersonalizedTraining()
    {
        return inertia('Trainer/Options/PersonalizedTrainingCreate');
    }

    // Crear un plan personalizado PUBLICO
    public function storePlan(Request $request)
    {
        // dd($request->all());
        // Validar los datos $request->validate([]);

        // Crear el plan
        // $plan = PersonalizedTraining::create([
        //     // 'name' => $request['name'],
        //     'user_id' => auth()->id(),
        //     'description' => $request['description'],
        //     'price' => $request['price'],
        //     'status' => 'approved',
        // ]);

        // Retornar una respuesta exitosa
        return redirect()->route('trainers.pp');
    }


    // POSTS

    public function trainerPostsView()
    {
        return inertia('Trainer/TrainerPosts');
    }

    // MENSAJES
    public function trainerMessagesView()
    {
        // return inertia('Trainer/TrainerMessages');
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return Inertia::render('Trainer/MessageInbox', ['users' => $users]);
    }
}