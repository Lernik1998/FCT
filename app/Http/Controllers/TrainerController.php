<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; // Modelo de User
use App\Models\Activity; // Modelo de Activity
use App\Models\Category; // Modelo de Category
use App\Models\UserActivitiesReservations; // Modelo de UserActivitiesReservations
use Illuminate\Support\Facades\Auth; // Facade para autenticación
use Inertia\Inertia; // Facade para Inertia
use App\Models\Post; // Modelo de Post
use Illuminate\Support\Str; // Modelo Str para renombrar la imagen
use App\Models\ContactMessage; // Modelo de ContactMessage

class TrainerController extends Controller
{
    /**
     * Entrenadores publicos
     */
    public function index()
    {
        // Verifico el rol del usuario autenticado
        $user = auth()->user();

        // Obtengo todos los entrenadores
        $trainers = User::where('role', 'trainer')
            ->where('is_active', 1)
            ->get()->select(['id', 'name', 'category', 'experience_time', 'description', 'image']);


        return inertia('Public/Trainer', ['trainers' => $trainers]);
    }

    // Vista del entrenador
    public function trainerView()
    {
        // Verifico el rol del usuario autenticado
        $user = auth()->user();

        // Obtengo informacion del entrenador
        $trainer = User::findOrFail($user->id);

        // Obtengo las actividades del entrenador
        $activities = Activity::where('user_id', $trainer->id)->get();

        // Verifico si el entrenador ya ha mandado la solicitud de categoría
        $contactMessage = ContactMessage::where('trainer_id', $trainer->id)->first();

        if ($contactMessage) {
            $categoryRequest = 1;
        } else {
            $categoryRequest = 0;
        }


        if ($user->role === 'trainer') {
            return inertia('Trainer/TrainerIndex', compact('trainer', 'activities', 'categoryRequest'));
        } else {
            return redirect()->route('login');
        }
    }

    // Crear actividad vista
    public function createActivityView()
    {
        // Obtengo todas las categorias
        $categories = Category::all();

        return inertia('Trainer/Options/ActivityCreate', compact('categories'));
    }

    // Crear actividad (formulario)
    public function storeActivity(Request $request)
    {
        // Validar los datos
        $request->validate([]);

        // Crear la actividad
        $activity = Activity::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $request['image'],  // Guardamos la ruta, no el archivo
            'price' => $request['price'],
            'duration' => $request['duration'],
            'date' => $request['date'],
            'user_id' => auth()->id(),
            'category_id' => $request['category_id'],
        ]);

        // Retornar una respuesta exitosa
        return redirect()->route('trainers.index');
    }

    // Reservas del entrenador
    public function reservations(Request $request)
    {
        // Obtenego el ID del entrenador autenticado
        $trainerId = auth()->id();

        // Obtengo las actividades que ha creado este entrenador
        $activities = Activity::where('user_id', $trainerId)
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->where('status', '!=', 'inactive')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->paginate(10)
            ->withQueryString();

        // Obtengo las reservas para estas actividades
        $reservationIds = $activities->pluck('id');
        $reservations = UserActivitiesReservations::whereIn('activity_id', $reservationIds)
            ->with('user')
            ->get();

        // Paso los datos a la vista
        return inertia('Trainer/TrainerReservations', [
            'activities' => $activities,
            'reservations' => $reservations,
            'filters' => $request->only(['search'])
        ]);
    }


    // Apartado de Actividades con el calendario
    public function activityCalendar()
    {
        // Obtengo los planes personalizados del entrenador
        // $plans = PersonalizedTraining::where('user_id', auth()->id())->get();

        // $categories = Category::where('name', '!=', 'General')->get();

        return inertia('Trainer/TrainerActivityCalendar');
    }


    // POSTS

    // Vista de los posts del entrenador
    public function trainerPostsView()
    {
        $posts = Post::query()
            ->where('user_id', auth()->id()) // Por el trainer autenticado
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends(['search' => request('search')]);

        $totalPosts = Post::where('user_id', auth()->id())->count();

        // Obtener posts por mes del año actual
        $monthlyPosts = Post::where('user_id', auth()->id())
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        // Rellenar todos los meses (incluso aquellos sin posts)
        $monthlyData = array_fill(1, 12, 0);
        foreach ($monthlyPosts as $month => $count) {
            $monthlyData[$month] = $count;
        }

        return inertia('Trainer/TrainerPosts', [
            'posts' => $posts,
            'filters' => ['search' => request('search')],
            'totalPosts' => $totalPosts,
            'monthlyPosts' => array_values($monthlyData) // Convertir a array indexado (1-12 => 0-11)
        ]);
    }

    // Crear post
    public function storePost(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'user_id' => auth()->id(),
        ]);


        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = Str::slug($request->title) . '.' . $img->guessExtension();

            $path = public_path('images/posts/');
            $img->move($path, $imgName);

            $post->image = $imgName;
            $post->save();
        }

        return redirect()->route('trainers.posts');
    }

    // Borrar post
    public function deletePost($id)
    {
        // Buscar el post
        $post = Post::findOrFail($id);
        $post->delete();

        // Borrar la imagen
        if ($post->image) {
            $path = public_path('images/posts/' . $post->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        return redirect()->route('trainers.posts');
    }

    // Actualizar post
    public function updatePost(Request $request, $id)
    {

        // dd($request->all(), $id);
        $post = Post::findOrFail($id);

        // Actualizar título y contenido
        $post->title = $request->title;
        $post->content = $request->content;


        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($post->image) {
                $oldPath = public_path('images/posts/' . $post->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Guardar nueva imagen
            $img = $request->file('image');
            $imgName = Str::slug($request->title) . '.' . $img->guessExtension();

            $path = public_path('images/posts/');
            $img->move($path, $imgName);

            $post->image = $imgName;
        }

        $post->save();

        return redirect()->route('trainers.posts');
    }

    // MENSAJES

    // Vista de los mensajes del entrenador
    public function trainerMessagesView()
    {
        $users = User::where('id', '!=', Auth::user()->id)
            ->where(function ($query) {
                $query->where('role', 'trainer')
                    ->orWhere('role', 'admin');
            })
            ->get();

        return Inertia::render('Trainer/TrainerMessages', ['users' => $users]);
    }
}