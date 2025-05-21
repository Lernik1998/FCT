<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

    //     // Obtener productos activos
    //     $products = $stripe->products->all(['active' => true])->data;

    //     // Obtener precios para cada producto
    //     $productsWithPrices = [];
    //     foreach ($products as $product) {
    //         if (!$product->default_price)
    //             continue;

    //         $price = $stripe->prices->retrieve($product->default_price);


    //         $productsWithPrices[] = [
    //             'id' => $product->id,
    //             'name' => $product->name,
    //             'description' => $product->description,
    //             'price_id' => $price->id,
    //             'unit_amount' => $price->unit_amount,
    //             'currency' => $price->currency,
    //             'recurring' => $price->recurring ?? null,
    //         ];
    //     }

    //     // Obtener información de suscripción del usuario
    //     $user = auth()->user();
    //     $currentMembership = null;
    //     $nextPayment = null;
    //     $status = 'Inactivo';

    //     if ($user->subscription('default')) {
    //         $stripeSubscription = $stripe->subscriptions->retrieve($user->subscription('default')->stripe_id);
    //         $currentProduct = $stripe->products->retrieve($stripeSubscription->items->data[0]->price->product);

    //         $currentMembership = $currentProduct->name;
    //         $nextPayment = date('d F, Y', $stripeSubscription->current_period_end);
    //         $status = $stripeSubscription->status === 'active' ? 'Activo' : 'Inactivo';
    //     }

    //     return inertia::render('User/UserMemberships', [
    //         'memberships' => $productsWithPrices,
    //         'current_membership' => [
    //             'name' => $currentMembership,
    //             'next_payment' => $nextPayment,
    //             'status' => $status
    //         ]
    //     ]);
    // }

    public function index()
    {
        try {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            // Obtener productos activos
            $products = $stripe->products->all(['active' => true])->data;

            // Obtener precios para cada producto
            $productsWithPrices = [];
            foreach ($products as $product) {
                if (!$product->default_price)
                    continue;

                try {
                    $price = $stripe->prices->retrieve($product->default_price);

                    $productsWithPrices[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description ?? 'Sin descripción',
                        'price_id' => $price->id,
                        'unit_amount' => $price->unit_amount,
                        'currency' => $price->currency,
                        'recurring' => $price->recurring ?? null,
                    ];
                } catch (\Exception $e) {
                    // Registrar error pero continuar con otros productos
                    \Log::error("Error al obtener precio para producto {$product->id}: " . $e->getMessage());
                    continue;
                }
            }

            // Obtener información de suscripción del usuario
            $currentMembership = null;
            $nextPayment = null;
            $status = 'Inactivo';

            if (auth()->user()->subscription('default')) {
                try {
                    $stripeSubscription = $stripe->subscriptions->retrieve(
                        auth()->user()->subscription('default')->stripe_id
                    );

                    $currentProduct = $stripe->products->retrieve(
                        $stripeSubscription->items->data[0]->price->product
                    );

                    $currentMembership = $currentProduct->name;
                    $nextPayment = date('d F, Y', $stripeSubscription->current_period_end);
                    $status = $stripeSubscription->status === 'active' ? 'Activo' : 'Inactivo';
                } catch (\Exception $e) {
                    \Log::error("Error al obtener suscripción del usuario: " . $e->getMessage());
                }
            }

            return Inertia::render('User/UserMemberships', [
                'memberships' => $productsWithPrices,
                'current_membership' => [
                    'name' => $currentMembership,
                    'next_payment' => $nextPayment,
                    'status' => $status
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error("Error en MembershipController: " . $e->getMessage());

            return Inertia::render('User/UserMemberships', [
                'memberships' => [],
                'current_membership' => [
                    'name' => null,
                    'next_payment' => null,
                    'status' => null
                ],
                'error' => 'No se pudieron cargar los planes en este momento. Por favor, inténtalo más tarde.'
            ]);
        }
    }
}
