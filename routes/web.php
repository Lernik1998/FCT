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
use App\Http\Controllers\PostController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\GoogleCalendarController;
use Spatie\GoogleCalendar\Event;

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

Route::resource('posts', PostController::class);

// Mensaje contacto sin registro --> DESDE QUE CONTROLADOR SE DEBERÍA DE HACER? CONTROLADOR PUBLIC???
Route::post('contact', [AdminController::class, 'unregisteredUserMessage'])->name('admin.unregisteredUserMessage');


// TRAINERS routes
Route::controller(TrainerController::class)->group(function () {

    /************************************** ACTIVIDADES ************************************** */
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

    /************************************** MENSAJES ************************************** */
    Route::get('trainers/messages', [TrainerController::class, 'trainerMessagesView'])->name('trainers.messages');

    Route::post('admin/sendReplyUnregisteredUser', [AdminController::class, 'sendReplyUnregisteredUser'])->name('admin.sendReplyUnregisteredUser');

    Route::post('admin/markAsAssigned', [AdminController::class, 'markAsAssigned'])->name('admin.markAsAssigned');

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

    /************************************** PAYMENT ************************************** */
    // Previo al pago
    Route::get('UAR/{id}/showPay', [UserActivitiesReservationsController::class, 'showPayForActivity'])->name('userActivitiesReservations.showPayForActivity');

    // Gestión de pago
    Route::post('UAR/{id}/pay', [UserActivitiesReservationsController::class, 'payForActivity'])->name('userActivitiesReservations.payForActivity');

    // Reservas y pagos de las Actividades con el controlador de UserActivitiesReservations
    Route::get('user/reserve/{id}', [UserActivitiesReservationsController::class, 'create'])->name('userActivitiesReservations.create');

    // Gestión de pago
    Route::post('UAR/{id}/payPaypal', [UserActivitiesReservationsController::class, 'payForActivityWithPaypal'])->name('userActivitiesReservations.payForActivityWithPaypal');

    // Telegram TODO:
    Route::get('user/telegram', [UserActivitiesReservationsController::class, 'telegram'])->name('user.telegram');
});


Route::controller(AdminController::class)->group(function () {

    /************************************** ACTIVIDADES ************************************** */
    Route::get('admin/activityAdmin', [AdminController::class, 'activityAdmin'])->name('admin.activityAdmin');

    Route::get('admin/createActivityView', [AdminController::class, 'createActivityView'])->name('admin.createActivityView');

    Route::post('admin/createActivity', [AdminController::class, 'storeActivity'])->name('admin.storeActivity');

    Route::get('admin/activityShow/{id}', [AdminController::class, 'showActivity'])->name('admin.activityShow');

    Route::get('admin/editActivity/{id}', [AdminController::class, 'editActivityView'])->name('admin.activityEdit');

    // Route::put('admin/updateActivity/{id}', [AdminController::class, 'updateActivity'])->name('admin.updateActivity');

    Route::delete('admin/deleteActivity/{id}', [AdminController::class, 'destroyActivity'])->name('admin.activityDestroy');

    /************************************** GESTIÓN DE USUARIOS ************************************** */

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


    /************************************** GESTIÓN DE ENTRENADORES ************************************** */
    Route::get('admin/trainerAdmin', [AdminController::class, 'trainerAdmin'])->name('admin.trainerAdmin');

    /************************************** GESTIÓN DE INFORMACIÓN(Mensajes) ************************************** */

    // Mensajes con los trainers
    Route::get('admin/messageAdmin', [AdminController::class, 'adminMessagesView'])->name('admin.messageAdmin');

    Route::get('admin/informationAdmin', [AdminController::class, 'informationAdmin'])->name('admin.informationAdmin');


    // Contact
    // Route::get('admin/contactAdmin', [AdminController::class, 'contactAdmin'])->name('admin.contactAdmin');

    // Route::post('admin/contactAdmin', [AdminController::class, 'contactAdmin'])->name('admin.contactAdmin');


    Route::resource('admin', AdminController::class); // Siempre al final
});


// Google
Route::controller(SocialiteController::class)->group(function () {
    Route::get('/auth/google', 'googleLogin')->name('auth.google');
    Route::get('/auth/google-callback', 'googleCallback')->name('auth.google-callback');
});

// Google Calendar
// Route::get('/appointments', [AppointmentController::class, 'index'])->name('calendar.index');
Route::get('/appointments/list', [AppointmentController::class, 'list'])->name('appointments.list');
Route::post('/appointmentsStore', [AppointmentController::class, 'store'])->name('appointments.store');
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
// Test de conexión con Google Calendar
Route::post('/test-google', [GoogleCalendarController::class, 'testConnection'])->name('test-google');

// Route::get('/test-google', [GoogleCalendarController::class, 'testConnection']);


// Route::get('/test-google', function () {
// $e = Event::get();
// $e = $e[0];
//     $event = new Event();

//     $event->name = "Test Event";
//     $event->startDateTime = now();
//     $event->endDateTime = now()->addHours(2);
//     $event->summary = 'Test Event';
//     $event->save();

//     $e = Event::get();
//     dd($e);
// });

// PENDIENTE
// Route::inertia('/eventos', 'Eventos')->name('eventos');


// Por ahora lo pongo aquí

Route::get('/inbox', [MessageController::class, 'inbox'])->name('inbox');
Route::post('/message/{user}', [MessageController::class, 'store'])->name('message.store');
Route::get('/message/{user}', [MessageController::class, 'show'])->name('message.show');