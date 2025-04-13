<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Inertia\Inertia;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;


class AppointmentController extends Controller
{
    public function list(Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
        ]);


        $query = Appointment::whereBetween('start', [
            Carbon::parse($request->start)->startOfDay(),
            Carbon::parse($request->end)->endOfDay()
        ]);


        // if (!auth()->user()->isAdmin) {
        //     $query->where('user_id', auth()->id());
        // }
        // Si no es admin ni trainer, solo mostrar sus propios eventos
        if (!auth()->user()->isAdmin && !auth()->user()->isTrainer) {
            $query->where('user_id', auth()->id());
        }


        $events = $query->get()->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->title,
                'start' => $appointment->start,
                'end' => $appointment->end,
                'allDay' => false,
                'extendedProps' => [
                    'description' => $appointment->description,
                    // 'clientId' => $appointment->user_id,
                ],
                'backgroundColor' => '#f97316',
                'borderColor' => '#ea580c',
            ];
        });

        // MIRAR COMO DEVOLVER LOS DATOS JSON O INERTIA
        return response()->json($events);
    }


    public function store(Request $request)
    {
        try {
            \Log::info('Datos recibidos:', $request->all());

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'start' => 'required|date',
                'end' => 'required|date|after:start',
                'description' => 'nullable|string',
                'allDay' => 'nullable|boolean'
            ]);

            // Convertir fechas a la zona horaria de Google Calendar (GMT+2)
            $timezone = 'Europe/Madrid'; // Ajusta según tu zona horaria
            $startDateTime = Carbon::parse($validated['start'])->setTimezone($timezone);
            $endDateTime = Carbon::parse($validated['end'])->setTimezone($timezone);


            // Creo el evento en Google Calendar
            $event = new Event();
            $event->name = $validated['title'];
            $event->startDateTime = $startDateTime;
            $event->endDateTime = $endDateTime;
            $event->summary = $validated['title'];
            $nuevoEvento = $event->save();

            $eventId = $nuevoEvento->id;

            // Creo la cita y la guardo en la base de datos
            $appointment = Appointment::create([
                'title' => $validated['title'],
                'start' => $validated['start'],
                'end' => $validated['end'],
                'user_id' => auth()->id(),
                'description' => $validated['description'] ?? null,
                'all_day' => $validated['allDay'] ?? false,
                'google_calendar_event_id' => $eventId
            ]);

            return redirect()->route('trainers.pp')->with('success', 'Evento creado correctamente');


        } catch (\Exception $e) {
            \Log::error('Error completo:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('trainers.pp')->with('error', 'Error interno del servidor');
        }
    }

    public function update(Request $request, Appointment $appointment)
    {
        // Recibe los datos del formulario y valido
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'start' => 'sometimes|date',
            'end' => 'sometimes|date|after:start',
            'description' => 'nullable|string',
            'clientId' => auth()->user()->isAdmin ? 'sometimes|exists:users,id' : 'nullable'
        ]);

        try {
            // Convertir fechas a la zona horaria de Google Calendar (GMT+2)
            $timezone = 'Europe/Madrid';
            $startDateTime = Carbon::parse($validated['start'])->setTimezone($timezone);
            $endDateTime = Carbon::parse($validated['end'])->setTimezone($timezone);

            // Preparo los datos para la actualizacion
            $updateData = [
                'title' => $validated['title'] ?? $appointment->title,
                'start' => $startDateTime->toDateTimeString(),
                'end' => $endDateTime->toDateTimeString(),
                'description' => $validated['description'] ?? $appointment->description,
            ];


            // Busco evento en Google Calendar si existe
            if ($appointment->google_calendar_event_id) {
                $event = Event::find($appointment->google_calendar_event_id);
                if ($event) {
                    $event->name = $validated['title'] ?? $appointment->title;
                    $event->startDateTime = Carbon::parse($validated['start'] ?? $appointment->start);
                    $event->endDateTime = Carbon::parse($validated['end'] ?? $appointment->end);
                    $event->summary = $validated['title'] ?? $appointment->title;
                    $event->save();
                }
            }

            // if (auth()->user()->isAdmin && isset($validated['clientId'])) {
            //     $updateData['user_id'] = $validated['clientId'];
            // }

            $appointment->update($updateData);

            return redirect()->route('trainers.pp')->with('success', 'Evento actualizado correctamente');

        } catch (\Exception $e) {
            \Log::error('Error al actualizar cita: ' . $e->getMessage());
            return redirect()->route('trainers.pp')->with('error', 'Error al actualizar el evento');
        }
    }


    public function destroy(Appointment $appointment)
    {

        try {
            // Eliminar primero de Google Calendar si existe
            if ($appointment->google_calendar_event_id) {
                $event = Event::find($appointment->google_calendar_event_id);
                if ($event) {
                    $event->delete();
                }
            }

            // Elimino de la BD
            $appointment->delete();

            return redirect()->route('trainers.pp')->with('success', 'Evento eliminado correctamente');

        } catch (\Exception $e) {
            \Log::error('Error al eliminar cita: ' . $e->getMessage());
            return redirect()->route('trainers.pp')->with('error', 'Error al eliminar el evento');
        }

    }
}