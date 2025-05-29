<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Redirección después del login
        $this->app->singleton(LoginResponse::class, function () {
            return new class implements LoginResponse {
                // Gestión de redirección después del login
                public function toResponse($request)
                {
                    // Obtenemos el usuario autenticado
                    $user = Auth::user();

                    // Redirección después del login
                    switch ($user->role) {
                        case 'admin':
                            return redirect()->route('admin.index');
                        case 'user':
                            return redirect()->route('users.index');
                        case 'trainer':
                            return redirect()->route('trainers.trainerView');
                    }

                    return redirect()->route('index'); // Ruta por defecto
                }
            };
        });


        $this->app->singleton(RegisterResponse::class, function () {
            return new class implements RegisterResponse {
                // Gestión de redirección después del registro
                public function toResponse($request)
                {
                    // Obtenemos el usuario autenticado
                    $user = Auth::user();

                    // Si no hay usuario, forzamos vista login
                    if (!$user) {
                        return redirect()->route('login');
                    }

                    // Si el usuario no tiene un rol, le asignamos uno por defecto
                    if (!$user->role) {
                        $user->role = 'user'; // Rol de usuario
                        $user->save(); // Guardamos 
                    }

                    // Redirección después del registro
                    switch ($user->role) {
                        case 'admin':
                            return redirect()->route('admin.index');
                        case 'user':
                            return redirect()->route('users.index');
                        case 'trainer':
                            return redirect()->route('trainers.trainerView');
                    }

                    return redirect()->route('index'); // Ruta por defecto
                }
            };
        });


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
