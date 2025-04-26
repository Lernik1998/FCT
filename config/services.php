<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    // Integración Login/Registro con Google
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
        // 'calendar_id' => env('GOOGLE_CALENDAR_ID'),
    ],

    // Google Calendar
    'google_calendar' => [
        'client_id' => env('GOOGLE_CALENDAR_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CALENDAR_CLIENT_SECRET'),
        'redirect_uri' => env('GOOGLE_CALENDAR_REDIRECT_URI'),
        'application_name' => env('GOOGLE_CALENDAR_APPLICATION_NAME'),
        'calendar_id' => env('GOOGLE_CALENDAR_ID'),
        'credentials_path' => storage_path(env('GOOGLE_CALENDAR_CREDENTIALS_PATH')),
    ],

    // Calendario para los Trainers
    'google_calendars' => [
        'General' => env('GOOGLE_CALENDAR_ID'),
        'Resistencia y cardio' => env('GOOGLE_CALENDAR_RESISTENCIA_CARDIO_ID'),
        'Baile' => env('GOOGLE_CALENDAR_BAILE_ID'),
        'Flexibilidad y cuerpo-mente' => env('GOOGLE_CALENDAR_FLEXIBILIDAD_ID'),
        'Fuerza y acondicionamiento' => env('GOOGLE_CALENDAR_FUERZA_ID'),
        'Rehabilitación o movimiento suave' => env('GOOGLE_CALENDAR_REHAB_ID'),
    ],

    // Integración del servicio de Stripe
    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
];
