<?php

namespace App\Helpers;

class CalendarChangeHelper
{
    // Método para obtener el ID del calendario por nombre de categoría
    public static function getCalendarIdByCategoryName($category)
    {
        $googleCalendars = config('google_calendars');  // Obtengo de la configuración cargada

        return $googleCalendars[$category] ?? null;  // Devuelve el valor o null si no se encuentra
    }


    // Método para obtener todos los calendarios 
    public static function getAllCategoryCalendars(): array
    {
        return config('google_calendars');
    }
}
