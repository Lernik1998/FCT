<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;
use Exception;
use Log;

class SocialiteController extends Controller
{
    // REDIRECT TO GOOGLE
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    // CALLBACK FROM GOOGLE
    public function googleCallback()
    {
        try {
            $userGoogle = Socialite::driver('google')->user();

            $user = User::where('google_id', $userGoogle->id)->first(); // Verificar si el usuario ya existe compribando el ID que devuelve Google

            // Si el usuario existe
            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                // Si el usuario no existe
                $newUser = User::create([
                    'name' => $userGoogle->name,
                    'email' => $userGoogle->email,
                    'google_id' => $userGoogle->id,
                    'role' => 'user',
                    'password' => encrypt('password'),
                    'is_active' => true,
                    'current_team_id' => '1'

                ]);

                if ($newUser) {
                    Auth::login($newUser);
                    return redirect()->route('dashboard');
                }
            }

            // dd($userGoogle);   
        } catch (Exception $e) {
            Log::error('Error en Google Callback: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'No se pudo iniciar sesión con Google.');

        }
    }
}
