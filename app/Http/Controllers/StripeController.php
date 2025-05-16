<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Stripe\Subscription;

class StripeController extends Controller
{
    public function index()
    {
        /* AMPLIACIÓN: Cargar estadísticas de ventas */
    }

    public function charge(Request $request)
    {

        dd($request->all());

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => 5000, // 50.00 USD
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Pago de prueba',
            ]);

            return back()->with('success_message', 'Pago realizado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error_message', 'Error en el pago: ' . $e->getMessage());
        }

    }

    public function success()
    {
        return inertia('Payments/SuccessPayment');
    }

    public function cancel()
    {
        return inertia('Payments/FailedPayment');
    }

    public function checkout(Request $request, $name)
    {
        $plan = Plan::where('name', $name)->first();
        $planPrecio = $plan->stripe_price_id;

        return $request->user()
            ->newSubscription('default', $planPrecio)
            ->checkout([
                'success_url' => route('stripe.success'),
                'cancel_url' => route('stripe.cancel'),
            ]);
    }


    public function webhook()
    {
        \Log::info('Stripe webhook recibido');

        return response()->json(['status' => 'success']);
    }

    public function cancelMembership()
    {

        $user = Auth::user()->id;

        // dd($user);

        try {

            // Obtener información de suscripción del usuario
            $user = auth()->user();

            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            // Verificar si el usuario tiene una suscripción activa
            if ($user->subscription('default')) {
                $stripeSubscription = $stripe->subscriptions->retrieve($user->subscription('default')->stripe_id);
                $currentProduct = $stripe->products->retrieve($stripeSubscription->items->data[0]->price->product);

                // Opción 2: Cancelar al final del período de pago (recomendado)
                $stripeSubscription->cancel();
            }

            // dd($stripeSubscription);

            // Cancelar la suscripción en Stripe
            // $subscription = $user->subscription('default');

            // Opción 1: Cancelar inmediatamente
            // $subscription->cancelNow();



            return redirect()->back()->with('success', 'Tu suscripción ha sido cancelada y permanecerá activa hasta el final del período actual');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cancelar la suscripción: ' . $e->getMessage());
        }
    }

}
