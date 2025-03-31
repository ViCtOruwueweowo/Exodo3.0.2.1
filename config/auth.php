<?php

return [

    /*
    |----------------------------------------------------------------------
    | Authentication Defaults
    |----------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web', // El guard que se usará por defecto
        'passwords' => 'staffs', // Especifica que los resets de contraseñas son para 'staffs'
    ],

    /*
    |----------------------------------------------------------------------
    | Authentication Guards
    |----------------------------------------------------------------------
    |
    | You may define every authentication guard for your application.
    | Here we define guards for 'staff' and 'web' (normal user guard).
    |
    */

    'guards' => [
        // Guard para 'web' - puede ser usado para los usuarios generales
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Guard para 'staff' - este usa JWT para la autenticación del personal
        'staff' => [
            'driver' => 'jwt',  // Usa JWT en lugar de sesión
            'provider' => 'staffs',
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | User Providers
    |----------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how
    | users are actually retrieved from your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "eloquent" or "database"
    |
    */

    'providers' => [
        // Proveedor para el modelo 'User' (usuarios normales)
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,  // Modelo de usuario
        ],

        // Proveedor para el modelo 'Staff' (empleados)
        'staffs' => [
            'driver' => 'eloquent',
            'model' => App\Models\Staff::class,  // Modelo de empleado (Staff)
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Password Reset Settings
    |----------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have
    | more than one user table or model in the application and you want
    | to have separate password reset settings based on the specific
    | user types.
    |
    */

    'passwords' => [
        // Configuración para el reset de contraseñas de 'staff'
        'staffs' => [
            'provider' => 'staffs',
            'table' => 'password_resets',
            'expire' => 60,  // Tiempo de expiración en minutos
            'throttle' => 60,  // Tiempo de espera para nuevos intentos
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Password Confirmation Timeout
    |----------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password
    | confirmation times out and the user is prompted to re-enter their
    | password via the confirmation screen. By default, the timeout lasts
    | for three hours.
    |
    */

    'password_timeout' => 10800,  // Tiempo de expiración para confirmar la contraseña
];
