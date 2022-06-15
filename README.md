<img src="https://bluecompany.cl/assets/img/bluecompany-logo-blue.svg">
# Evaluación práctica BLUE Company

## Requerimientos
1. Tener instalado un servidor con Apache 2,  PHP 7.2 o superior, Mysql 5.6 o superior
2. Tener instalado composer
3. Tener instalado Node.js

## Instalación

1. Clonar el proyecto
   ` git clone https://github.com/Haleymhm/blue-company-test.git `

2. Ingresar a la carpeta del proyecto
    ``` 
    cd blue-company-test 
    ```

3. Instalar las librerías de laravel
    ``` 
    composer install 
    ```

4. Instalar y compilar las librerías de Javascript
    ``` 
    npm install && npm run dev 
    ```

5. Configurar el archivo ` .env ` con la conexión a la base de datos

6. Ejecutar las migraciones y los datos de pruebas
    ``` 
    php artisan migrate --seed 
    ```

7. Iniciar la aplicación
    ``` 
    php artisan serve 
    ```

8. Abrir un navegador e ingresar la la siguiente dirección
    ` http://127.0.0.1:8000/ `

## Datos para Inicia Session
    ``` 
    USER: admin@blue.test
    PASS: 123456789 
    ```