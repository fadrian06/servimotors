<?php

require_once __DIR__ . '/LoginController.php';

// Procesar la solicitud del cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = $_POST['username'] ?? '';
    $contrasena = $_POST['password'] ?? '';

    if (!empty($nombreUsuario) && !empty($contrasena)) {
        $loginController = new LoginController;
        $resultado = $loginController->iniciarSesion($nombreUsuario, $contrasena);

        if ($resultado['success']) {
            // Iniciar sesión en PHP
            session_start();  // Inicia la sesión

            // Almacenar la información del usuario en las variables de sesión
            $_SESSION['usuario_logeado'] = $resultado['user']['cedula'];  // Guarda el ID del usuario
            $_SESSION['nombreUsuario'] = $resultado['user']['nombreUsuario'];  // Guarda el nombre de usuario
            $_SESSION['rol'] = $resultado['user']['rol'];  // Guarda el rol del usuario
            $_SESSION['primerNombre'] = $resultado['user']['primerNombre'];  // Guarda el primer nombre
            $_SESSION['segundoNombre'] = $resultado['user']['segundoNombre'];  // Guarda el segundo nombre
            $_SESSION['primerApellido'] = $resultado['user']['primerApellido'];  // Guarda el primer apellido
            $_SESSION['segundoApellido'] = $resultado['user']['segundoApellido'];  // Guarda el segundo apellido
            $_SESSION['telefono'] = $resultado['user']['telefono'];  // Guarda el teléfono
            $_SESSION['correo'] = $resultado['user']['correo'];  // Guarda el correo

            // Responder con un mensaje de éxito y redirigir al usuario
            echo json_encode([
                'success' => true,
                'message' => 'Inicio de sesión exitoso.',
            ]);
        } else {
            // Si las credenciales son incorrectas
            echo json_encode($resultado);  // Retornar el error
        }
    } else {
        // Respuesta en caso de datos incompletos
        echo json_encode([
            'success' => false,
            'message' => 'Por favor complete todos los campos.'
        ]);
    }
}
