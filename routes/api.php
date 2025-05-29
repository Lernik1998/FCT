<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Http\Controllers\WebhookController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Conexión con Cashier
Route::post('/webhook', [WebhookController::class, 'handleWebhook'])->name('cashier.webhook');