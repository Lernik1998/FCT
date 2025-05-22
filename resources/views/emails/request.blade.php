<!DOCTYPE html>
<html>

<head>
    <title>Solicitud recibida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body
    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0;">
    <!-- Contenedor principal -->
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <!-- Cabecera -->
        <div style="text-align: center; margin-bottom: 30px;">
            <h1
                style="color: #1f2937; font-size: 24px; font-weight: bold; margin-bottom: 10px; dark-mode: color: #ffffff;">
                Hemos recibido su solicitud
            </h1>
            <div style="height: 3px; width: 80px; background-color: #f97316; margin: 0 auto;"></div>
        </div>

        <!-- Cuerpo del email -->
        <div
            style="background-color: #ffffff; border-radius: 12px; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); dark-mode: background-color: #1f2937;">
            <p
                style="color: #4b5563; font-size: 16px; line-height: 1.5; margin-bottom: 20px; dark-mode: color: #d1d5db;">
                Hola {{ $name }}, hemos recibido su solicitud correctamente.
            </p>

            <p
                style="color: #4b5563; font-size: 16px; line-height: 1.5; margin-bottom: 25px; dark-mode: color: #d1d5db;">
                Estamos procesando su petición y nos pondremos en contacto con usted si necesitamos más información.
            </p>

            <!-- Botón de contacto -->
            <div style="text-align: center; margin-top: 30px;">
                <a href="mailto:lernikgpt@gmail.com"
                    style="display: inline-block; background-color: #3b82f6; color: #ffffff; font-weight: medium; padding: 12px 24px; border-radius: 8px; text-decoration: none; transition: all 0.3s; dark-mode: background-color: #2563eb;">
                    Contactar con soporte
                </a>
            </div>
        </div>

        <!-- Pie de email -->
        <div style="text-align: center; margin-top: 30px; color: #9ca3af; font-size: 14px; dark-mode: color: #6b7280;">
            <p style="margin-bottom: 5px;">© {{ date('Y') }} {{ config('app.name') }}</p>
            <p>Si no reconoces esta actividad, por favor ignora este mensaje.</p>
        </div>
    </div>
</body>

</html>