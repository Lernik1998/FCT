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
use App\Http\Controllers\MembershipController;
// use Spatie\GoogleCalendar\Event;
use App\Http\Middleware\TranslationsMiddleware;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Auth;
use App\Mail\ReservationPayment;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        if (Auth::user()->role === 'user') {
            return redirect()->route('users.index');
        } else if (Auth::user()->role === 'trainer') {
            return redirect()->route('trainers.trainerView');
        } else if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.index');
        }

        return Inertia::render('Dashboard');
    })->name('dashboard');

});


// PAYMENTS
Route::get('/checkout/{name}', [StripeController::class, 'checkout'])->name('stripe.checkout');

Route::get('/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');


Route::middleware(TranslationsMiddleware::class)->group(function () {
    // PUBLIC routes
    Route::inertia('/', 'Index')->name('index'); // Entrada
// Route::inertia('publicTrainers', 'Public/Trainer')->name('trainers.public');
    Route::inertia('/contact', 'Public/Contact')->name('contact');

    // Route::get('trainers', [TrainerController::class, 'index'])->name('trainers.index');

    Route::resource('activities', ActivityController::class);
    Route::resource('posts', PostController::class);
    // Mensaje contacto sin registro --> DESDE QUE CONTROLADOR SE DEBERÍA DE HACER? CONTROLADOR PUBLIC???
    Route::post('contact', [AdminController::class, 'unregisteredUserMessage'])->name('admin.unregisteredUserMessage');

    Route::inertia('empezarAhora', 'Public/BeforeStart')->name('beforeStart');
    Route::inertia('bodyChanges', 'Public/BodyChanges')->name('bodyChanges');
    Route::inertia('firstClass', 'Public/FirstClass')->name('firstClass');
});

// Gestión de idioma
Route::get('/language/{language}', function ($language) {
    Session::put('locale', $language);
    return redirect()->back();
})->name('language');


Route::middleware(['auth', 'verified', 'role:user'])->group(function () {

    // USER routes
    Route::controller(UserController::class)->group(function () {
        Route::resource('users', UserController::class);
        // Lo sustituyo por un inertia porque solo sirvo una vista, porque por ahora no uso para nada más el controlador

        Route::get('user/stats', [UserController::class, 'stats'])->name('users.stats');

        // Reservas y pagos de las Actividades
        Route::get('user/activityShow/{id}', [ActivityController::class, 'showUserActivity'])->name('activities.showUserActivity');


        /************************************** RESERVATIONS ************************************** */

        // Route::get('user/reserve/{id}', [ActivityController::class, 'reserveActivity'])->name('activities.reserve');
        // Route::post('/activities/{id}/pay', [ActivityController::class, 'payForActivity'])->name('activities.pay');

        // Reservas 
        Route::resource('userActivitiesReservations', UserActivitiesReservationsController::class);


        /************************************** PAYMENT ************************************** */

        // Previo al pago
        // Route::get('userActivitiesReservations/{id}/pay', [UserActivitiesReservationsController::class, 'showPayForActivity'])->name('userActivitiesReservations.showPayForActivity');

        // Route::get('UAR/{id}/showPay', [UserActivitiesReservationsController::class, 'showPayForActivity'])->name('userActivitiesReservations.showPayForActivity');

        // Gestión de pago
        Route::post('UAR/{id}/pay', [UserActivitiesReservationsController::class, 'payForActivity'])->name('userActivitiesReservations.payForActivity');

        // Reservas y pagos de las Actividades con el controlador de UserActivitiesReservations
        Route::get('user/reserve/{id}', [UserActivitiesReservationsController::class, 'create'])->name('userActivitiesReservations.create');

        // Gestión de pago
        Route::post('UAR/{id}/payPaypal', [UserActivitiesReservationsController::class, 'payForActivityWithPaypal'])->name('userActivitiesReservations.payForActivityWithPaypal');

        // FIXME:

        Route::get('/payment/success/{activity}', [UserActivitiesReservationsController::class, 'paymentSuccess'])
            ->name('payment.success');

        /************************************** MEMBERSHIP ************************************** */

        Route::resource('user/membership', MembershipController::class);

        Route::post('stripe/cancel', [StripeController::class, 'cancelMembership'])->name('stripe.cancel');


        /************************************** TELEGRAM ************************************** */

        // Telegram TODO:
        Route::get('user/telegram', [UserActivitiesReservationsController::class, 'telegram'])->name('user.telegram');
    });

});


