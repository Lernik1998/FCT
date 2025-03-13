<?php

namespace App\Http\Controllers;

use App\Models\UserActivitiesReservations;
use Illuminate\Http\Request;
use App\Models\Activity; // Modelo de actividad

use Stripe\Stripe; // Para Stripe
use Stripe\Checkout\Session as StripeSession;  // Para Stripe

class UserActivitiesReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtengo todas las reservas del usuario
        $reservations = UserActivitiesReservations::where('user_id', auth()->user()->id)->get();

        // dd($reservations);

        return inertia('User/ActivityOptions/ActivityReservations', compact('reservations'));
    }

    // Función para reservar la actividad
    public function create($id)
    {
        // Obtengo la actividad con el id
        $act = Activity::findOrFail($id);

        // dd($act);

        // Creo la reserva
        UserActivitiesReservations::create([
            'user_id' => auth()->user()->id,
            'activity_id' => $act->id,
            'status' => 'reserved',
            'price' => $act->price,
            'payment_method' => null,
            'payment_id' => null,
            'payment_status' => null,
            'payment_url' => null,
            'payment_description' => null,
            'payment_date' => null,
        ]);

        // Vuelvo al index de user
        return redirect()->route('users.index');
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
        return inertia('User/ActivityOptions/ActivityReservations', compact('reservations'));
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

    // public function payForActivity(Request $request, $activityId)
    // {
    //     dd($request, $activityId);

    //     // Obtengo la actividad
    //     $activity = Activity::findOrFail($activityId);

    //     // Obtengo la reserva
    //     $reservation = UserActivitiesReservations::where('user_id', auth()->user()->id)
    //         ->where('activity_id', $activityId)
    //         ->first();

    //     //Cargo la vista de pago
    //     // Lógica para procesar el pago
    //     // Validar la solicitud, procesar el pago, actualizar la reserva, etc.
    // }

    // public function payForActivity(Request $request, $activityId)
    // {
    //     // Obtengo la actividad
    //     $activity = Activity::findOrFail($activityId);

    //     // Obtengo la reserva del usuario autenticado
    //     // $reservation = UserActivitiesReservations::where('user_id', auth()->user()->id)
    //     //     ->where('activity_id', $activityId)
    //     //     ->firstOrFail();

    //     // // Cambio el estado de la reserva
    //     // $reservation->update([
    //     //     'status' => 'paid',
    //     //     'payment_id' => $response->id,
    //     //     'payment_status' => $response->status,
    //     //     'payment_url' => $response->payment_method,
    //     //     'payment_description' => $response->description,
    //     //     'payment_date' => now(),
    //     // ]);

    //     \Log::info('Request data: ', $request->all());  // Para registrar los datos de la solicitud

    //     $request->validate([
    //         'card_number' => 'required|string|size:16',
    //         'exp_month' => 'required|integer|between:1,12',
    //         'exp_year' => 'required|integer|min:' . now()->year,
    //         'cvc' => 'required|string|size:3',
    //     ]);



    //     try {
    //         // Configurar Stripe
    //         Stripe::setApiKey(env('STRIPE_SECRET'));

    //         // // Crear sesión de pago con Stripe
    //         // $session = StripeSession::create([
    //         //     'payment_method_types' => ['card'],
    //         //     'line_items' => [
    //         //         [
    //         //             'price_data' => [
    //         //                 'currency' => 'eur',
    //         //                 'product_data' => [
    //         //                     'name' => $activity->name,
    //         //                 ],
    //         //                 'unit_amount' => $activity->price * 100, // Convertir a centavos
    //         //             ],
    //         //             'quantity' => 1,
    //         //         ]
    //         //     ],
    //         //     'mode' => 'payment',
    //         //     'success_url' => route('payment.success', ['reservation' => $reservation->id]),
    //         //     'cancel_url' => route('payment.cancel', ['reservation' => $reservation->id]),
    //         // ]);


    //         // Crear token de la tarjeta
    //         $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //         $res = $stripe->tokens->create([
    //             'card' => [
    //                 'number' => $request->card_number,
    //                 'exp_month' => $request->exp_month,
    //                 'exp_year' => $request->exp_year,
    //                 'cvc' => $request->cvc,
    //             ],
    //         ]);

    //         if (isset($res->error)) {
    //             return response()->json([
    //                 'error' => 'Error al crear el token de la tarjeta: ' . $res->error->message
    //             ], 400);
    //         }

    //         $response = $stripe->charges->create([
    //             'amount' => $activity->price * 100,
    //             'currency' => 'eur',
    //             'source' => $res->id,
    //             'description' => 'Pago de la actividad ' . $activity->name,
    //         ]);

    //         return response()->json([
    //             'status' => $response->status,
    //             'charge_id' => $response->id,
    //             'amount' => $response->amount,
    //             'currency' => $response->currency
    //         ], 200);


    //     } catch (\Stripe\Exception\CardException $e) {
    //         \Log::error('Stripe CardException: ', ['error' => $e->getError()]);
    //         return response()->json([
    //             'error' => 'Error de tarjeta: ' . $e->getError()->message
    //         ], 400);
    //     } catch (\Stripe\Exception\ApiConnectionException $e) {
    //         \Log::error('Stripe ApiConnectionException: ', ['error' => $e->getMessage()]);
    //         return response()->json([
    //             'error' => 'Error de conexión con Stripe: ' . $e->getMessage()
    //         ], 500);
    //     } catch (\Exception $e) {
    //         \Log::error('Unexpected Error: ', ['error' => $e->getMessage()]);
    //         return response()->json([
    //             'error' => 'Error inesperado: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function payForActivity(Request $request, $activityId)
    {
        // Obtengo la actividad
        $activity = Activity::findOrFail($activityId);

        // Validación de datos de la tarjeta
        $request->validate([
            'card_number' => 'required|string|size:16',
            'exp_month' => 'required|integer|between:1,12',
            'exp_year' => 'required|integer|min:' . now()->year,
            'cvc' => 'required|string|size:3',
        ]);

        \Log::info('Request data: ', $request->all());  // Para registrar los datos de la solicitud

        try {
            // Configurar Stripe
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Crear token de la tarjeta
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $res = $stripe->tokens->create([
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);

            if (isset($res->error)) {
                return response()->json([
                    'error' => 'Error al crear el token de la tarjeta: ' . $res->error->message
                ], 400);
            }

            $response = $stripe->charges->create([
                'amount' => $activity->price * 100,
                'currency' => 'eur',
                'source' => $res->id,
                'description' => 'Pago de la actividad ' . $activity->name,
            ]);

            return response()->json([
                'status' => $response->status,
                'charge_id' => $response->id,
                'amount' => $response->amount,
                'currency' => $response->currency
            ], 200);

        } catch (\Stripe\Exception\CardException $e) {
            \Log::error('Stripe CardException: ', ['error' => $e->getError()]);
            return response()->json([
                'error' => 'Error de tarjeta: ' . $e->getError()->message
            ], 400);
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            \Log::error('Stripe ApiConnectionException: ', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Error de conexión con Stripe: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            \Log::error('Unexpected Error: ', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Error inesperado: ' . $e->getMessage()
            ], 500);
        }
    }

}
