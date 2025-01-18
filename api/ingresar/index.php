<?php

require_once __DIR__ . '/../../Controllers/LoginController.php';

// Procesar la solicitud del cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = $_POST['username'] ?? '';
    $contrasena = $_POST['password'] ?? '';

    if (!$nombreUsuario || !$contrasena) {
        http_response_code(400);

        // Respuesta en caso de datos incompletos
        exit(json_encode([
            'success' => false,
            'message' => 'Por favor complete todos los campos.'
        ]));
    }

    $loginController = new LoginController;
    $resultado = $loginController($nombreUsuario, $contrasena);

    if (!$resultado['success']) {
        http_response_code($resultado['code']);

        // Si las credenciales son incorrectas
        exit(json_encode($resultado));  // Retornar el error
    }

    // Iniciar sesión en PHP
    session_start();  // Inicia la sesión

    // Almacenar la información del usuario en las variables de sesión
    $_SESSION += [
        'usuario_logeado' => $resultado['user']['cedula'], // Guarda el ID del usuario
        'nombreUsuario' => $resultado['user']['nombreUsuario'], // Guarda el nombre de usuario
        'rol' => $resultado['user']['rol'], // Guarda el rol del usuario
        'primerNombre' => $resultado['user']['primerNombre'], // Guarda el primer nombre
        'segundoNombre' => $resultado['user']['segundoNombre'], // Guarda el segundo nombre
        'primerApellido' => $resultado['user']['primerApellido'], // Guarda el primer apellido
        'segundoApellido' => $resultado['user']['segundoApellido'], // Guarda el segundo apellido
        'telefono' => $resultado['user']['telefono'], // Guarda el teléfono
        'correo' => $resultado['user']['correo'], // Guarda el correo
    ];

    // Responder con un mensaje de éxito y redirigir al usuario
    exit(json_encode([
        'success' => true,
        'message' => 'Inicio de sesión exitoso.',
    ]));
}
