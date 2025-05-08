<?php

namespace App\Http\Controllers;

// use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\TemporalReservation;
use App\Models\UserActivitiesReservations;
use App\Models\Activity; // Modelo de actividad

use Stripe\Stripe; // Para Stripe
// use Stripe\Checkout\Session as StripeSession;  // Para Stripe
use Stripe\Charge;
// use Stripe\CardException;

// use PayPalHttp\PayPalHttpClient;
// use PayPalHttp\Environment;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\PayPalHttpClient;

use Telegram; // Para Telegram


class UserActivitiesReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtengo todas las reservas del usuario
        // $reservations = UserActivitiesReservations::where('user_id', auth()->user()->id)->get();

        $reservations = UserActivitiesReservations::with('activity')
            ->where('user_id', auth()->user()->id)
            ->get();

        // dd($reservations);

        return inertia('User/ActivityOptions/ActivityReservations', compact('reservations'));
    }

    // Función para reservar la actividad
    // public function create($id)
    // {
    //     // Obtengo la actividad con el id
    //     $act = Activity::findOrFail($id);

    //     // Verificar si ya existe una reserva para esta actividad y hora
    //     // $reservaExistente = UserActivitiesReservations::where('user_id', auth()->user()->id)
    //     //     ->where('activity_id', $act->id)
    //     //     ->where('activity_datetime', $act->date . ' ' . $act->start_time)
    //     //     ->exists();
    //     $reservaExistente = UserActivitiesReservations::where('user_id', auth()->user()->id)
    //         ->where('activity_datetime', operator: $act->date . ' ' . $act->start_time)
    //         ->exists();

    //     if ($reservaExistente) {
    //         return back()->with('message', 'Ya tienes una reserva para esta actividad a esa hora.');
    //     } else {

    //         // dd($act->slots);

    //         //  Verificar si hay slots disponibles
    //         if ($act->slots <= 0) {
    //             return back()->with('message', 'No hay cupos disponibles para esta actividad.');
    //         }
    //         // }else{
    //         //     $slots = $act->slots;

    //         //     $slotsActual = parse_int($slots);
    //         //     $slotsActual--;
    //         // }

    //         // Resta un cupo a la actividad
    //         $act->update([
    //             'slots' => $act->slots --
    //         ]);
    //     }

    //     // Creo la reserva
    //     UserActivitiesReservations::create([
    //         'user_id' => auth()->user()->id,
    //         'activity_id' => $act->id,
    //         // 'start_time' => $act->start_time,
    //         // 'end_time' => $act->end_time,
    //         'activity_datetime' => $act->date . ' ' . $act->start_time,
    //         'status' => 'reserved',
    //         'price' => $act->price,
    //         'payment_method' => null,
    //         'payment_id' => null,
    //         'payment_status' => null,
    //         'payment_url' => null,
    //         'payment_description' => null,
    //         'payment_date' => null,
    //     ]);

    //     // Vuelvo al index de user
    //     // return redirect()->route('users.index');
    //     return redirect()->route('users.index')->with('message', 'Reserva realizada con éxito.');

    // }


    /* 
    Crear una reserva verificando si el cliente tiene o no membresía activa
    */
    // Crear reserva
    public function create($id)
    {
        // Obtengo la actividad con el id
        $act = Activity::findOrFail($id);
        $user = auth()->user();


        // Verificar si ya existe una reserva para esta actividad y hora exacta
        $reservaExistente = UserActivitiesReservations::where('user_id', auth()->user()->id)
            ->where('activity_datetime', $act->date . ' ' . $act->start_time)
            ->exists();

        // Si ya existe una reserva, devuelvo un error
        if ($reservaExistente) {
            return back()->with('error', 'Ya tienes una reserva para esta actividad a esa hora.');
        }

        // Verificar si hay slots disponibles
        if ($act->slots <= 0) {
            return back()->with('error', 'No hay cupos disponibles para esta actividad.');
        }

        // // Usar una transacción para asegurar la consistencia de los datos
        // DB::transaction(function () use ($act) {
        //     // Resta un cupo a la actividad (forma correcta)
        //     $act->decrement('slots');

        //     // O también podrías usar:
        //     // $act->update(['slots' => $act->slots - 1]);

        //     // Crear la reserva
        //     UserActivitiesReservations::create([
        //         'user_id' => auth()->user()->id,
        //         'activity_id' => $act->id,
        //         'activity_datetime' => $act->date . ' ' . $act->start_time,
        //         'status' => 'reserved',
        //         'price' => $act->price,
        //         'payment_method' => null,
        //         'payment_id' => null,
        //         'payment_status' => null,
        //         'payment_url' => null,
        //         'payment_description' => null,
        //         'payment_date' => null,
        //     ]);
        // });

        // return redirect()->route('users.index')->with('success', 'Reserva realizada con éxito.');


        // Usuario con membresía activa
        if ($user->hasActiveMembership()) {
            // Inicio una transacción
            return DB::transaction(function () use ($act, $user) {
                $act->decrement('slots');

                UserActivitiesReservations::create([
                    'user_id' => $user->id,
                    'activity_id' => $act->id,
                    'activity_datetime' => $act->date . ' ' . $act->start_time,
                    'status' => 'reserved',
                    'price' => 0, // Gratis para miembros
                    'payment_method' => 'membership',
                    'payment_status' => 'paid',
                    // Pondria en Payment description el tipo de membresía que dispone el usuario
                    'payment_date' => now(),
                ]);

                return redirect()->route('users.index')
                    ->with('success', 'Reserva realizada con tu membresía.');
            });
        }

        // Usuario sin membresía - procesar pago
        return $this->processPayment($act);
    }

    /**
     * Almacena una nueva reserva TODO: pendiente implementar
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserActivitiesReservations $userActivitiesReservations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserActivitiesReservations $userActivitiesReservations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserActivitiesReservations $userActivitiesReservations)
    {
        //
    }

    /**
     * Elimina una reserva especifica
     */
    public function destroy($id)
    {
        // Obtengo la reserva
        $userActivitiesReservations = UserActivitiesReservations::findOrFail($id);

        // Elimino la reserva
        $userActivitiesReservations->delete();

        // Obtengo todas las reservas del usuario (Actualizo) FIXME:
        $reservations = UserActivitiesReservations::where('user_id', auth()->user()->id)->get();

        // Redirecciono
        return redirect()->route('userActivitiesReservations.index')->with('message', 'Reserva eliminada con éxito.');
    }


    // FIXME: Pendiente implementar la parte de URL succes or cancel
    // public function showPayForActivity($id)
    // {
    //     // Obtenemos el id de la reserva
    //     $reservation = UserActivitiesReservations::findOrFail($id);

    //     // Según la reserva obtengo la actividad
    //     $activity = Activity::findOrFail($reservation->activity_id);

    //     // Cargo la vista de pago
    //     return inertia('Payments/ActivityCardPayment', compact('activity', 'reservation'));
    // }


    protected function processPayment($activity)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        try {
            $checkout = $stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => [
                                'name' => $activity->name,
                                'description' => $activity->description,
                            ],
                            'unit_amount' => $activity->price * 100, // Precio €
                        ],
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment',
                //  Redirección al éxito o cancelación
                'success_url' => route('userActivitiesReservations.index'),
                'cancel_url' => route('users.index'),
                'metadata' => [
                    'activity_id' => $activity->id,
                    'user_id' => auth()->id()
                ],
                'customer_email' => auth()->user()->email,
            ]);

            // Guardar temporalmente la intención de reserva FIXME: Pendiente hacer una transacción y gestión de la sesión (Según el tipo de usuarios redireccionar a X pag)
            // TemporalReservation::create([
            //     'user_id' => auth()->id(),
            //     'activity_id' => $activity->id,
            //     'session_id' => $checkout->id,
            //     'expires_at' => now()->addMinutes(30)
            // ]);


            // Redirecciono al usuario a Stripe
            return redirect($checkout->url);

        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }


    public function paymentSuccess($activityId)
    {

        dd('Recibido ');

        $activity = Activity::findOrFail($activityId);
        $user = auth()->user();
        $sessionId = request()->get('session_id');

        if (!$sessionId) {
            return redirect()->route('activities.show', $activityId)
                ->with('error', 'Sesión de pago no válida.');
        }

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        try {
            $session = $stripe->checkout->sessions->retrieve($sessionId);

            if ($session->payment_status !== 'paid') {
                throw new \Exception('El pago no se completó correctamente.');
            }

            // Verificar si ya existe la reserva
            $existingReservation = UserActivitiesReservations::where('payment_id', $session->payment_intent)->first();

            if ($existingReservation) {
                return redirect()->route('users.index')
                    ->with('info', 'Esta reserva ya fue procesada anteriormente.');
            }

            // Procesar la reserva
            DB::transaction(function () use ($activity, $user, $session) {
                $activity->decrement('slots');

                UserActivitiesReservations::create([
                    'user_id' => $user->id,
                    'activity_id' => $activity->id,
                    'activity_datetime' => $activity->date . ' ' . $activity->start_time,
                    'status' => 'reserved',
                    'price' => $activity->price,
                    'payment_method' => 'stripe',
                    'payment_id' => $session->payment_intent,
                    'payment_status' => 'paid',
                    'payment_date' => now(),
                ]);

                // Eliminar reserva temporal
                TemporalReservation::where('session_id', $session->id)->delete();
            });

            return redirect()->route('users.index')
                ->with('success', 'Reserva y pago completados con éxito.');

        } catch (\Exception $e) {
            return redirect()->route('activities.show', $activityId)
                ->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }


    public function payForActivity(Request $request, $activityId)
    {
        // dd($request, $activityId);

        //     $request->validate([
        //         'card_number' => 'required|string|size:16',
        //         'exp_month' => 'required|integer|between:1,12',
        //         'exp_year' => 'required|integer|min:' . now()->year,
        //         'cvc' => 'required|string|size:3',
        //     ]);

        // Obtengo la actividad
        $activity = Activity::findOrFail($activityId);

        // Obtengo la reserva
        // $reservation = UserActivitiesReservations::where('user_id', auth()->user()->id)
        //     ->where('activity_id', $activityId)
        //     ->first();


        // Configurar clave Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));
        //  $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET')); Crear token de la tarjeta

        try {
            Charge::create([
                'amount' => $activity->price * 100, // Precio de la actividad
                'currency' => 'eur',
                'source' => $request->stripeToken,
                'description' => 'Pago de la actividad ' . $activity->name,
            ]);

            // Cambio el estado de la reserva
            // $reservation->update([
            //     'status' => 'confirmed',
            //     'payment_method' => 'stripe',
            //     'payment_id' => $response->id,
            //     'payment_status' => $response->status,
            //     'payment_url' => $response->payment_method,
            //     'payment_description' => $response->description,
            //     'payment_date' => now(),
            // ]);

            return inertia('Payments/SuccessPayment');

        } catch (\Exception $e) {
            // return Inertia::location(route('userActivitiesReservations.index'));
            return response()->json([
                'error' => 'Error al pagar la actividad: ' . $e->getMessage()
            ], 500);
        }
    }

    public function payForActivityWithPaypal(Request $request, $activityId)
    {
        // dd($request, $activityId);

        // Asegúrate de que el token está llegando correctamente
        $paypalToken = $request->input('paypalToken');

        if (empty($paypalToken)) {
            return response()->json([
                'error' => 'Token de PayPal no recibido.'
            ], 400);
        }


        // Obtengo la actividad
        $activity = Activity::findOrFail($activityId);

        // Obtengo la reserva
        $reservation = UserActivitiesReservations::where('user_id', auth()->user()->id)
            ->where('activity_id', $activityId)
            ->first();


        // Obtenemos el token de PayPal
        $paypalToken = $request->input('paypalToken');

        // Configuración de PayPal
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');
        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);

        // Crear la solicitud para verificar la transacción
        $request = new OrdersGetRequest($paypalToken);


        try {
            // Hacer la solicitud a PayPal
            $response = $client->execute($request);


            // dd($response);
            // Registrar la respuesta completa para análisis
            // \Log::info('Respuesta de PayPal:', (array) $response);

            // Verificar que el estado de la transacción es 'COMPLETED'
            if ($response->result->status === 'COMPLETED') {
                // Transacción exitosa, actualizar la reserva
                // $reservation->update([
                //     'status' => 'confirmed',
                //     'payment_method' => 'paypal',
                //     'payment_id' => $paypalToken,
                //     'payment_status' => 'completed',
                //     'payment_url' => $response->result->links[1]->href, // URL de la transacción
                //     'payment_description' => 'Pago de la actividad ' . $activity->name,
                //     'payment_date' => now(),
                // ]);

                // Redirigir a la página de éxito
                return inertia('Payments/SuccessPayment');
            } else {
                // Si la transacción no es exitosa
                // return response()->json([
                //     'error' => 'La transacción de PayPal ha fallado.',
                // ], 400);
                return inertia('Payments/FailedPayment', ['message' => 'La transacción de PayPal ha fallado.']);
            }

        } catch (\Exception $e) {
            // return response()->json([
            //     'error' => 'Error al pagar la actividad: ' . $e->getMessage()
            // ], 500);
            return inertia('Payments/FailedPayment', ['message' => $e->getMessage()]);

        }
    }

    public function telegram()
    {
        // $telegram = new Api(config('telegram.bots.default.token'));
        // $update = $telegram->getWebhookUpdate();

        // $chatId = $update->getMessage()?->getChat()?->getId();
        // $text = $update->getMessage()?->getText();

        // if ($text === '/start') {
        //     $telegram->sendMessage([
        //         'chat_id' => $chatId,
        //         'text' => '¡Hola! Estás conectado con FitWorkingBot 💪'
        //     ]);
        // }

        $updates = Telegram::getUpdates();

        dd($updates);
    }


}
