<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Suscripciones de prueba en entorno local
        Plan::create([
            'name' => 'Basic',
            'stripe_plan_id' => 'prod_SOZIYSqvBPlVCF',
            'stripe_price_id' => 'price_1RTmA4IM6rivlwad8slYmxIt',
        ]);

        Plan::create([
            'name' => 'Pro',
            'stripe_plan_id' => 'prod_SOZKjwMFENwMFv',
            'stripe_price_id' => 'price_1RTmByIM6rivlwadPRZbLfsy',
        ]);

        Plan::create([
            'name' => 'Elite',
            'stripe_plan_id' => 'prod_SOZKiWciAnsnXI',
            'stripe_price_id' => 'price_1RTmBYIM6rivlwadbnJwJxcr',
        ]);
    }
}
