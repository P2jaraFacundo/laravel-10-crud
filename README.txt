Pasos para Configurar y Ejecutar el Proyecto Laravel-10-CRUD


1- Clonar el Proyecto desde GitHub:  
   Primero, clona el proyecto desde GitHub a la carpeta `www` de Laragon. Abre Laragon, inicia el servidor y abre la terminal. Luego, utiliza el comando `cd laravel-10-crud`, para trabajar sobre la carpeta del    proyecto.


2- Instalar las Dependencias:  
   Ejecuta el comando `composer install` en la terminal para instalar todas las dependencias del proyecto.


3- Configurar el Archivo `.env` (Archivo que contiene las configuraciones del proyecto)  
   Copia el archivo `.env.example` y renómbralo a `.env` con el comando  `cp .env.example .env`.


4- Generar la Clave de Aplicación  
   Ejecuta el comando `php artisan key:generate` para generar una clave de aplicación para tu proyecto.


5- Ejecutar las Migraciones de la Base de Datos 
   Utiliza el comando `php artisan migrate` para ejecutar las migraciones y crear las tablas necesarias en la base de datos. Si Laravel detecta que no existe una base de datos, te preguntará si deseas crear       una. En ese caso, escribe "yes" y presiona Enter para confirmar.


6- Instalar Vite como Dependencia de Desarrollo  
   Instala Vite como una dependencia de desarrollo ejecutando `npm install vite --save-dev`.


7- Construir el Proyecto con Vite  
   Utiliza Vite para construir el proyecto ejecutando `npm run build`. Esto optimiza y compila los archivos del proyecto.


8- Iniciar el Servidor de Desarrollo
   Ejecuta `php artisan serve` para iniciar el servidor de desarrollo de Laravel.


9- Verificar la Aplicación en Funcionamiento  
   Abre tu navegador y visita http://localhost:8000/ para ver la aplicación en funcionamiento.
