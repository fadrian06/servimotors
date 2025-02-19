<?php

require_once __DIR__ . '/../../Controllers/LoginController.php';
require_once __DIR__ . '/../../funciones.php';

if (strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
  json([
    'success' => false,
    'message' => 'Método no permitido.'
  ], 405);
}

// Procesar la solicitud del cliente
$nombreUsuario = is_string($_POST['username']) ? $_POST['username'] : '';
$contrasena = is_string($_POST['password']) ? $_POST['password'] : '';

if (!$nombreUsuario || !$contrasena) {
  // Respuesta en caso de datos incompletos
  json([
    'success' => false,
    'message' => 'Por favor complete todos los campos.'
  ], 400);
}

$loginController = new LoginController;
$resultado = $loginController($nombreUsuario, $contrasena);

if (!key_exists('user', $resultado)) {
  http_response_code($resultado['code']);

  // Si las credenciales son incorrectas
  json($resultado, $resultado['code']);  // Retornar el error
}

// Iniciar sesión en PHP
session_start();

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
json([
  'success' => true,
  'message' => 'Inicio de sesión exitoso.',
]);
