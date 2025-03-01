<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; // Modelo User

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
        // dd($id);
        // dd($id);
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
}
