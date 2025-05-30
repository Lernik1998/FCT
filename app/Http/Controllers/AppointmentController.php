<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;
use Telegram\Bot\Api as Telegram;
use App\Models\Category;
use App\Helpers\CalendarChangeHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;


class AppointmentController extends Controller
{
    // Listado de actividades del CALENDARIO 
    public function list(Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $query = Appointment::query();

        // Siempre filtramos por rango de fechas
        $query->whereBetween('start', [
            Carbon::parse($request->start)->startOfDay(),
            Carbon::parse($request->end)->endOfDay()
        ]);

        // Si es admin, mostrar todos los eventos
        if (auth()->user()->isAdmin) {
            $query->where('user_id', auth()->id());
        }

        // Si es trainer, mostrar los eventos de su categoría
        if (auth()->user()->isTrainer()) {
            $query->where('category', auth()->user()->category);
        }

        // Si es admin, no aplicamos filtros adicionales (ya tiene los de fechas)
        // Por tanto, no hace falta hacer nada más

        $events = $query->get()->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->title,
                'start' => $appointment->start,
                'end' => $appointment->end,
                'allDay' => false,
                'extendedProps' => [
                    'description' => $appointment->description,
                ],
                'backgroundColor' => '#f97316',
                'borderColor' => '#ea580c',
            ];
        });

        return response()->json($events);
    }

    // Crear una actividad
    public function store(Request $request)
    {

        try {
            \Log::info('Datos recibidos:', $request->all());

            // $validated = $request->validate([
            //     'title' => 'required|string|max:255',
            //     'start' => 'required|date',
            //     'end' => 'required|date|after:start',
            //     'description' => 'nullable|string',
            //     'allDay' => 'nullable|boolean',
            //     'price' => 'nullable|numeric',
            //     'capacity' => 'nullable|integer',
            //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);

            // 1. Obtener la categoria del entrenador
            $calendarType = auth()->user()->category;

            if (!$calendarType) {
                throw new \Exception("El usuario no tiene categoría asignada.");
            }

            // 2. Obtener el calendarId desde el helper
            $calendarId = CalendarChangeHelper::getCalendarIdByCategoryName($calendarType);

            if (!$calendarId) {
                throw new \Exception("No se encontró un calendarId válido para '{$calendarType}'");
            }

            // Busco el id de la categoria según el nomre $calendarType
            $category = Category::where('name', $calendarType)->first();

            if (!$category) {
                throw new \Exception("No se encontró una categoría con el nombre '{$calendarType}'");
            }

            // 3. Fechas con zona horaria
            $timezone = 'Europe/Madrid';
            $startDateTime = Carbon::parse($request->start)->setTimezone($timezone);
            $endDateTime = Carbon::parse($request->end)->setTimezone($timezone);
            $dia = Carbon::parse($request->start)->format('Y-m-d');

            // 4. Crear el evento en Google Calendar
            $googleEvent = Event::create([
                'name' => $request->title,
                'startDateTime' => $startDateTime,
                'endDateTime' => $endDateTime,
                'description' => $request->description ?? null,
            ], $calendarId);


            $generalCalendarId = CalendarChangeHelper::getCalendarIdByCategoryName('general');

            // Creo evento en el Calendario General
            $googleEventGeneral = Event::create([
                'name' => $request->title,
                'startDateTime' => $startDateTime,
                'endDateTime' => $endDateTime,
                'description' => $request->description ?? null,
            ], $generalCalendarId);

            // 5. Guardar en la base de datos local
            $appointment = Appointment::create([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
                'user_id' => auth()->id(),
                'description' => $request->description ?? null,
                'all_day' => $request->allDay ?? false,
                'google_calendar_event_id' => $googleEvent->id,
                'category' => $calendarType,
            ]);

            $activity = new Activity();
            $activity->name = $request->title;
            $activity->description = $request->description ?? 'Sin descripción';
            $activity->image = 'default.jpg';
            $activity->price = $request->price;
            $activity->start_time = $request->start;
            $activity->end_time = $request->end;
            $activity->date = $dia;
            $activity->capacity = $request->capacity;
            $activity->slots = $request->capacity; // ← slots igual a capacity
            $activity->category_id = $category->id;
            $activity->user_id = auth()->id();
            $activity->save();


            // Luego actualizo la imagen si se subió
            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $imgName = Str::slug($request->title) . '.' . $img->guessExtension();

                $path = public_path('images/activities/');
                $img->move($path, $imgName); // El archivo se guarda en: public/images/activities/


                DB::update("UPDATE activities SET image = ? WHERE name = ? AND date = ?", [
                    $imgName,
                    $request->title,
                    $dia
                ]);
            }


            // 6. Enviar notificación Telegram
            $telegram = new Telegram(env('TELEGRAM_BOT_TOKEN'));
            $text = "<b>¡Nueva actividad publicada!</b>\n\n" .
                "🏷 <b>Título:</b> " . $request->title . "\n" .
                "📝 <b>Descripción:</b> " . ($request->description ?? '-') . "\n\n" .
                "🔗 <a href='" . url('/actividades/' . $appointment->id) . "'>Ver actividad en el sitio web</a>";

            $telegram->sendMessage([
                "chat_id" => env('TELEGRAM_CHAT_ID', ''),
                "text" => $text,
                "parse_mode" => "HTML",
            ]);

            return redirect()->route('trainers.activityCalendar')->with('message', 0);
        } catch (\Exception $e) {
            \Log::error('Error completo:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('trainers.activityCalendar')->with('message', 1);
        }
    }

    // Función para obtener la actividad
    public function getActivityInfo($name)
    {
        // Busco la actividad
        $activity = Activity::where('name', $name)->first();

        return response()->json($activity);
    }


    // Actualizar una actividad
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

            $appointment->update($updateData);

            return redirect()->route('trainers.activityCalendar')->with('success', 'Evento actualizado correctamente');

        } catch (\Exception $e) {
            \Log::error('Error al actualizar cita: ' . $e->getMessage());
            return redirect()->route('trainers.activityCalendar')->with('error', 'Error al actualizar el evento');
        }
    }

    // Eliminar una actividad
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

            return redirect()->route('trainers.activityCalendar')->with('success', 'Evento eliminado correctamente');

        } catch (\Exception $e) {
            \Log::error('Error al eliminar cita: ' . $e->getMessage());
            return redirect()->route('trainers.activityCalendar')->with('error', 'Error al eliminar el evento');
        }
    }
}