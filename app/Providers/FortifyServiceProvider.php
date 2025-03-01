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

                public function toResponse($request)
                {
                    $user = Auth::user();

                    switch ($user->role) {
                        case 'admin':
                            return redirect()->route('admin.index');
                        case 'user':
                            return redirect()->route('users.index');
                        case 'trainer':
                            return redirect()->route('trainers.index');
                    }

                    return redirect()->route('index'); // Ruta por defecto
                }
            };
        });


        $this->app->singleton(RegisterResponse::class, function () {
            return new class implements RegisterResponse {
                public function toResponse($request)
                {
                    $user = Auth::user(); // Verificamos si realmente hay un usuario autenticado

                    if (!$user) {
                        return redirect()->route('login'); // Si no hay usuario, forzamos login
                    }

                    // dd($user); --> DEBUG

                    // Si el usuario no tiene un rol, le asignamos uno por defecto
                    if (!$user->role) {
                        $user->role = 'user'; // Puedes cambiar 'user' por el rol predeterminado
                        $user->save(); // Guardamos el cambio en la base de datos
                    }

                    switch ($user->role) {
                        case 'admin':
                            return redirect()->route('admin.index');
                        case 'user':
                            return redirect()->route('users.index');
                        case 'trainer':
                            return redirect()->route('trainers.index');
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
