<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\TemporalReservation; // Modelo de reserva temporal
use App\Models\UserActivitiesReservations; // Modelo de reserva
use App\Models\Activity; // Modelo de actividad
use Stripe\Stripe;
use Stripe\Charge;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use Inertia\Inertia;

class UserActivitiesReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {

    //     // Verifico si el usuario tiene membresía activa y lo almaceno en una varible
    //     $hasMembership = auth()->user()->hasActiveMembership();

    //     $reservations = UserActivitiesReservations::with('activity')
    //         ->where('user_id', auth()->user()->id)
    //         ->orderBy('activity_datetime', 'desc')
    //         ->limit(10)
    //         ->get();

    //     // dd($hasMembership);

    //     return inertia('User/ActivityOptions/ActivityReservations', compact('reservations', 'hasMembership'));
    // }

    // Vista de las reservas del usuario
    public function index()
    {
        // Verifico si el usuario tiene membresía activa y lo almaceno en una varible
        $hasMembership = auth()->user()->hasActiveMembership();

        // Obtengo todas las reservas del usuario
        $reservations = UserActivitiesReservations::with('activity')
            ->where('user_id', auth()->user()->id)
            ->orderBy('activity_datetime', 'desc')
            ->limit(10)
            ->get();

        // Agregamos una propiedad computed a cada reserva para saber si es pasada
        $reservations->each(function ($reservation) {
            $reservation->is_past = now()->gt($reservation->activity_datetime);
        });

        return inertia('User/ActivityOptions/ActivityReservations', compact('reservations', 'hasMembership'));
    }

    // Crear una reserva
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
            return back()->with('message', 'errorSameTime');
        }

        // Verificar si hay slots disponibles
        if ($act->slots <= 0) {
            return back()->with('message', 'errorNoSlots');
        }

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

                // Redirecciono al inicio
                return redirect()->route('users.index')
                    ->with('message', 'successMembership');
            });
        }

        // Usuario sin membresía, se redirecciona a Stripe
        return $this->processPayment($act);
    }

    // Procesar el pago
    public function processPayment($activity)
    {
        // Inicializamos Stripe
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        try {
            // Creamos la sesión de pago
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
                'success_url' => route('payment.success', $activity->id) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('users.index'),
                'metadata' => [
                    'activity_id' => $activity->id,
                    'user_id' => auth()->id()
                ],
                'customer_email' => auth()->user()->email,
            ]);


            // Guardar temporalmente la intención de reserva FIXME: Pendiente hacer una transacción y gestión de la sesión (Según el tipo de usuarios redireccionar a X pag)
            TemporalReservation::create([
                'user_id' => auth()->id(),
                'activity_id' => $activity->id,
                'session_id' => $checkout->id,
                'expires_at' => now()->addMinutes(30)
            ]);

            // Redirección a Stripe
            return Inertia::location($checkout->url);

        } catch (\Exception $e) {
            return back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    // Pago exitoso
    public function paymentSuccess($activityId)
    {
        // Obtengo la actividad
        $activity = Activity::findOrFail($activityId);
        $user = auth()->user();
        $sessionId = request()->get('session_id');


        // Verifico si la sesión es válida
        if (!$sessionId) {
            return redirect()->route('activities.show', $activityId)
                ->with('error', 'Sesión de pago no válida.');
        }

        // Inicializamos Stripe
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        try {
            // Obtenemos la sesión de pago
            $session = $stripe->checkout->sessions->retrieve($sessionId);

            // Verifico si el pago se completo correctamente
            if ($session->payment_status !== 'paid') {
                throw new \Exception('El pago no se completó correctamente.');
            }

            // Verificar si ya existe la reserva
            $existingReservation = UserActivitiesReservations::where('payment_id', $session->payment_intent)->first();

            // Si ya existe la reserva, devuelvo un error
            if ($existingReservation) {
                return redirect()->route('users.index')
                    ->with('info', 'Esta reserva ya fue procesada anteriormente.');
            }

            // Procesar la reserva
            DB::transaction(function () use ($activity, $user, $session) {
                $activity->decrement('slots');

                // Crear la reserva
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

            // Redirecciono al inicio
            return redirect()->route('users.index')
                ->with('message', true);

        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('message', false);
        }
    }

    // Pago por actividad
    public function payForActivity(Request $request, $activityId)
    {

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

    // Pago por actividad con PayPal
    public function payForActivityWithPaypal(Request $request, $activityId)
    {
        // Obtenemos el token de PayPal
        $paypalToken = $request->input('paypalToken');

        // Verifico si el token es válido
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

            // Registrar la respuesta completa para análisis
            \Log::info('Respuesta de PayPal:', (array) $response);

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

    // Telegram, redirijo a la página de Telegram 
    public function telegram()
    {
        // (Futura implementación, configurar el Bot para redirigir al grupo de una categoría)
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

        // $updates = Telegram::getUpdates();

        return redirect()->away('https://t.me/+oRCyDr_AbqQwMDM0');
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

        // Obtengo todas las reservas del usuario
        $reservations = UserActivitiesReservations::where('user_id', auth()->user()->id)->get();

        // Redirecciono
        return redirect()->route('userActivitiesReservations.index')->with('message', 'Reserva eliminada con éxito.');
    }
}
