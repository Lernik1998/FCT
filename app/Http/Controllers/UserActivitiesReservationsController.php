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

    public function payForActivity(Request $request, $activityId)
    {
        // Obtengo la actividad
        $activity = Activity::findOrFail($activityId);

        // Obtengo la reserva del usuario autenticado
        $reservation = UserActivitiesReservations::where('user_id', auth()->user()->id)
            ->where('activity_id', $activityId)
            ->firstOrFail();

        // Configurar Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // // Crear sesión de pago con Stripe
        // $session = StripeSession::create([
        //     'payment_method_types' => ['card'],
        //     'line_items' => [
        //         [
        //             'price_data' => [
        //                 'currency' => 'eur',
        //                 'product_data' => [
        //                     'name' => $activity->name,
        //                 ],
        //                 'unit_amount' => $activity->price * 100, // Convertir a centavos
        //             ],
        //             'quantity' => 1,
        //         ]
        //     ],
        //     'mode' => 'payment',
        //     'success_url' => route('payment.success', ['reservation' => $reservation->id]),
        //     'cancel_url' => route('payment.cancel', ['reservation' => $reservation->id]),
        // ]);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $res = $stripe->tokens->create([
            'card' => [
                'number' => $request->card_number,
                'exp_month' => $request->exp_month,
                'exp_year' => $request->exp_year,
                'cvc' => $request->cvc,
            ],
        ]);



        $response = $stripe->charges->create([
            'amount' => $activity->price * 100,
            'currency' => 'eur',
            'source' => $res->id,
            'description' => 'Pago de la actividad ' . $activity->name,
        ]);

        return response()->json([$response->status, 201]);
    }
}
