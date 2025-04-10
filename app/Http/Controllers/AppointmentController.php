<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Inertia\Inertia;
use Carbon\Carbon;


class AppointmentController extends Controller
{
    public function index()
    {
        return Inertia::render('Calendar/Index', [
            'clients' => \App\Models\User::where('role', 'client')->get(['id', 'name']),
        ]);
    }


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
                    'clientId' => $appointment->user_id,
                ],
                'backgroundColor' => '#f97316',
                'borderColor' => '#ea580c',
            ];
        });


        return response()->json($events);
    }


    public function store(Request $request)
    {

        // dd($request->all());
        try {
            \Log::info('Datos recibidos:', $request->all());

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'start' => 'required|date',
                'end' => 'required|date|after:start',
                'description' => 'nullable|string',
                'allDay' => 'nullable|boolean'
            ]);

            // Convertir fechas a formato MySQL
            $start = Carbon::parse($validated['start'])->format('Y-m-d H:i:s');
            $end = Carbon::parse($validated['end'])->format('Y-m-d H:i:s');

            // \Log::info('Datos validados:', $validated);

            // Convertir fechas ISO a formato MySQL
            // $start = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $validated['start'])
            //     ->setTimezone(config('app.timezone'))
            //     ->format('Y-m-d H:i:s');

            // $end = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $validated['end'])
            //     ->setTimezone(config('app.timezone'))
            //     ->format('Y-m-d H:i:s');

            // Convertir fechas al formato correcto
            // $start = Carbon::parse($validated['start']);
            // $end = Carbon::parse($validated['end']);

            // \Log::info('Fechas convertidas:', ['start' => $start, 'end' => $end]);

            $appointment = Appointment::create([
                'title' => $validated['title'],
                'start' => $start,
                'end' => $end,
                'user_id' => auth()->id(),
                'description' => $validated['description'] ?? null,
                'all_day' => $validated['allDay'] ?? false,
                // 'user_id' => auth()->user()->isAdmin ? $validated['clientId'] : auth()->id()
            ]);
            // \Log::info('Cita creada:', $appointment->toArray());
            
        } catch (\Exception $e) {
            \Log::error('Error completo:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'error' => 'Error interno del servidor',
                'details' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }

        // Sincronizar con Google Calendar
        try {
            $googleCalendarController = new GoogleCalendarController();
            $googleEvent = $googleCalendarController->syncAppointment($appointment);

            // Si se sincronizó con Google, guardar el ID del evento
            if ($googleEvent) {
                $appointment->update([
                    'google_calendar_event_id' => $googleEvent->id
                ]);
            }

        } catch (\Exception $e) {
            \Log::error('Error al sincronizar con Google Calendar: ' . $e->getMessage());
            // return response()->json(['error' => 'No se pudo sincronizar con Google Calendar'], 500);
        }


        // return response()->json([
        //     'id' => $appointment->id,
        //     'title' => $appointment->title,
        //     'start' => $appointment->start,
        //     'end' => $appointment->end,
        //     'extendedProps' => [
        //         'description' => $appointment->description,
        //         // 'clientId' => $appointment->user_id,
        //     ],
        //     'backgroundColor' => '#f97316',
        //     'borderColor' => '#ea580c',
        // ]);
        return Inertia::render('Calendar/Index', [
            'success' => true,
            'event' => [
                'id' => $appointment->id,
                'title' => $appointment->title,
                'start' => $appointment->start,
                'end' => $appointment->end,
                'extendedProps' => [
                    'description' => $appointment->description,
                    'clientId' => $appointment->user_id,
                ],
                'backgroundColor' => '#f97316',
                'borderColor' => '#ea580c',
            ]
        ]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        // $this->authorize('update', $appointment);


        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'start' => 'sometimes|date',
            'end' => 'sometimes|date|after:start',
            'description' => 'nullable|string',
            'clientId' => auth()->user()->isAdmin ? 'sometimes|exists:users,id' : 'nullable'
        ]);


        $updateData = [
            'title' => $validated['title'] ?? $appointment->title,
            'start' => $validated['start'] ?? $appointment->start,
            'end' => $validated['end'] ?? $appointment->end,
            'description' => $validated['description'] ?? $appointment->description,
        ];


        if (auth()->user()->isAdmin && isset($validated['clientId'])) {
            $updateData['user_id'] = $validated['clientId'];
        }


        $appointment->update($updateData);


        return response()->json([
            'id' => $appointment->id,
            'title' => $appointment->title,
            'start' => $appointment->start,
            'end' => $appointment->end,
            'extendedProps' => [
                'description' => $appointment->description,
                'clientId' => $appointment->user_id,
            ],
            'backgroundColor' => '#f97316',
            'borderColor' => '#ea580c',
        ]);
    }


    public function destroy(Appointment $appointment)
    {
        // $this->authorize('delete', $appointment);

        $appointment->delete();

        return response()->json(['success' => true]);
    }
}