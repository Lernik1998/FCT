<?php

namespace App\Http\Controllers;

// use Inertia\Inertia;
use App\Models\UserActivitiesReservations;
use Illuminate\Http\Request;
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
use Illuminate\Support\Facades\DB;


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

    public function create($id)
{
    // Obtengo la actividad con el id
    $act = Activity::findOrFail($id);

    // Verificar si ya existe una reserva para esta actividad y hora
    $reservaExistente = UserActivitiesReservations::where('user_id', auth()->user()->id)
        ->where('activity_datetime', $act->date . ' ' . $act->start_time)
        ->exists();

    if ($reservaExistente) {
        return back()->with('error', 'Ya tienes una reserva para esta actividad a esa hora.');
    }

    // Verificar si hay slots disponibles
    if ($act->slots <= 0) {
        return back()->with('error', 'No hay cupos disponibles para esta actividad.');
    }

    // Usar una transacción para asegurar la consistencia de los datos
    DB::transaction(function () use ($act) {
        // Resta un cupo a la actividad (forma correcta)
        $act->decrement('slots');
        
        // O también podrías usar:
        // $act->update(['slots' => $act->slots - 1]);

        // Crear la reserva
        UserActivitiesReservations::create([
            'user_id' => auth()->user()->id,
            'activity_id' => $act->id,
            'activity_datetime' => $act->date . ' ' . $act->start_time,
            'status' => 'reserved',
            'price' => $act->price,
            'payment_method' => null,
            'payment_id' => null,
            'payment_status' => null,
            'payment_url' => null,
            'payment_description' => null,
            'payment_date' => null,
        ]);
    });

    return redirect()->route('users.index')->with('success', 'Reserva realizada con éxito.');
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        // Obtengo la reserva
        $userActivitiesReservations = UserActivitiesReservations::findOrFail($id);

        // Elimino la reserva
        $userActivitiesReservations->delete();

        // Obtengo todas las reservas del usuario (Actualizo)
        $reservations = UserActivitiesReservations::where('user_id', auth()->user()->id)->get();

        // Redirecciono
        return redirect()->route('userActivitiesReservations.index')->with('message', 'Reserva eliminada con éxito.');
    }

    public function showPayForActivity($id)
    {

        // Obtenemos el id de la reserva
        $reservation = UserActivitiesReservations::findOrFail($id);

        // Según la reserva obtengo la actividad
        $activity = Activity::findOrFail($reservation->activity_id);

        // Cargo la vista de pago
        return inertia('Payments/ActivityCardPayment', compact('activity', 'reservation'));
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
