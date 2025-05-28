Requisitos previos

Antes de comenzar, asegúrate de tener instaladas las siguientes herramientas en tu sistema:

1. PHP
   Laravel requiere PHP. Puedes:
   Instalar PHP directamente desde php.net.

O usar XAMPP (recomendado para Windows), ya que incluye PHP preinstalado.

Para verificar que PHP está correctamente instalado, abre una terminal y ejecuta:

php -v

ℹ️ En Windows, asegúrate de agregar PHP a las variables de entorno. Puede que necesites reiniciar el sistema.

2. Composer
   Laravel usa Composer para gestionar dependencias. Puedes descargarlo desde getcomposer.org.
   Una vez instalado, ejecuta para comprobar:

composer -v

Para instalar las dependencias del proyecto, usa:

composer install

3. Node.js y NPM
   Laravel utiliza Vite para compilar los assets del frontend, por lo que necesitas Node.js y NPM.
   Descarga desde nodejs.org

O instala mediante tu gestor de paquetes preferido.

Verifica la instalación con:

node -v
npm -v

Instala las dependencias de JavaScript con:

npm install

Puesta en marcha del proyecto

1. Obtener el código fuente
   Clona o descarga el repositorio y accede al directorio raíz del proyecto. Luego instala las dependencias PHP:

composer install

2. Copiar el archivo de entorno
   Copia .env.example a .env. Usa uno de los siguientes comandos según tu sistema:
   En Linux/macOS o Git Bash:

cp .env.example .env

En Windows PowerShell:

copy .env.example .env

3. Generar clave de aplicación
   Esto generará la clave APP_KEY automáticamente en tu archivo .env:

php artisan key:generate

4. Configurar la base de datos
   Edita las siguientes variables en el archivo .env para que coincidan con tu entorno local:

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fitworking
DB_USERNAME=root
DB_PASSWORD="1234"

5. Ejecutar las migraciones
   Crea las tablas necesarias en la base de datos:

php artisan migrate

6. Ejecutar los seeders (opcional)
   Para poblar la base de datos con datos iniciales:

php artisan db:seed

7. Instalar dependencias JavaScript
   Instala los paquetes necesarios para los assets del frontend:

npm install

8. Compilar assets
   Para desarrollo:

npm run dev

Para producción:

npm run build

9. Iniciar el servidor local
   Levanta el servidor de desarrollo de Laravel:
   php artisan serve

Esto iniciará el proyecto en:
📍 http://127.0.0.1:8000
