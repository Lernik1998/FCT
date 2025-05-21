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
        // Plan::create([
        //     'name' => 'Básico',
        //     'stripe_plan_id' => 'prod_SEVTr9OGD0X6rA',
        //     'stripe_price_id' => 'price_1RK2T1IM6rivlwadSIx0EmLN',
        // ]);

        // Plan::create([
        //     'name' => 'Pro',
        //     'stripe_plan_id' => 'prod_SEVVnuBRebH8ma',
        //     'stripe_price_id' => 'price_1RK2UKIM6rivlwadOwPQiB8Q',
        // ]);

        // Plan::create([
        //     'name' => 'Elite',
        //     'stripe_plan_id' => 'prod_SEVWfkwtXNWxaA',
        //     'stripe_price_id' => 'price_1RK2VOIM6rivlwadmU04Kwej',
        // ]);
    }
}
