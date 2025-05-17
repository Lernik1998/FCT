<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event as GoogleEvent;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Spatie\GoogleCalendar\Event;

class GoogleCalendarController extends Controller
{
    private $client;
    private $service;

    public function __construct()
    {
        $this->initializeGoogleClient();
    }

    protected function initializeGoogleClient()
    {
        try {
            $this->client = new Client();
            $this->client->setApplicationName(config('google-calendar.application_name'));
            $this->client->setScopes([
                Calendar::CALENDAR,
                Calendar::CALENDAR_EVENTS
            ]);

            // Configuración exclusiva para Service Account
            $this->client->setAuthConfig(
                config('google-calendar.auth_profiles.service_account.credentials_json')
            );

            $this->service = new Calendar($this->client);

        } catch (\Exception $e) {
            Log::error('Error inicializando Google Client: ' . $e->getMessage());
            throw $e;
        }
    }

    public function syncAppointment(Appointment $appointment)
    {
        try {
            if (empty($appointment->google_calendar_event_id)) {
                return $this->createEvent($appointment);
            }

            return $this->updateEvent($appointment);

        } catch (\Exception $e) {
            Log::error('Error sincronizando cita: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function createEvent(Appointment $appointment)
    {
        $event = new GoogleEvent([
            'summary' => $appointment->title,
            'description' => $appointment->description,
            'start' => $this->getDateTimeObject($appointment->start),
            'end' => $this->getDateTimeObject($appointment->end),
        ]);

        $createdEvent = $this->service->events->insert(
            config('google-calendar.calendar_id'),
            $event
        );

        $appointment->update([
            'google_calendar_event_id' => $createdEvent->getId()
        ]);

        return $createdEvent;
    }

    protected function updateEvent(Appointment $appointment)
    {
        $event = $this->service->events->get(
            config('google-calendar.calendar_id'),
            $appointment->google_calendar_event_id
        );

        $event->setSummary($appointment->title);
        $event->setDescription($appointment->description);
        $event->setStart($this->getDateTimeObject($appointment->start));
        $event->setEnd($this->getDateTimeObject($appointment->end));

        return $this->service->events->update(
            config('google-calendar.calendar_id'),
            $event->getId(),
            $event
        );
    }

    protected function getDateTimeObject($dateTime)
    {
        return new \Google\Service\Calendar\EventDateTime([
            'dateTime' => Carbon::parse($dateTime)->format('c'),
            'timeZone' => config('app.timezone'),
        ]);
    }

    public function deleteFromCalendar(Appointment $appointment)
    {
        if (!$appointment->google_calendar_event_id) {
            return;
        }

        try {
            $this->service->events->delete(
                config('google-calendar.calendar_id'),
                $appointment->google_calendar_event_id
            );

            $appointment->update(['google_calendar_event_id' => null]);

        } catch (\Exception $e) {
            Log::error('Error eliminando evento: ' . $e->getMessage());
            throw $e;
        }
    }

    public function testConnection()
    {
        try {
            // Verificar conexión básica
            $calendar = $this->service->calendars->get(config('google-calendar.calendar_id'));

            // Crear evento de prueba
            $event = new GoogleEvent([
                'summary' => 'Test Connection',
                'start' => $this->getDateTimeObject(now()),
                'end' => $this->getDateTimeObject(now()->addHour()),
            ]);

            $createdEvent = $this->service->events->insert(
                config('google-calendar.calendar_id'),
                $event
            );

            // Limpiar: eliminar evento de prueba
            $this->service->events->delete(
                config('google-calendar.calendar_id'),
                $createdEvent->getId()
            );

            return Inertia::render('Trainer/TrainerPPlans', [
                'success' => true,
                'calendar' => [
                    'id' => $calendar->getId(),
                    'summary' => $calendar->getSummary()
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Test Connection Failed: ' . $e->getMessage());

            return Inertia::render('Trainer/TrainerPPlans', [
                'success' => false,
                'error' => $e->getMessage(),
                'debug' => [
                    'credentials_path' => config('google-calendar.auth_profiles.service_account.credentials_json'),
                    'file_exists' => file_exists(config('google-calendar.auth_profiles.service_account.credentials_json')),
                    'calendar_id' => config('google-calendar.calendar_id')
                ]
            ]);
        }
    }
}