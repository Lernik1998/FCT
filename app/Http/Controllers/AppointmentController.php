<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;
use Telegram\Bot\Api as Telegram;
use App\Models\Activity;
use App\Models\Category;

use Google_Service_Calendar_Event;
use Google_Service_Calendar;

use Google_Client;

use Spatie\GoogleCalendar\GoogleCalendar;
use Spatie\GoogleCalendar\GoogleCalendarFactory;

use App\Helpers\CalendarChangeHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

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


    public function admin()
    {
        // $events = Appointment::all();
        // return Inertia::render('Admin/IndexAdmin', [
        //     'events' => $events
        // ]);


        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $query = Appointment::whereBetween('start', [
            Carbon::parse($request->start)->startOfDay(),
            Carbon::parse($request->end)->endOfDay()
        ]);

        // Si es Admin traer todos los eventos
        if (auth()->user()->isAdmin) {
            $query = Appointment::all();
        }

        //    // Si es Trainer traer solo sus propios eventos
        //    if (auth()->user()->isTrainer) {
        //        $query = Appointment::where('user_id', auth()->id())->get();
        //    }

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

        // return response()->json($events);
        return Inertia::render('Admin/IndexAdmin', [
            'events' => $events
        ]);

    }


    // public function store(Request $request)
    // {
    //     try {
    //         \Log::info('Datos recibidos:', $request->all());

    //         $validated = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'start' => 'required|date',
    //             'end' => 'required|date|after:start',
    //             'description' => 'nullable|string',
    //             // 'category' => 'required|string',
    //             'allDay' => 'nullable|boolean'
    //         ]);

    //         // Convertir fechas a la zona horaria de Google Calendar (GMT+2)
    //         $timezone = 'Europe/Madrid'; // Ajusta según tu zona horaria
    //         $startDateTime = Carbon::parse($validated['start'])->setTimezone($timezone);
    //         $endDateTime = Carbon::parse($validated['end'])->setTimezone($timezone);


    //         // $category = $request->input('category', 'General');
    //         // $calendarId = $this->getCalendarIdForCategory($category);
    //         // $calendarId = config('services.google_calendars.' . $category . '.calendar_id');


    //         //  Creo el evento en Google Calendar
    //         $event = new Event();
    //         $event->name = $validated['title'];
    //         $event->startDateTime = $startDateTime;
    //         $event->endDateTime = $endDateTime;
    //         $event->summary = $validated['title'];
    //         $nuevoEvento = $event->save();

    //         $eventId = $nuevoEvento->id;

    //         // Creo la cita y la guardo en la base de datos
    //         $appointment = Appointment::create([
    //             'title' => $validated['title'],
    //             'start' => $validated['start'],
    //             'end' => $validated['end'],
    //             'user_id' => auth()->id(),
    //             'description' => $validated['description'] ?? null,
    //             'all_day' => $validated['allDay'] ?? false,
    //             'google_calendar_event_id' => $eventId
    //         ]);

    //         $telegram = new Telegram(env('TELEGRAM_BOT_TOKEN'));

    //         // Envio a Telegram
    //         $text = "<b>¡Nueva actividad publicada!</b>\n\n" .
    //             "🏷 <b>Título:</b> " . $request->title . "\n" .
    //             "📝 <b>Descripción:</b> " . $request->desc . "\n\n" .
    //             "🔗 <a href='" . url('/actividades/' . $appointment->id) . "'>Ver actividad en el sitio web</a>";


    //         $telegram->sendMessage([
    //             "chat_id" => env('TELEGRAM_CHAT_ID', ''),
    //             "text" => $text,
    //             "parse_mode" => "HTML"
    //         ]);

    //         return redirect()->route('trainers.pp')->with('success', 'Evento creado correctamente');


    //     } catch (\Exception $e) {
    //         \Log::error('Error completo:', [
    //             'message' => $e->getMessage(),
    //             'file' => $e->getFile(),
    //             'line' => $e->getLine(),
    //             'trace' => $e->getTraceAsString()
    //         ]);
    //         return redirect()->route('trainers.pp')->with('error', 'Error interno del servidor');
    //     }
    // }




    public function store(Request $request)
    {
        // dd($request->all());

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

            // '5fbb7eff33ef2a4b321e01d1485e98fd494fab8f173b5d6cf833f91f4c135d3c@group.calendar.google.com'; dd($calendarId);

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
            ]);

            // Creo la actividad en el calendario
            // $activity = Activity::create([
            //     'name' => $request->title,
            //     'description' => $request->description ?? 'Sin descripción',
            //     'image' => $request->image,
            //     'price' => $request->price,
            //     'start_time' => $request->start,
            //     'end_time' => $request->end,
            //     'date' => $dia,
            //     'slots' => $request->capacity,
            //     // 'capacity' => $request->capacity ?? null,
            //     'category_id' => $category->id,
            //     'user_id' => auth()->id(),
            // ]);

            // // Gestión de la imagen
            // if ($request->hasFile('image')) {

            //     $img = $request->file('image');

            //     $imgName = Str::slug($request->title) . '.' . $img->guessExtension();

            //     $path = public_path('images/activities/');
            //     $img->move($path, $imgName);

            //     $activity->image = $imgName;
            //     $activity->save();
            // }

            // dd($activity);


            DB::insert('INSERT INTO activities (
                name, description, image, price, start_time, end_time, date,
                slots, category_id, user_id, created_at, updated_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $request->title,
                $request->description ?? 'Sin descripción',
                'default.jpg',
                $request->price,
                $request->start,
                $request->end,
                $dia,
                $request->capacity,
                $category->id,
                auth()->id(),
                now(),
                now()
            ]);

            // Luego actualizas la imagen si se subió
            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $imgName = Str::slug($request->title) . '.' . $img->guessExtension();

                $path = public_path('images/activities/');
                $img->move($path, $imgName); // El archivo se guarda físicamente en: public/images/activities/

                // $imagePath = 'images/activities/' . $imgName;


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

            return redirect()->route('trainers.activityCalendar')->with('success', 'Evento actualizado correctamente');

        } catch (\Exception $e) {
            \Log::error('Error al actualizar cita: ' . $e->getMessage());
            return redirect()->route('trainers.activityCalendar')->with('error', 'Error al actualizar el evento');
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

            return redirect()->route('trainers.activityCalendar')->with('success', 'Evento eliminado correctamente');

        } catch (\Exception $e) {
            \Log::error('Error al eliminar cita: ' . $e->getMessage());
            return redirect()->route('trainers.activityCalendar')->with('error', 'Error al eliminar el evento');
        }
    }


    // TODO: para obtener el ID del calendario según categoría

    // private function getCalendarIdForCategory(string $category): ?string
    // {
    //     $calendars = config('services.google_calendars');

    //     return $calendars[$category]['calendar_id'] ?? null;
    // }

}