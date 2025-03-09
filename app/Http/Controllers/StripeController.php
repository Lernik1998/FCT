<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

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
                'amount' => 5000, // Monto en centavos (50.00 USD)
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
    }

    public function cancel()
    {
    }


}
