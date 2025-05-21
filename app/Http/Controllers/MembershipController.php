<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        // Obtener productos activos
        $products = $stripe->products->all(['active' => true])->data;

        // Obtener precios para cada producto
        $productsWithPrices = [];
        foreach ($products as $product) {
            $price = $stripe->prices->retrieve($product->default_price);
            $productsWithPrices[] = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price_id' => $price->id,
                'unit_amount' => $price->unit_amount,
                'currency' => $price->currency,
                'recurring' => $price->recurring ?? null,
            ];
        }

        // Obtener información de suscripción del usuario
        $user = auth()->user();
        $currentMembership = null;
        $nextPayment = null;
        $status = 'Inactivo';

        if ($user->subscription('default')) {
            $stripeSubscription = $stripe->subscriptions->retrieve($user->subscription('default')->stripe_id);
            $currentProduct = $stripe->products->retrieve($stripeSubscription->items->data[0]->price->product);

            $currentMembership = $currentProduct->name;
            $nextPayment = date('d F, Y', $stripeSubscription->current_period_end);
            $status = $stripeSubscription->status === 'active' ? 'Activo' : 'Inactivo';
        }

        return inertia::render('User/UserMemberships', [
            'memberships' => $productsWithPrices,
            'current_membership' => [
                'name' => $currentMembership,
                'next_payment' => $nextPayment,
                'status' => $status
            ]
        ]);
    }
}
