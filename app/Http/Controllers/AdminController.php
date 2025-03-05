<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; // Modelo User
use App\Models\Activity; // Modelo Activity
use App\Models\Category; // Modelo Category


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/IndexAdmin');
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

    // USER
    public function userAdmin()
    {
        // Obtenemos todos los users con rol user
        $users = User::where('role', 'user')->get();

        return inertia('Admin/UserAdmin', [
            'users' => $users,
        ]);
    }

    // Muestra la vista de la creacion de un usuario (Formulario)
    public function createUserView()
    {
        return inertia('Admin/UserOptions/UserCreate');
    }

    public function createUser(Request $request)
    {
        // dd($request->all());
        // Creo el user
        User::create($request->all());

        // Obtengo todos los users y los devuelvo a la vista
        $users = User::where('role', 'user')->get();

        //Retornar un mensaje de exito
        return inertia('Admin/UserAdmin', [
            'users' => $users
        ]);
    }

    // Show the specified resource.
    public function showUser(string $id)
    {
        //Obtengo el user con el id
        $user = User::findOrFail($id);

        //Retornar el user
        return inertia('Admin/UserOptions/UserShow', compact('user'));
    }

    public function editUserView(string $id)
    {
        //Obtengo el user con el id
        $user = User::findOrFail($id);

        // return inertia('Admin/UserOptions/UserEdit', compact('user'));
        return inertia('Admin/UserOptions/UserEditForm', compact('user'));
    }

    public function updateUser(Request $request, string $id)
    {
        // dd($request->all());
        //Obtengo el user con el id
        $user = User::findOrFail($id);

        //Actualizo el user
        $user->update($request->all());

        //Retornar un mensaje de exito
        // return redirect()->route('admin.editUser', $user->id)->with('success', 'Usuario actualizado correctamente');

        return inertia('Admin/UserOptions/UserShow', compact('user'));
    }

    public function destroyUser(string $id)
    {
        //Obtengo el user con el id
        $user = User::findOrFail($id);

        //Elimino el user
        $user->delete();

        //Retornar un mensaje de exito
        return redirect()->route('admin.userAdmin')->with('success', 'Usuario eliminado correctamente');
    }

    // TRAINER

    public function trainerAdmin()
    {

        // Obtenemos todos los users con rol trainer
        $trainers = User::where('role', 'trainer')->get();

        return inertia('Admin/TrainerAdmin', [
            'trainers' => $trainers
        ]);
    }

    // ACTIVITY

    public function activityAdmin()
    {
        // Obtenemos todas las activities
        $activities = Activity::all();

        return inertia('Admin/ActivityAdmin', [
            'activities' => $activities
        ]);
    }

    public function createActivityView()
    {
        //Obtengo todas las categorías
        $categories = Category::all();

        return inertia('Admin/ActivityOptions/ActivityCreate', [
            'categories' => $categories
        ]);
    }

    public function storeActivity(Request $request)
    {
        // dd($request->all());

        /*  MÁS ADELANTE HABRÁ QUE GESTIONAR EL ALMACENADO DE IMAGENES
         Manejar la subida de imagen
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('activities', 'public');
            } else {
                $imagePath = null;
            }
        */

        // Crear la actividad
        $activity = Activity::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $request['image'],  // Guardamos la ruta, no el archivo
            'price' => $request['price'],
            'duration' => $request['duration'],
            'date' => $request['date'],
            'category_id' => $request['category_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.activityAdmin');

        //Retornar un mensaje de exito
        // return redirect()->route('admin.activityAdmin')->with('success', 'Actividad creada correctamente');
    }

    public function editActivityView(string $id)
    {
        //Obtengo la actividad con el id
        $activity = Activity::findOrFail($id);

        return inertia('Admin/ActivityOptions/ActivityEditForm', compact('activity'));
    }

    public function showActivity(string $id)
    {
        //Obtengo la actividad con el id
        $activity = Activity::findOrFail($id);

        return inertia('Admin/ActivityOptions/ActivityShow', [
            'activity' => $activity
        ]);
    }

    public function updateActivity(Request $request, string $id)
    {
        //Obtengo la actividad con el id
        $activity = Activity::findOrFail($id);

        // Actualizar la actividad
        $activity->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $request['image'],  // Guardamos la ruta, no el archivo
            'price' => $request['price'],
            'duration' => $request['duration'],
            'date' => $request['date'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.activityAdmin');
    }

    public function destroyActivity(string $id)
    {
        //Obtengo la actividad con el id
        $activity = Activity::findOrFail($id);

        $activity->delete();

        return redirect()->route('admin.activityAdmin');
    }
}
