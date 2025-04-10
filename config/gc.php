<?php

return [
    'application_name' => env('GOOGLE_CALENDAR_APPLICATION_NAME', 'TFG Calendar FitWorking'),
    'calendar_id' => env('GOOGLE_CALENDAR_ID', '65dd6ab370d12e0c59d25eb65530b4891b909b8979c6d56b54870cdabd3971b5@group.calendar.google.com'),
    'credentials_path' => base_path('/storage/app/google-calendar/client_secret.json'),
];