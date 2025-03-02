<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;

/* Route::get('/', function () {
return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
]);
return Inertia::render('Index'); es lo mismo que return inertia('Index');
    return inertia('Index');
});*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});



// PUBLIC routes
Route::inertia('/', 'Index')->name('index'); // Carga la vista Index (ENTRADA APP)
// Route::inertia('publicTrainers', 'Public/Trainer')->name('trainers.public');
Route::inertia('/contact', 'Public/Contact')->name('contact');


Route::resource('activities', ActivityController::class);

Route::resource('trainers', TrainerController::class);

Route::resource('users', UserController::class);
// Lo sustituyo por un inertia porque solo sirvo una vista, porque por ahora no uso para nada más el controlador

// Route::inertia('users', 'User/UserIndex')->name('users');

// ADMIN routes
Route::controller(AdminController::class)->group(function () {
    // RESPETAR EL NOMBRE DE LA RUTA PARA PODER ACCEDER

    // USER

    // Eliminar user
    Route::delete('admin/destroyUser/{id}', [AdminController::class, 'destroyUser'])->name('admin.destroyUser');

    // Mostrar user
    Route::get('admin/userShow/{id}', [AdminController::class, 'showUser'])->name('admin.userShow');

    // Mostrar todos los user al Admin
    Route::get('admin/userAdmin', [AdminController::class, 'userAdmin'])->name('admin.userAdmin');

    // Acceso a la vista de crear un usuario
    Route::get('admin/createUserView', [AdminController::class, 'createUserView'])->name('admin.createUserView');

    // Crear user
    Route::post('admin/createUser', [AdminController::class, 'createUser'])->name('admin.createUser');

    // Editar user vista con el formulario
    Route::get('admin/editUser/{id}', [AdminController::class, 'editUserView'])->name('admin.editUser');

    // Actualizar user
    Route::put('admin/updateUser/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');


    // TRAINER
    Route::get('admin/trainerAdmin', [AdminController::class, 'trainerAdmin'])->name('admin.trainerAdmin');
    Route::resource('admin', AdminController::class);
});




// Google
Route::controller(SocialiteController::class)->group(function () {
    Route::get('/auth/google', 'googleLogin')->name('auth.google');
    Route::get('/auth/google-callback', 'googleCallback')->name('auth.google-callback');
});


// PENDIENTE
// Route::inertia('/about', 'About')->name('about');

// Route::inertia('/noticias', 'Noticias')->name('noticias');
// Route::inertia('/eventos', 'Eventos')->name('eventos');
