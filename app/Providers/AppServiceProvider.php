<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Laravel\Cashier\Cashier;
use App\Models\Subscription;
use App\Models\SubscriptionItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Asignación dinámica de calendarios a los entrenadores, en el caso de que falle el Helper
        config([
            'google_calendars' => [
                'General' => env('GOOGLE_CALENDAR_ID'),
                'Resistencia y cardio' => env('GOOGLE_CALENDAR_RESISTENCIA_CARDIO_ID'),
                'Baile' => env('GOOGLE_CALENDAR_BAILE_ID'),
                'Flexibilidad y cuerpo-mente' => env('GOOGLE_CALENDAR_FLEXIBILIDAD_ID'),
                'Fuerza y acondicionamiento' => env('GOOGLE_CALENDAR_FUERZA_ID'),
                'Rehabilitación o movimiento suave' => env('GOOGLE_CALENDAR_REHAB_ID'),
            ],
        ]);
    }
}
