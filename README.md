# RecipeApp

RecipeApp es una aplicación para la gestión e interacción de recetas culinarias publicadas entre los usuarios. El sistema cuenta principalmente con módulos de usuarios, categorías, recetas, favoritos y comentarios.

## Requerimientos
- PHP 8.1+
- MySQL 5.7+

## Instalación

Clonar el repositorio

    git clone https://github.com/admontero/recipe-app.git

Cambiar a la carpeta del repositorio

    cd recipe-app

Instalar las dependencias de PHP usando composer

    composer install

Copia el archivo ejemplo de variables de entorno y haz las configuraciones requeridas en tu archivo .env

    cp .env.example .env

Genera una key para la aplicación

    php artisan key:generate

**NOTA:** Antes de ejecutar las migraciones asegurate de crear la base datos y que el nombre de esta coincida con el de la variable DB_DATABASE del archivo .env

Ejecuta las migraciones de la base de datos

    php artisan migrate

Ejecuta todos los seeders configurados para la aplicación

    php artisan db:seed

Instalar las dependencias de JavaScript usando npm

    npm install

Compila los paquetes en desarrollo

    npm run dev

Levanta el servidor de desarrollo

    php artisan serve

Ahora puedes acceder al servidor desde http://localhost:8000

## Credenciales

Utiliza estas credenciales para ingresar al sistema como administrador:

**Email:** admin@admin.com

**Contraseña:** password

## Dependencias

- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar) - Para monitorizar el rendimiento de la aplicación.
- [intervention/image](https://github.com/Intervention/image) - Para el procesamiento de imágenes.
- [spatie/laravel-sluggable](https://github.com/spatie/laravel-sluggable) - Para la generación automática de slugs en modelos Eloquent.
- [staudenmeir/eloquent-eager-limit](https://github.com/staudenmeir/eloquent-eager-limit) - Para limitar los resultados de una relación desde un padre.

## Autor

[Andrés Montero](https://github.com/admontero)
