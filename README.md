# Evaluacion practica BLUE Company

## Requerimeintos
1. Tener instalado un servidor con Apache 2,  PHP 7.2 o superior, Mysql 5.6 o superior
2. Tener instalado composer
3. Tener instalado Node.js

## Instalacion

1. Clonar el proyecto
    git clone https://github.com/Haleymhm/blue-company-test.git

2. Ingresar a la carpeta del proyecto
    cd blue-company-test

3. Instalar las librerias de laravel
    composer install

4. Instalar y compilar las librerias de Javascript
    npm install && npm run dev

5. Configurar el archivo .env con la conecion a la base de datos

6. Ejecutar las migracioes y los datos de pruebas
    php artisan migrate --seed

7. Iniciar la aplicacion
    php artisan serve

8. Abrir un navegador e ingresar la la siguiente direccion
    http://127.0.0.1:8000/