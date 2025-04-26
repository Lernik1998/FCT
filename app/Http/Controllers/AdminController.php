<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use App\Models\User; // Modelo User
use App\Models\Activity; // Modelo Activity
use App\Models\Category; // Modelo Category
use App\Models\ContactMessage; // Modelo ContactMessage
use App\Models\Message; // Modelo Message

use Illuminate\Support\Str; // Modelo Str para renombrar la imagen
use Inertia\Inertia; // Facade para Inertia
use Illuminate\Support\Facades\Auth; // Facade para autenticación




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
        $users = User::query()
            ->where('role', 'user') // Filtra solo usuarios con rol 'user'
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->select(['id', 'name', 'email', 'role'])
            ->paginate(10)
            ->appends(['search' => request('search')]); // Mantiene el parámetro de búsqueda en la paginación

        return inertia('Admin/UserAdmin', [
            'users' => $users,
            'filters' => ['search' => request('search')] // Envía el filtro actual a la vista
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
        // $trainers = User::where('role', 'trainer')->get();

        // return inertia('Admin/TrainerAdmin', [
        //     'trainers' => $trainers
        // ]);

        $trainers = User::where('role', 'trainer')
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->select(['id', 'name', 'email', 'role', 'category', 'is_active'])
            ->paginate(10)
            ->appends(['search' => request('search')]);

        return inertia('Admin/TrainerAdmin', [
            'trainers' => $trainers,
            'filters' => ['search' => request('search')]
        ]);
    }

    // Mostrar ficha Trainer
    public function trainerShow(string $id)
    {
        //Obtengo el trainer con el id
        $trainer = User::findOrFail($id);

        //Retornar el trainer
        return inertia('Admin/TrainerOptions/TrainerShow', compact('trainer'));
    }

    // Editar Trainer
    public function editTrainerView(string $id)
    {
        //Obtengo el trainer con el id
        $trainer = User::findOrFail($id);

        // Obtengo las categorías
        $categories = Category::all();

        // return inertia('Admin/UserOptions/UserEdit', compact('user'));
        return inertia('Admin/TrainerOptions/TrainerEditForm', compact('trainer', 'categories'));
    }


    public function updateTrainer(Request $request, string $id)
    {
        // dd(Request::all());

        //Obtengo el trainer con el id
        $trainer = User::findOrFail($id);

        // Validar los datos del request
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email,' . $id,
        //     'role' => 'required|in:user,trainer,admin',
        //     'category' => 'nullable|string',
        //     'is_active' => 'required|boolean',
        // ]);

        // Categoría - ID
        $categoryCalendar = [
            'General' => env('GOOGLE_CALENDAR_ID'),
            'Resistencia y cardio' => env('GOOGLE_CALENDAR_RESISTENCIA_CARDIO_ID'),
            'Baile' => env('GOOGLE_CALENDAR_BAILE_ID'),
            'Flexibilidad y cuerpo-mente' => env('GOOGLE_CALENDAR_FLEXIBILIDAD_ID'),
            'Fuerza y acondicionamiento' => env('GOOGLE_CALENDAR_FUERZA_ID'),
            'Rehabilitación o movimiento suave' => env('GOOGLE_CALENDAR_REHAB_ID'),
        ];


        // Obtener los datos del formulario
        $data = $request->all();

        $categoryCalendar = config('services.google_calendars');

        if (isset($data['category']) && isset($categoryCalendar[$data['category']])) {
            $data['google_calendar_id'] = $categoryCalendar[$data['category']];
        }

        //Actualizo el trainer
        $trainer->update($data);

        //Retornar un mensaje de exito
        return inertia('Admin/TrainerOptions/TrainerShow', compact('trainer'));
    }

    // ACTIVITY

    public function activityAdmin()
    {
        // Obtenemos todas las activities
        // $activities = Activity::all();

        // return inertia('Admin/ActivityAdmin', [
        //     'activities' => $activities
        // ]);
        $activities = Activity::query()
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })

            //  ->with('category') // Si tienes relación con categorías
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->appends(['search' => request('search')]);

        return inertia('Admin/ActivityAdmin', [
            'activities' => $activities,
            'filters' => ['search' => request('search')]
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

        // Crear la actividad
        $activity = Activity::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,  // Guardamos la ruta, no el archivo
            'price' => $request->price,
            'duration' => $request->duration,
            'date' => $request->date,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);

        // Manejar la subida de imagen
        if ($request->hasFile('image')) {

            // Obtengo la imagen y la almaceno
            $image = $request->file('image');

            // Renombro la imagen
            $imageName = Str::slug($request->name) . '.' . $image->guessExtension(); // Para que lo guarde con el nombre original y extension

            // Guardo la imagen en la carpeta public/activities
            $path = public_path('images/activities/');
            $image->move($path, $imageName);

            // Actualizar la ruta de la imagen en la base de datos
            $activity->image = $imageName;
            $activity->save();
        }

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
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,  // Guardamos la ruta, no el archivo
            'price' => $request->price,
            'duration' => $request->duration,
            'date' => $request->date,
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

    // INFORMATION
    public function informationAdmin()
    {
        // Obtengo todos los mensajes pendientes
        // Se podría pasar todo y hacer un filtrado en la vista
        $messages = ContactMessage::where('status', 'pending')->get();

        // Obtengo todos los trainers disponibles
        $trainers = User::where('role', 'trainer')->get();

        return inertia('Admin/InformationAdmin', [
            'messages' => $messages,
            'trainers' => $trainers
        ]);
    }

    // Mensajes enviados sin registro
    public function unregisteredUserMessage(Request $request)
    {
        // Variable de mensaje 
        $message = '';
        try {
            // Inserto datos en la BD
            ContactMessage::create($request->all());
            $message = 'Mensaje enviado, le responderemos lo antes posible';
        } catch (\Throwable $th) {
            $message = 'Error en el envío del mensaje, intentelo de nuevo más tarde!';
        }

        // Devuelvo a la vista publica un mensaje de exito
        return inertia('Public/Contact', [
            'message' => $message
        ]);

        // return redirect()->route('admin.informationAdmin');
    }

    public function sendReplyUnregisteredUser(Request $request)
    {

        // dd($request->all());
        // Variable de mensaje 
        $message = '';
        try {
            // Inserto datos en la BD
            // ContactMessage::create($request->all());
            $contactMessage = ContactMessage::findOrFail($request->id);

            // Cambio el estado el status
            $contactMessage->status = 'completed';
            $contactMessage->save();

            $message = 'Mensaje enviado, le responderemos lo antes posible';

            $messages = ContactMessage::where('status', 'pending')->get();

        } catch (\Throwable $th) {
            $message = 'Error en el envío del mensaje, intentelo de nuevo más tarde!';
        }

        // Devuelvo a la vista publica un mensaje de exito
        return inertia('Admin/InformationAdmin', [
            'messageStatus' => $message,
            'messages' => $messages
        ]);
    }

    public function markAsAssigned(Request $request)
    {
        // dd($request->all());
        try {
            // Obtengo el mensaje
            $contactMessage = ContactMessage::findOrFail($request->id);

            // Cambio el estado el status
            $contactMessage->status = 'assigned';
            $contactMessage->save();

            /* PENDIENTE REVISAR QUE EL TRAINER EXISTA, PARA EVITAR PROBLEMAS*/

            $message = 'Mensaje asginado a un entrenador';

            $messages = ContactMessage::where('status', 'pending')->get();

        } catch (\Throwable $th) {
            $message = 'Error en el envío del mensaje, intentelo de nuevo más tarde!';
        }

        // Devuelvo a la vista publica un mensaje de exito
        return inertia('Admin/InformationAdmin', [
            'messageStatus' => $message,
            'messages' => $messages,
        ]);
    }

    // MENSAJES
    public function adminMessagesView()
    {
        // return inertia('Trainer/TrainerMessages');
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return Inertia::render('Admin/MessageAdmin', ['users' => $users]);
    }
}
