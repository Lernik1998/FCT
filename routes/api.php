<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Google\Auth\Http\Request as GoogleRequest;
// use Google\Service\Calendar;
// use App\Http\Controllers\GoogleCalendarController;
// use App\Http\Controllers\AppointmentController;
use Laravel\Cashier\Http\Controllers\WebhookController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/webhook', [WebhookController::class, 'handleWebhook'])->name('cashier.webhook');




// Route::get('/calendar-events', [GoogleCalendarController::class, 'getEvents']);
// Route::post('/calendar-events', [GoogleCalendarController::class, 'createEvent']);
// Route::put('/calendar-events/{id}', [GoogleCalendarController::class, 'updateEvent']);
// Route::delete('/calendar-events/{id}', [GoogleCalendarController::class, 'deleteEvent']);


// Google Calendar con Full Calendar
// Route::get('/calendar/events', function (Request $request) {
// $calendarId = 'your_google_calendar_id';
// $apiKey = 'your_google_api_key';
// $url = "https://www.googleapis.com/calendar/v3/calendars/{$calendarId}/events?key={$apiKey}";

// $response = file_get_contents($url);
// return response($response, 200)->header('Content-Type', 'application/json');

//     $client = new Google\Client();
//     $client->setApplicationName('Tu Aplicación');
//     $client->setAuthConfig(storage_path('app/google-calendar/credentials.json'));
//     $client->addScope(Google\Service\Calendar::CALENDAR_READONLY);

//     $service = new Google\Service\Calendar($client);
//     $events = $service->events->listEvents(
//         '65dd6ab370d12e0c59d25eb65530b4891b909b8979c6d56b54870cdabd3971b5@group.calendar.google.com',
//         [
//             'timeMin' => $request->start,
//             'timeMax' => $request->end,
//             'singleEvents' => true,
//             'orderBy' => 'startTime'
//         ]
//     );

//     return response()->json($events->getItems());
// });
