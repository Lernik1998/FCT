<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Calendar;
use Illuminate\Support\Facades\Config;
use App\Models\Appointment;
use Carbon\Carbon;
use Log;
// use Google\Service\Calendar\Event;
use Inertia\Inertia;

use Spatie\GoogleCalendar\Event;



class GoogleCalendarController extends Controller
{
    private $client;
    private $service;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName(config('google_calendar.application_name'));
        $this->client->setScopes([
            Calendar::CALENDAR,
            Calendar::CALENDAR_EVENTS
        ]);
        // $this->client->setAccessType('offline');
        // $this->client->setAuthConfig(config('google_calendar.credentials_path'));
        // $this->service = new Calendar($this->client);

        $this->client->setAccessType('offline');

        // Usar las credenciales específicas para Calendar
        // $this->client->setAuthConfig(config('google_calendar.credentials_path'));
        $this->client->setAuthConfig(config('google-calendar.auth_profiles.service_account.credentials_json'));

        // $this->client->setClientId(config('google_calendar.client_id')); // No es necesario para el service account FIXME:
        $this->client->setClientSecret(config('google_calendar.client_secret'));
        $this->client->setRedirectUri(config('google_calendar.redirect_uri'));

        $this->service = new Calendar($this->client);
    }

    // public function syncAppointment(Appointment $appointment)
    // {
    //     // try {
    //     //     $event = new Calendar\Event([
    //     //         'summary' => $appointment->title,
    //     //         'description' => $appointment->description,
    //     //         'start' => [
    //     //             'dateTime' => $appointment->start->format('c'),
    //     //             'timeZone' => config('app.timezone'),
    //     //         ],
    //     //         'end' => [
    //     //             'dateTime' => $appointment->end->format('c'),
    //     //             'timeZone' => config('app.timezone'),
    //     //         ],
    //     //     ]);

    //     //     if ($appointment->google_calendar_event_id) {
    //     //         // Update existing event
    //     //         $event = $this->service->events->update(
    //     //             config('google_calendar.calendar_id'),
    //     //             $appointment->google_calendar_event_id,
    //     //             $event
    //     //         );
    //     //     } else {
    //     //         // Create new event
    //     //         $event = $this->service->events->insert(
    //     //             config('google_calendar.calendar_id'),
    //     //             $event
    //     //         );

    //     //         $appointment->google_calendar_event_id = $event->id;
    //     //         $appointment->save();
    //     //     }

    //     //     return $event;
    //     // } catch (\Exception $e) {
    //     //     \Log::error('Google Calendar sync error: ' . $e->getMessage());
    //     //     throw $e;
    //     // }

    //     try {
    //         $client = new \Google\Client();
    //         $client->setApplicationName(config('google_calendar.application_name'));
    //         $client->setScopes([
    //             \Google\Service\Calendar::CALENDAR,
    //             \Google\Service\Calendar::CALENDAR_EVENTS
    //         ]);
    //         $client->setAccessType('offline');
    //         $client->setAuthConfig(config('google_calendar.credentials_path'));

    //         $service = new \Google\Service\Calendar($client);

    //         $event = new \Google\Service\Calendar\Event([
    //             'summary' => $appointment->title,
    //             'description' => $appointment->description,
    //             'start' => [
    //                 'dateTime' => $appointment->start->format('c'),
    //                 'timeZone' => config('app.timezone'),
    //             ],
    //             'end' => [
    //                 'dateTime' => $appointment->end->format('c'),
    //                 'timeZone' => config('app.timezone'),
    //             ],
    //         ]);

    //         if ($appointment->google_calendar_event_id) {
    //             $event = $service->events->update(
    //                 config('google_calendar.calendar_id'),
    //                 $appointment->google_calendar_event_id,
    //                 $event
    //             );
    //         } else {
    //             $event = $service->events->insert(
    //                 config('google_calendar.calendar_id'),
    //                 $event
    //             );

    //             $appointment->google_calendar_event_id = $event->id;
    //             $appointment->save();
    //         }

    //         return $event;
    //     } catch (\Exception $e) {
    //         \Log::error('Google Calendar sync error: ' . $e->getMessage());
    //         throw $e;
    //     }
    // }

    public function syncAppointment(Appointment $appointment)
    {
        // Debugging
        dd($appointment);

        return response()->json([
            'success' => "Ha llegado a GoogleCalendarController.php"
        ]);

        // try {
        //     if (empty(config('google_calendar.calendar_id'))) {
        //         Log::warning('Calendar ID no configurado. Omitiendo sincronización.');
        //         return null;
        //     }

        //     // Convertir las cadenas de fecha a objetos Carbon primero
        //     // $start = Carbon::parse($appointment->start);
        //     // $end = Carbon::parse($appointment->end);
        //     // Usar las fechas ya convertidas en el modelo
        //     $start = $appointment->start;
        //     $end = $appointment->end;

        //     $event = new Event([
        //         'summary' => $appointment->title,
        //         'description' => $appointment->description,
        //         'start' => [
        //             'dateTime' => $start->format('c'), // Formato ISO 8601
        //             'timeZone' => config('app.timezone'),
        //         ],
        //         'end' => [
        //             'dateTime' => $end->format('c'), // Formato ISO 8601
        //             'timeZone' => config('app.timezone'),
        //         ],
        //     ]);

        //     if ($appointment->google_calendar_event_id) {
        //         $event = $this->service->events->update(
        //             config('google_calendar.calendar_id'),
        //             $appointment->google_calendar_event_id,
        //             $event
        //         );
        //     } else {
        //         $event = $this->service->events->insert(
        //             config('google_calendar.calendar_id'),
        //             $event
        //         );

        //         $appointment->update([
        //             'google_calendar_event_id' => $event->getId()
        //         ]);
        //     }

        //     return $event;
        // } catch (\Exception $e) {
        //     \Log::error('Error al sincronizar cita con Google Calendar: ' . $e->getMessage());
        //     throw $e;
        // }
    }



    public function deleteFromCalendar(Appointment $appointment)
    {
        if ($appointment->google_calendar_event_id) {
            try {
                $this->service->events->delete(
                    config('google_calendar.calendar_id'),
                    $appointment->google_calendar_event_id
                );
                $appointment->google_calendar_event_id = null;
                $appointment->save();
            } catch (\Exception $e) {
                \Log::error('Google Calendar delete error: ' . $e->getMessage());
                throw $e;
            }
        }
    }

    public function syncAllAppointments()
    {
        $appointments = Appointment::whereNotNull('google_calendar_event_id')->get();
        foreach ($appointments as $appointment) {
            try {
                $this->syncAppointment($appointment);
            } catch (\Exception $e) {
                \Log::error('Error syncing appointment ' . $appointment->id . ': ' . $e->getMessage());
            }
        }
    }

    public function testConnection()
    {
        try {
            $client = new Client();
            $client->setAuthConfig(config('google-calendar.auth_profiles.service_account.credentials_json'));

            // $client->setAuthConfig(storage_path(config('app/google-calendar/client_secret.json')));
            $client->addScope(Calendar::CALENDAR);

            if (!$client->getAccessToken()) {
                // return response()->json([
                //     'status' => 'auth_required',
                //     'auth_url' => $client->createAuthUrl()
                // ]);
            }

            $service = new Calendar($client);
            $calendar = $service->calendars->get(config('google-calendar.calendar_id'));

            // return response()->json([
            //     'status' => 'success',
            //     'calendar' => $calendar
            // ]);

            $event = new Event();

            $event->name = "Test Event";
            $event->startDateTime = now();
            $event->endDateTime = now()->addHours(2);
            $event->summary = 'Test Event';
            $event->save();

            return Inertia::render('Trainer/TrainerPPlans', ['success' => true]);


        } catch (\Exception $e) {
            return Inertia::render('Trainer/TrainerPPlans', [
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}