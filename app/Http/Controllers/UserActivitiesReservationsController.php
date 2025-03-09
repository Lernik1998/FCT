<?php

namespace App\Http\Controllers;

use App\Models\UserActivitiesReservations;
use Illuminate\Http\Request;
use App\Models\Activity; // Modelo de actividad

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
        // Obtengo la actividad
        $activity = Activity::findOrFail($id);

        // Cargo la vista de pago
        return inertia('User/ActivityOptions/ActivityCardPayment', compact('activity'));
    }

    public function payForActivity(Request $request, $activityId)
    {
        dd($request, $activityId);

        // Obtengo la actividad
        $activity = Activity::findOrFail($activityId);

        // Obtengo la reserva
        $reservation = UserActivitiesReservations::where('user_id', auth()->user()->id)
            ->where('activity_id', $activityId)
            ->first();

        //Cargo la vista de pago
        // Lógica para procesar el pago
        // Validar la solicitud, procesar el pago, actualizar la reserva, etc.
    }
}
