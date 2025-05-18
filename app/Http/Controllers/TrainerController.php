<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; // Modelo de User
// use App\Models\PersonalizedTraining; // Modelo de PersonalizedTraining
use App\Models\Activity; // Modelo de Activity
use App\Models\Category; // Modelo de Category
use App\Models\Message; // Modelo de Message
use App\Models\UserActivitiesReservations; // Modelo de UserActivitiesReservations
use Illuminate\Support\Facades\Auth; // Facade para autenticación
use Inertia\Inertia; // Facade para Inertia
use App\Models\Post; // Modelo de Post
use Illuminate\Support\Str; // Modelo Str para renombrar la imagen

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
        $trainers = User::where('role', 'trainer')->get()->select(['id', 'name', 'category', 'experience_time', 'description', 'profile_photo_path']);

        // Dependiendo del rol del usuario, se redirige a una pagina diferente
        // switch ($user->role) {
        //     case 'trainer':
        //         return redirect()->route('trainers.index');
        //     case 'admin':
        //         return redirect()->route('admin.index');
        //     case 'user':
        //         return redirect()->route('users.index');

        //     default:
        return inertia('Public/Trainer', ['trainers' => $trainers]);
        // }
    }


    public function trainerView()
    {
        // Verifico el rol del usuario autenticado
        $user = auth()->user();

        // Obtengo informacion del entrenador
        $trainer = User::findOrFail($user->id);

        // Obtengo las actividades del entrenador
        $activities = Activity::where('user_id', $trainer->id)->get();


        if ($user->role === 'trainer') {
            return inertia('Trainer/TrainerIndex', compact('trainer', 'activities'));
        } else {
            return redirect()->route('login');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Obtengo el entrenador con el id
        $trainer = User::findOrFail($id);

        // Obtengo los planes personalizados del entrenador
        // $plans = PersonalizedTraining::where('user_id', $trainer->id)->get();

        //Retornar el entrenador
        return inertia('Trainer/TrainerShow', compact('trainer', 'plans'));
    }


    public function createActivityView()
    {
        // Obtengo todas las categorias
        $categories = Category::all();

        return inertia('Trainer/Options/ActivityCreate', compact('categories'));
    }

    public function storeActivity(Request $request)
    { {
            // dd($request->all());

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
    }


    // RESERVATIONS
    // public function reservations()
    // {
    //     // Obtengo el entrenador con el id
    //     $trainer = User::findOrFail(auth()->id());

    //     // dd($trainer->id);

    //     // $idCategory = Category::where('name', $trainer->category)->first()->id;

    //     // dd($idCategory);

    //     // Obtengo las actividades del entrenador
    //     $activities = Activity::where('user_id', $trainer->id)->get();

    //     dd($activities);

    //     // Obtengo las reservas del entrenador
    //     $reservations = UserActivitiesReservations::where('user_id', $trainer->id)->get();

    //     return inertia('Trainer/TrainerReservations', compact('activities', 'reservations'));
    // }


    public function reservations(Request $request)
    {
        // 1. Obtener el ID del entrenador autenticado
        $trainerId = auth()->id();

        // 2. Obtener las actividades que ha creado este entrenador
        // $activities = Activity::where('user_id', $trainerId)
        //     ->orderBy('date', 'desc')
        //     ->orderBy('start_time', 'desc')
        //     ->get();

        $activities = Activity::where('user_id', $trainerId)
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->paginate(10)
            ->withQueryString();

        // 3. Obtener las reservas para estas actividades
        // $reservations = UserActivitiesReservations::whereIn('activity_id', $activities->pluck('id'))
        //     ->with('user') // Opcional: si necesitas datos del usuario
        //     ->get();
        $reservationIds = $activities->pluck('id');
        $reservations = UserActivitiesReservations::whereIn('activity_id', $reservationIds)
            ->with('user')
            ->get();

        // 4. Pasar los datos a la vista
        return inertia('Trainer/TrainerReservations', [
            'activities' => $activities,
            'reservations' => $reservations,
            'filters' => $request->only(['search'])
        ]);
    }


    // Personalized Training
    public function personalizedTraining()
    {
        // Obtengo los planes personalizados del entrenador
        // $plans = PersonalizedTraining::where('user_id', auth()->id())->get();

        return inertia('Trainer/TrainerPPlans');
    }

    public function createPersonalizedTraining()
    {
        return inertia('Trainer/Options/PersonalizedTrainingCreate');
    }

    // Crear un plan personalizado PUBLICO
    public function storePlan(Request $request)
    {
        // dd($request->all());
        // Validar los datos $request->validate([]);

        // Crear el plan
        // $plan = PersonalizedTraining::create([
        //     // 'name' => $request['name'],
        //     'user_id' => auth()->id(),
        //     'description' => $request['description'],
        //     'price' => $request['price'],
        //     'status' => 'approved',
        // ]);

        // Retornar una respuesta exitosa
        return redirect()->route('trainers.pp');
    }

    // POSTS

    // public function trainerPostsView()
    // {
    //     $posts = Post::query()
    //         ->where('user_id', auth()->id()) // Por el trainer autenticado
    //         ->when(request('search'), function ($query, $search) {
    //             $query->where(function ($q) use ($search) {
    //                 $q->where('title', 'like', '%' . $search . '%')
    //                     ->orWhere('content', 'like', '%' . $search . '%');
    //             });
    //         })
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(10)
    //         ->appends(['search' => request('search')]);


    //     // dd($posts->toArray());

    //     $totalPosts = Post::where('user_id', auth()->id())->count();

    //     return inertia('Trainer/TrainerPosts', [
    //         'posts' => $posts,
    //         'filters' => ['search' => request('search')],
    //         'totalPosts' => $totalPosts
    //     ]);
    // }

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

    public function storePost(Request $request)
    {

        // dd($request->all());

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
    public function trainerMessagesView()
    {
        // return inertia('Trainer/TrainerMessages');
        $users = User::where('id', '!=', Auth::user()->id)
            ->where(function ($query) {
                $query->where('role', 'trainer')
                    ->orWhere('role', 'admin');
            })
            ->get();


        return Inertia::render('Trainer/TrainerMessages', ['users' => $users]);
    }
}