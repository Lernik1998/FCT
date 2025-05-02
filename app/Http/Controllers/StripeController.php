<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\SubscriptionItem;


class StripeController extends Controller
{
    public function index()
    {
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
        // Creo en la bd FIXME:


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

}
