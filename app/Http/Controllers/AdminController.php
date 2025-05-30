<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Modelo User
use App\Models\Activity; // Modelo Activity
use App\Models\Category; // Modelo Category
use App\Models\ContactMessage; // Modelo ContactMessage
use App\Models\Transaction; // Modelo Transaction
use Illuminate\Support\Str; // Modelo Str para renombrar la imagen
use Inertia\Inertia; // Facade para Inertia
use Illuminate\Support\Facades\Auth; // Facade para autenticación
use App\Jobs\SendContactEmail;
use App\Models\Plan;
use Stripe\Price;
use Stripe\Stripe;
use Stripe\Product;

class AdminController extends Controller
{
    // Index del admin
    public function index()
    {
        return inertia('Admin/IndexAdmin');
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
        // Creo el user
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
        ]);


        // Obtengo todos los users y los devuelvo a la vista
        $users = User::where('role', 'user')->get();

        //Retornar un mensaje de exito
        return redirect()->route('admin.userAdmin');
    }

    // Muestra el usuario.
    public function showUser(string $id)
    {
        //Obtengo el user con el id
        $user = User::findOrFail($id);

        //Retornar el user
        return inertia('Admin/UserOptions/UserShow', compact('user'));
    }

    // Muestra la vista de la edicion de un usuario (Formulario)
    public function editUserView(string $id)
    {
        //Obtengo el user con el id
        $user = User::findOrFail($id);

        // return inertia('Admin/UserOptions/UserEdit', compact('user'));
        return inertia('Admin/UserOptions/UserEditForm', compact('user'));
    }

    // Actualiza el usuario.
    public function updateUser(Request $request, string $id)
    {
        //Obtengo el user con el id
        $user = User::findOrFail($id);

        //Actualizo el user
        $user->update($request->all());

        //Retornar un mensaje de exito
        // return redirect()->route('admin.editUser', $user->id)->with('success', 'Usuario actualizado correctamente');

        return inertia('Admin/UserOptions/UserShow', compact('user'));
    }

    // Elimina el usuario.
    public function destroyUser(string $id)
    {
        //Obtengo el user con el id
        $user = User::findOrFail($id);

        // Si el usuario es user redirección a admin.userAdmin
        if ($user->role == 'user') {
            //Elimino el user
            $user->delete();
            return redirect()->route('admin.userAdmin')->with('success', 'Usuario eliminado correctamente');
        } else {
            //Elimino el trainer
            $user->delete();
            return redirect()->route('admin.trainerAdmin')->with('success', 'Entrenador eliminado correctamente');
        }
    }

    // TRAINER

    public function trainerAdmin()
    {
        // Obtenemos todos los users con rol trainer
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
        $categories = Category::where('name', '!=', 'General')->get();

        // return inertia('Admin/UserOptions/UserEdit', compact('user'));
        return inertia('Admin/TrainerOptions/TrainerEditForm', compact('trainer', 'categories'));
    }

    // Actualiza el trainer.
    public function updateTrainer(Request $request, string $id)
    {
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

        $trainer->description = $request->description;
        $trainer->experience_time = $request->experience_time;


        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = Str::slug($request->name) . '.' . $img->guessExtension();

            $path = public_path('images/trainers/');
            $img->move($path, $imgName);

            $trainer->image = $imgName;
        }

        //Actualizo el trainer
        $trainer->update($data);

        //Retornar un mensaje de exito
        return inertia('Admin/TrainerOptions/TrainerShow', compact('trainer'));
    }

    // Muestra la vista de la creacion de un trainer (Formulario)
    public function createTrainerView()
    {
        // Obtengo las categorías
        $categories = Category::where('name', '!=', 'General')->get();

        return inertia('Admin/TrainerOptions/TrainerCreate', compact('categories'));
    }

    // Crea el trainer.
    public function createTrainer(Request $request)
    {
        // Crear el trainer
        $trainer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'category' => $request->category,
            'description' => $request->description,
            'role' => 'trainer',
            'experience_time' => $request->experience_time,
            'image' => $request->image,
        ]);


        // Manejar la subida de imagen
        if ($request->hasFile('image')) {

            // Obtengo la imagen y la almaceno
            $image = $request->file('image');

            // Renombro la imagen
            $imageName = Str::slug($request->name) . '.' . $image->guessExtension(); // Para que lo guarde con el nombre original y extension

            // Guardo la imagen en la carpeta public/activities
            $path = public_path('images/trainers/');
            $image->move($path, $imageName);

            // Actualizar la ruta de la imagen en la base de datos
            $trainer->image = $imageName;
            $trainer->save();
        }

        // Retornar un mensaje de exito
        return redirect()->route('admin.trainerAdmin');
    }

    // ACTIVITY

    // Muestra la vista de la creacion de una actividad (Formulario)
    public function activityAdmin()
    {
        $activities = Activity::query()
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })

            //  ->with('category') // Si tienes relación con categorías
            ->orderBy('date', 'asc')
            ->paginate(10)
            ->appends(['search' => request('search')]);

        return inertia('Admin/ActivityAdmin', [
            'activities' => $activities,
            'filters' => ['search' => request('search')]
        ]);
    }

    // Muestra la vista de la creacion de una actividad (Formulario)
    public function createActivityView()
    {
        //Obtengo todas las categorías
        $categories = Category::all();

        return inertia('Admin/ActivityOptions/ActivityCreate', [
            'categories' => $categories
        ]);
    }

    // Crea la actividad.
    public function storeActivity(Request $request)
    {
        // Crear la actividad
        $activity = Activity::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,  // Guardamos la ruta, no el archivo
            'price' => $request->price,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'date' => $request->date,
            'slots' => $request->slots,
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
    }

    // Muestra la vista de la edicion de una actividad (Formulario)
    public function editActivityView(string $id)
    {
        //Obtengo la actividad con el id
        $activity = Activity::findOrFail($id);

        $categories = Category::where('name', '!=', 'General')->get();

        return inertia('Admin/ActivityOptions/ActivityEditForm', compact('activity', 'categories'));
    }

    // Muestra la vista de la edicion de una actividad (Formulario)
    public function showActivity(string $id)
    {
        //Obtengo la actividad con el id
        $activity = Activity::findOrFail($id);

        return inertia('Admin/ActivityOptions/ActivityShow', [
            'activity' => $activity
        ]);
    }

    // Actualiza la actividad.
    public function updateActivity(Request $request, string $id)
    {
        //Obtengo la actividad con el id
        $activity = Activity::findOrFail($id);

        // Actualizar la actividad
        $activity->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,  // Guardamos la ruta
            'capacity' => $request->capacity,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'date' => $request->date,
            'user_id' => auth()->id(),
        ]);

        $activity->name = $request->name;
        $activity->description = $request->description;
        $activity->capacity = $request->capacity;
        $activity->price = $request->price;
        $activity->start_time = $request->start_time;
        $activity->end_time = $request->end_time;
        $activity->date = $request->date;
        $activity->user_id = auth()->id();
        $activity->category_id = $request->category_id;

        // Manejar la subida de imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($activity->image) {
                $oldPath = public_path('images/activities/' . $activity->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Guardar nueva imagen
            $img = $request->file('image');
            $imgName = Str::slug($request->name) . '.' . $img->guessExtension();

            $path = public_path('images/activities/');
            $img->move($path, $imgName);

            $activity->image = $imgName;
        }

        $activity->save();

        // Retornar un mensaje de exito
        return redirect()->route('admin.activityAdmin');
    }

    // Elimina la actividad.
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
        // Mensajes de contacto generales (no son de entrenadores)
        $messages = ContactMessage::where('status', 'pending')
            ->whereNull('trainer_id') // Solo mensajes no asociados a entrenadores
            ->get();

        // Entrenadores disponibles
        $trainers = User::where('role', 'trainer')->get();

        // Solicitudes de categoría (asociadas a entrenadores)
        $categories = ContactMessage::with('trainer')
            ->where('target', 'trainer')
            ->where('status', 'pending')
            ->get();

        // Solicitudes de activación (asociadas a entrenadores)
        $activations = ContactMessage::with('trainer')
            ->where('target', 'activation')
            ->where('status', 'pending')
            ->get();

        return inertia('Admin/InformationAdmin', [
            'messages' => $messages,
            'trainers' => $trainers,
            'categories' => $categories,
            'activations' => $activations
        ]);
    }

    // Para activar un entrenador
    public function activateTrainer(string $id)
    {
        $trainer = User::findOrFail($id);
        $trainer->is_active = true;
        $trainer->save();

        return back()->with('message', 'Entrenador activado correctamente');
    }

    // Mensajes enviados sin registro
    public function unregisteredUserMessage(Request $request)
    {
        // Variable de mensaje 
        $message = true;
        try {
            // Inserto datos en la BD
            ContactMessage::create($request->all());
            $message = true;

            SendContactEmail::dispatch($request->email, $request->name);

        } catch (\Throwable $th) {
            $message = false;
        }

        // Devuelvo a la vista publica un mensaje de exito
        return inertia('Public/Contact', [
            'message' => $message
        ]);
    }

    // Envio correo
    public function sendReplyUnregisteredUser(Request $request)
    {
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

        // Devuelvo a la vista admin
        return inertia('Admin/InformationAdmin', [
            'messageStatus' => $message,
            'messages' => $messages
        ]);
    }

    // Asignar un entrenador
    public function markAsAssigned(Request $request)
    {
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

    // Asignar una categoría
    public function asignCategory(Request $request, string $id)
    {
        try {
            $trainer = User::findOrFail($id);

            // Verifico si ya se ha solicitado una categoría (solo con target 'trainer')
            $contactMessage = ContactMessage::where('trainer_id', $id)
                ->where('target', 'trainer')
                ->first();

            if ($contactMessage) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ya se ha solicitado una categoría para este entrenador.'
                ]);
            }

            // Creo el mensaje
            ContactMessage::create([
                'name' => $trainer->name,
                'email' => $trainer->email,
                'message' => 'Solicitud de categoría del entrenador',
                'trainer_id' => $id,
                'status' => 'pending',
                'target' => 'trainer', // Asegurar que es para categoría
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Solicitud enviada correctamente'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error en el envío del mensaje, intentelo de nuevo más tarde!'
            ], 500);
        }
    }

    // Solicitud de activación
    public function requestActivation(Request $request, string $id)
    {
        try {
            $trainer = User::findOrFail($id);

            // Verifico si ya se ha solicitado activación
            $existingRequest = ContactMessage::where('trainer_id', $id)
                ->where('target', 'activation')
                ->first();

            if ($existingRequest) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ya existe una solicitud de activación pendiente.'
                ]);
            }

            // Creo el mensaje de solicitud de activación
            ContactMessage::create([
                'name' => $trainer->name,
                'email' => $trainer->email,
                'message' => 'Solicitud de activación de cuenta de entrenador',
                'trainer_id' => $id,
                'status' => 'pending',
                'target' => 'activation',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Solicitud de activación enviada correctamente'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error en el envío de la solicitud, inténtelo de nuevo más tarde!'
            ], 500);
        }
    }

    // Marcar como realizado
    public function markAsDone(string $id)
    {
        try {
            // Obtengo el trainer
            $trainer = User::findOrFail($id);

            // Obtengo el mensaje
            $contactMessage = ContactMessage::where('trainer_id', $id)->where('status', 'pending')->first();

            // Cambio el estado el status
            $contactMessage->status = 'completed';
            $contactMessage->save();

            $message = 'Gestión realizada correctamente';


        } catch (\Throwable $th) {
            $message = 'Error en el envío del mensaje, intentelo de nuevo más tarde!';
        }

        // Vista
        return redirect()->route('admin.informationAdmin');
    }

    // MENSAJES
    public function adminMessagesView()
    {
        // return inertia('Trainer/TrainerMessages');
        $users = User::where('id', '!=', Auth::user()->id)
            ->where('role', '!=', 'user')
            ->get();
        return Inertia::render('Admin/MessageAdmin', ['users' => $users]);
    }


    // SUSCRIPTIONS
    public function subscriptionAdmin()
    {
        // $subscriptions = Subscription::all();
        // $plans = Plan::all();

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $plans = Plan::all()->map(function ($plan) {
            try {
                $stripePrice = Price::retrieve($plan->stripe_price_id);
                $plan->price = number_format($stripePrice->unit_amount / 100, 2); // en euros
                $plan->duration = $stripePrice->recurring->interval;
            } catch (\Exception $e) {
                $plan->price = 'N/D';
                $plan->duration = 'N/D';
            }

            return $plan;
        });

        return Inertia::render('Admin/PaymentOptions/PaymentsShow', ['plans' => $plans]); //['subscriptions' => $subscriptions]
    }

    public function createMembershipView()
    {
        return Inertia::render('Admin/PaymentOptions/PaymentCreate');
    }

    // Crear membresía
    public function storeMembership(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $amount = $request->price * 100;

        // Mapear duración a intervalo Stripe
        $durationMap = [
            '1' => 'month',
            '3' => 'month',
            '6' => 'month',
            '12' => 'month',
        ];

        $interval = $durationMap[$request->duration] ?? 'month';

        try {
            // Crear producto
            $product = Product::create([
                'name' => $request->name,
            ]);

            // Crear precio
            $price = Price::create([
                'unit_amount' => $amount,
                'currency' => 'eur',
                'recurring' => ['interval' => $interval],
                'product' => $product->id,
            ]);

            // Guardar en BD
            $plan = Plan::create([
                'name' => $request->name,
                'stripe_plan_id' => $product->id,
                'stripe_price_id' => $price->id,
            ]);

            return redirect()->route('admin.subscriptionAdmin')->with('success', 'Plan creado correctamente.');

        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'Error al crear el plan: ' . $th->getMessage()]);
        }
    }

    // Eliminar membresía (Realmente se desactiva)
    public function destroyMembership(string $id)
    {
        /* No se puede eliminar directamente un Price ni un Product si ha sido usado alguna vez.
         Por lo tanto, lo que se hace es desactivarlos */
        $plan = Plan::findOrFail($id);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Desactivar el precio en Stripe
            Price::update($plan->stripe_price_id, [
                'active' => false,
            ]);

            // Archivar el producto en Stripe
            Product::update($plan->stripe_plan_id, [
                'active' => false,
            ]);

        } catch (\Exception $e) {
            \Log::error('Error al desactivar en Stripe: ' . $e->getMessage());
        }

        $plan->delete();

        return redirect()->route('admin.subscriptionAdmin')->with('success', 'Membresía eliminada correctamente.');
    }


    // Obtener todas las membresias reservadas y gestionarlas
    public function getMemberships()
    {
        // Carga todos los usuarios con su suscripción (de la tabla subscriptions)
        $memberships = User::where('stripe_id', '!=', null)->get();

        $memberships->map(function ($user) {
            $user->membership = $user->subscriptions()->first();
        });

        return Inertia::render('Admin/PaymentOptions/MembershipReservations', [
            'memberships' => $memberships,
        ]);
    }

    // Ver opciones de pago
    public function paymentOptions($stripe_id)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        $subscription = $stripe->subscriptions->retrieve($stripe_id, []);

        return Inertia::render('Admin/PaymentOptions/PaymentOptions', [
            'stripe_id' => $stripe_id,
            'subscription' => $subscription, // Añadir esto si quieres acceder a los datos en la vista
        ]);
    }

    // Cancelar suscripción
    public function cancelSubscription($stripe_id)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        $subscription = $stripe->subscriptions->cancel($stripe_id, []);

        return redirect()->route('admin.membershipReservations')->with('success', 'Suscripción cancelada correctamente.');
    }

    // ADMINISTRACIÓN

    // Mostrar todas las transacciones
    public function administrationAdmin()
    {
        // Obtengo todas las transacciones
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();

        return Inertia::render('Admin/Administration/AdministrationAdm', [
            'transactions' => $transactions,
        ]);
    }

    // Guardar una transacción
    public function storeTransaction(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'category' => 'required|string|max:100'
        ]);

        try {
            $transaction = Auth::user()->transactions()->create($validated);

            return redirect()->route('admin.transactions')
                ->with('success', 'Transacción guardada correctamente');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al guardar la transacción: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Exportar a CSV
    public function exportToCsv()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="transactions_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($transactions) {
            $file = fopen('php://output', 'w');

            // Encabezados CSV
            fputcsv($file, ['Tipo', 'Monto', 'Descripción', 'Fecha', 'Categoría']);

            // Datos
            foreach ($transactions as $transaction) {
                fputcsv($file, [
                    $transaction->type == 'income' ? 'Ingreso' : 'Gasto',
                    $transaction->amount,
                    $transaction->description,
                    $transaction->date->format('d/m/Y'),
                    $transaction->category
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}