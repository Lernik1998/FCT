<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Add this to your existing api.php file

Route::get('/weather', function () {
    $city = request('q'); // Get the city parameter from the request
    $apiKey = 'ad5c5aaec61f81669b4459cbd51dd4f6'; // Replace with your actual OpenWeatherMap API key
    $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

    // Make the request to the OpenWeatherMap API
    $response = file_get_contents($url);

    // Return the response back to the frontend
    return response($response, 200)->header('Content-Type', 'application/json');
});