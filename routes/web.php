<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserActivitiesReservationsController;

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


// TRAINERS routes
Route::controller(TrainerController::class)->group(function () {

    // Crear actividad vista
    Route::get('trainers/createActivity', [TrainerController::class, 'createActivityView'])->name('trainers.createActivity');

    Route::post('trainers/storeActivity', [TrainerController::class, 'storeActivity'])->name('trainers.storeActivity');

    // Gestión de Payments

    Route::get('trainers/payments', [TrainerController::class, 'payments'])->name('trainers.payments');

    // Planes personalizados
    Route::get('trainers/personalizedTraining', [TrainerController::class, 'personalizedTraining'])->name('trainers.pp');

    // Creación de un plan personalizado por el trainer
    Route::get('trainers/createPlan', [TrainerController::class, 'createPersonalizedTraining'])->name('trainers.createPlan');

    // Crear un plan personalizado PUBLICO
    Route::post('trainers/storePlan', [TrainerController::class, 'storePlan'])->name('trainers.storePlan');

    // Posts del Trainer
    Route::get('trainers/posts', [TrainerController::class, 'trainerPostsView'])->name('trainers.posts');

    // MENSAJES
    Route::get('trainers/messages', [TrainerController::class, 'trainerMessagesView'])->name('trainers.messages');

    Route::resource('trainers', TrainerController::class);
});


// USER routes
Route::controller(UserController::class)->group(function () {
    Route::resource('users', UserController::class);
    // Lo sustituyo por un inertia porque solo sirvo una vista, porque por ahora no uso para nada más el controlador

    Route::get('user/stats', [UserController::class, 'stats'])->name('users.stats');

    // Reservas y pagos de las Actividades
    Route::get('user/activityShow/{id}', [ActivityController::class, 'showUserActivity'])->name('activities.showUserActivity');

    // Route::get('user/reserve/{id}', [ActivityController::class, 'reserveActivity'])->name('activities.reserve');
    // Route::post('/activities/{id}/pay', [ActivityController::class, 'payForActivity'])->name('activities.pay');

    // Reservas 
    Route::resource('userActivitiesReservations', UserActivitiesReservationsController::class);

    // Route::get('userActivitiesReservations/{id}/pay', [UserActivitiesReservationsController::class, 'showPayForActivity'])->name('userActivitiesReservations.showPayForActivity');

    // Previo al pago
    Route::get('UAR/{id}/showPay', [UserActivitiesReservationsController::class, 'showPayForActivity'])->name('userActivitiesReservations.showPayForActivity');

    // Gestión de pago
    Route::post('UAR/{id}/pay', [UserActivitiesReservationsController::class, 'payForActivity'])->name('userActivitiesReservations.payForActivity');

    // Reservas y pagos de las Actividades con el controlador de UserActivitiesReservations
    Route::get('user/reserve/{id}', [UserActivitiesReservationsController::class, 'create'])->name('userActivitiesReservations.create');


    // PAYPAL
    // Gestión de pago
    Route::post('UAR/{id}/payPaypal', [UserActivitiesReservationsController::class, 'payForActivityWithPaypal'])->name('userActivitiesReservations.payForActivityWithPaypal');
});


// ADMIN routes
Route::controller(AdminController::class)->group(function () {
    // RESPETAR EL NOMBRE DE LA RUTA PARA PODER ACCEDER

    // ACTIVITY
    Route::get('admin/activityAdmin', [AdminController::class, 'activityAdmin'])->name('admin.activityAdmin');

    Route::get('admin/createActivityView', [AdminController::class, 'createActivityView'])->name('admin.createActivityView');

    Route::post('admin/createActivity', [AdminController::class, 'storeActivity'])->name('admin.storeActivity');

    Route::get('admin/activityShow/{id}', [AdminController::class, 'showActivity'])->name('admin.activityShow');

    Route::get('admin/editActivity/{id}', [AdminController::class, 'editActivityView'])->name('admin.activityEdit');

    // Route::put('admin/updateActivity/{id}', [AdminController::class, 'updateActivity'])->name('admin.updateActivity');

    Route::delete('admin/deleteActivity/{id}', [AdminController::class, 'destroyActivity'])->name('admin.activityDestroy');

    // Gestión de USER

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


// Por ahora lo pongo aquí

Route::get('/inbox', [MessageController::class, 'inbox'])->name('inbox');
Route::post('/message/{user}', [MessageController::class, 'store'])->name('message.store');
Route::get('/message/{user}', [MessageController::class, 'show'])->name('message.show');