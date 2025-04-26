<?php

namespace App\Helpers;

class CalendarChangeHelper
{
    // public static function getCalendarIdByCategoryName($categoryName)
    // {
    //     $googleCalendars = config('google_calendars');

    //     // Verificar si el nombre de la categoría existe en el array
    //     if (array_key_exists($categoryName, $googleCalendars)) {
    //         return $googleCalendars[$categoryName];
    //     }

    //     return null; // Si no existe la categoría, devuelve null
    // }

    public static function getCalendarIdByCategoryName($category)
    {
        // dd($category);

        $googleCalendars = config('google_calendars');  // Obtén la configuración cargada

        // dd(config('google_calendars'));

        return $googleCalendars[$category] ?? null;  // Devuelve el valor o null si no se encuentra
    }


    public static function getAllCategoryCalendars(): array
    {
        return config('google_calendars');
    }
}