Route::middleware(['auth', 'verified', 'role:trainer'])->group(function () {

    // TRAINERS routes
    Route::controller(TrainerController::class)->group(function () {

        /************************************** ACTIVIDADES ************************************** */
        // Crear actividad vista
        Route::get('trainers/createActivity', [TrainerController::class, 'createActivityView'])->name('trainers.createActivity');

        Route::post('trainers/storeActivity', [TrainerController::class, 'storeActivity'])->name('trainers.storeActivity');

        /************************************** PAYMENTS ************************************** */

        Route::get('trainers/payments', [TrainerController::class, 'reservations'])->name('trainers.reservations');

        /************************************** PLANES PERSONALIZADOS ************************************** */

        Route::get('trainers/activityCalendar', [TrainerController::class, 'activityCalendar'])->name('trainers.activityCalendar');

        // Creación de un plan personalizado por el trainer
        Route::get('trainers/createPlan', [TrainerController::class, 'createPersonalizedTraining'])->name('trainers.createPlan');

        // Crear un plan personalizado PUBLICO
        Route::post('trainers/storePlan', [TrainerController::class, 'storePlan'])->name('trainers.storePlan');

        /************************************** POSTS ************************************** */

        Route::get('trainers/posts', [TrainerController::class, 'trainerPostsView'])->name('trainers.posts');

        Route::post('trainers/storePost', [TrainerController::class, 'storePost'])->name('trainers.storePost');

        Route::delete('trainers/deletePost/{id}', [TrainerController::class, 'deletePost'])->name('trainers.deletePost');

        Route::put('trainers/posts/{id}', [TrainerController::class, 'updatePost'])->name('trainers.updatePost');

        /************************************** MENSAJES ************************************** */
        Route::get('trainers/messages', [TrainerController::class, 'trainerMessagesView'])->name('trainers.messages');

        Route::post('admin/sendReplyUnregisteredUser', [AdminController::class, 'sendReplyUnregisteredUser'])->name('admin.sendReplyUnregisteredUser');

        Route::post('admin/markAsAssigned', [AdminController::class, 'markAsAssigned'])->name('admin.markAsAssigned');

        Route::get('trainers/trainerView', [TrainerController::class, 'trainerView'])->name('trainers.trainerView');


    });

});

Route::resource('trainers', TrainerController::class);

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::controller(AdminController::class)->group(function () {

        /************************************** ACTIVIDADES ************************************** */

        Route::get('admin/activityAdmin', [AdminController::class, 'activityAdmin'])->name('admin.activityAdmin');

        Route::get('admin/createActivityView', [AdminController::class, 'createActivityView'])->name('admin.createActivityView');

        Route::post('admin/createActivity', [AdminController::class, 'storeActivity'])->name('admin.storeActivity');

        Route::get('admin/activityShow/{id}', [AdminController::class, 'showActivity'])->name('admin.activityShow');

        Route::get('admin/editActivity/{id}', [AdminController::class, 'editActivityView'])->name('admin.activityEdit');

        Route::delete('admin/deleteActivity/{id}', [AdminController::class, 'destroyActivity'])->name('admin.activityDestroy');

        Route::put('admin/updateActivity/{id}', [AdminController::class, 'updateActivity'])->name('admin.updateActivity');

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
        Route::put('admin/trainers/createActivity/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');

        /************************************** GESTIÓN DE ENTRENADORES ************************************** */
        Route::get('admin/trainerAdmin', [AdminController::class, 'trainerAdmin'])->name('admin.trainerAdmin');

        Route::get('admin/trainerShow/{id}', [AdminController::class, 'trainerShow'])->name('admin.trainerShow');

        Route::get('admin/editTrainer/{id}', [AdminController::class, 'editTrainerView'])->name('admin.editTrainer');

        Route::put('admin/updateTrainer/{id}', [AdminController::class, 'updateTrainer'])->name('admin.updateTrainer');

        Route::get('admin/createTrainerView', [AdminController::class, 'createTrainerView'])->name('admin.createTrainerView');

        Route::post('admin/createTrainer', [AdminController::class, 'createTrainer'])->name('admin.createTrainer');

        /************************************** GESTIÓN DE INFORMACIÓN(Mensajes) ************************************** */

        // Mensajes con los trainers
        Route::get('admin/messageAdmin', [AdminController::class, 'adminMessagesView'])->name('admin.messageAdmin');

        Route::get('admin/informationAdmin', [AdminController::class, 'informationAdmin'])->name('admin.informationAdmin');

        Route::post('admin/asignCategory/{id}', [AdminController::class, 'asignCategory'])->withoutMiddleware('role:admin')->name('admin.asignCategory');

        Route::post('admin/markAsDone/{id}', [AdminController::class, 'markAsDone'])->name('admin.markAsDone');


        // Contact
        // Route::get('admin/contactAdmin', [AdminController::class, 'contactAdmin'])->name('admin.contactAdmin');

        // Route::post('admin/contactAdmin', [AdminController::class, 'contactAdmin'])->name('admin.contactAdmin');

        /************************************** GESTIÓN DE SUSCRIPTIONS ************************************** */
        Route::get('admin/subscriptionAdmin', [AdminController::class, 'subscriptionAdmin'])->name('admin.subscriptionAdmin');

        Route::get('admin/createMembershipView', [AdminController::class, 'createMembershipView'])->name('admin.createMembershipView');

        Route::post('admin/createMembership', [AdminController::class, 'storeMembership'])->name('admin.storeMembership');

        Route::delete('admin/deleteMembership/{id}', [AdminController::class, 'destroyMembership'])->name('admin.destroyMembership');

        Route::get('admin/membershipReservations', [AdminController::class, 'getMemberships'])->name('admin.membershipReservations');

        Route::get('admin/paymentOptions/{name}', [AdminController::class, 'paymentOptions'])->name('admin.paymentOptions');

        Route::post('admin/cancelSubscription/{name}', [AdminController::class, 'cancelSubscription'])->name('admin.cancelSubscription');

        Route::post('admin/reactivateSubscription/{name}', [AdminController::class, 'reactivateSubscription'])->name('admin.reactivateSubscription');

        /************************************** GESTIÓN DE TRANSACTIONS ************************************** */
        Route::get('transactions', [AdminController::class, 'administrationAdmin'])->name('admin.transactions');
        Route::post('transactions', [AdminController::class, 'storeTransaction'])->name('admin.transactions.store');
        Route::get('transactions/export', [AdminController::class, 'exportToCsv'])->name('admin.transactions.export');


        Route::resource('admin', AdminController::class); // Siempre al final
    });
});

// Google
Route::controller(SocialiteController::class)->group(function () {
    Route::get('/auth/google', 'googleLogin')->name('auth.google');
    Route::get('/auth/google-callback', 'googleCallback')->name('auth.google-callback');
});

/************************************** CALENDARIO GENERAL ************************************** */
// Google Calendar
// Route::get('/appointments', [AppointmentController::class, 'index'])->name('calendar.index');
// Route::get('/appointments/list', [AppointmentController::class, 'list'])->name('appointments.list');
// Route::post('/appointmentsStore', [AppointmentController::class, 'store'])->name('appointments.store');
// Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
// Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

// //FIXME: Por ahora lo pongo aquí
// Route::get('/inbox', [MessageController::class, 'inbox'])->name('inbox');
// Route::post('/message/{user}', [MessageController::class, 'store'])->name('message.store');
// Route::get('/message/{user}', [MessageController::class, 'show'])->name('message.show');


Route::middleware(['auth', 'verified', 'roleAdminOrTrainer'])->group(function () {
    // Rutas del calendario accesibles para admin y trainer


    Route::get('/appointments/list', [AppointmentController::class, 'list'])->name('appointments.list');
    Route::post('/appointmentsStore', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    //FIXME: Por ahora lo pongo aquí
    Route::get('/inbox', [MessageController::class, 'inbox'])->name('inbox');
    Route::post('/message/{user}', [MessageController::class, 'store'])->name('message.store');
    Route::get('/message/{user}', [MessageController::class, 'show'])->name('message.show');
});

