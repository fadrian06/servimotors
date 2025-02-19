<?php

// Incluir la clase Database para manejar la conexión
require_once __DIR__ . '/../../../config/Database.php';
require_once __DIR__ . '/../../../funciones.php';

@session_start();

if (@$_SESSION['rol'] !== 'Administrador') {
  json([
    'success' => false,
    'mensaje' => 'Acceso denegado'
  ], 403);
}

// Clase para validar los datos del usuario
class UserValidator
{
  private array $errors = []; // Array para almacenar los errores

  // Método para validar el formulario
  function validateForm(array $data): bool
  {
    // Validar nombres
    $nameRegex = '/^[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,30}$/';

    if (!preg_match($nameRegex, $data['firstName'] ?? '')) {
      $this->errors[] = 'Primer nombre inválido';
    }

    if (($data['secondName'] ?? '') && !preg_match($nameRegex, $data['secondName'])) {
      $this->errors[] = 'Segundo nombre inválido';
    }

    if (!preg_match($nameRegex, $data['firstSurname'] ?? '')) {
      $this->errors[] = 'Primer apellido inválido';
    }

    if (($data['secondSurname'] ?? '') && !preg_match($nameRegex, $data['secondSurname'])) {
      $this->errors[] = 'Segundo apellido inválido';
    }

    // Validar cédula
    if (!preg_match('/^[V|E]-\d{5,8}$/', ($data['cedula'] ?? ''))) {
      $this->errors[] = 'Cédula inválida';
    }

    // Validar teléfono
    if (!preg_match('/^\d{11}$/', $data['phone'] ?? '')) {
      $this->errors[] = 'Teléfono inválido';
    }

    // Validar correo electrónico
    if (!filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
      $this->errors[] = 'Correo electrónico inválido';
    }

    // Validar nombre de usuario
    if (!preg_match("/^[a-zA-Z0-9_]{4,20}$/", $data['username'] ?? '')) {
      $this->errors[] = 'Nombre de usuario inválido';
    }

    // Validar contraseña
    if (!preg_match(
      '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/',
      $data['password'] ?? ''
    )) {
      $this->errors[] = 'Contraseña inválida, debe contener al menos 8 caracteres, una letra mayúscula, una letra minúscula, un número y un carácter especial (@$!%*?&)';
    }

    // Devolver verdadero si no hay errores
    return empty($this->errors);
  }

  // Método para obtener los errores
  function getErrors(): array
  {
    return $this->errors;
  }
}

// Clase para manejar el registro de usuarios
class UserRegistration
{
  private PDO $pdo; // Conexión a la base de datos
  private UserValidator $validator; // Instancia del validador

  function __construct(?PDO $pdo = null, ?UserValidator $validator = null)
  {
    $this->pdo = $pdo ?? (new Database)->getConnection(); // Obtener conexión
    $this->validator = $validator ?? new UserValidator; // Instanciar el validador
  }

  // Método para registrar un usuario
  function register(array $data)
  {
    // Validar los datos del formulario
    if (!$this->validator->validateForm($data)) {
      return [
        'success' => false,
        'errores' => $this->validator->getErrors()
      ];
    }

    try {
      $this->pdo->beginTransaction(); // Iniciar una transacción

      // Obtener el ID del rol
      $stmt = $this->pdo->prepare("SELECT idRol FROM RolUsuario WHERE nombreRol = ?");
      $stmt->execute([$data['role'] ?? '']);
      $roleId = $stmt->fetchColumn();

      if (!$roleId) {
        throw new Exception('El rol especificado no existe.');
      }

      // Limpiar el formato de la cédula
      $cedula = str_replace(['V-', 'E-'], '', strtoupper($data['cedula']));

      // Insertar en la tabla Usuarios
      $stmt = $this->pdo->prepare('
        INSERT INTO Usuarios (cedula, idRol, nombreUsuario, contrasena)
        VALUES (?, ?, ?, ?)
      ');

      $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT, [
        'cost' => 10
      ]);

      $stmt->execute([$cedula, $roleId, $data['username'], $hashedPassword]);

      // Insertar en la tabla DatosUsuario
      $stmt = $this->pdo->prepare(
        "INSERT INTO DatosUsuario (
          cedula,
          primerNombre,
          segundoNombre,
          primerApellido,
          segundoApellido
        ) VALUES (?, ?, ?, ?, ?)"
      );

      $stmt->execute([
        $cedula,
        $data['firstName'],
        $data['secondName'] ?? '',
        $data['firstSurname'],
        $data['secondSurname'] ?? ''
      ]);

      // Insertar en la tabla ContactosUsuario
      $stmt = $this->pdo->prepare('
        INSERT INTO ContactosUsuario (cedula, telefono, correo)
        VALUES (?, ?, ?)
      ');

      $stmt->execute([$cedula, $data['phone'], $data['email']]);

      $this->pdo->commit(); // Confirmar la transacción

      return [
        'success' => true,
        'mensaje' => 'Usuario registrado exitosamente'
      ];
    } catch (PDOException $error) {
      $this->pdo->rollBack(); // Revertir la transacción en caso de error

      $error = match (true) {
        str_contains(strtolower($error->getMessage()), 'primary') => 'Ya existe un usuario con esa cédula',
        default => $error->getMessage()
      };

      return [
        'success' => false,
        'mensaje' => "Error al registrar usuario: $error"
      ];
    } catch (Exception $error) {
      $this->pdo->rollBack(); // Revertir la transacción en caso de error

      return [
        'success' => false,
        'mensaje' => $error->getMessage()
      ];
    }
  }
}

// Manejar la solicitud de registro
header('Content-Type: application/json');

if (!strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
  json([
    'success' => false,
    'mensaje' => 'Método no permitido'
  ], 405);
}

$registration = new UserRegistration; // Instanciar la clase de registro
$result = $registration->register($_POST); // Registrar al usuario con los datos enviados

json($result, 201); // Devolver la respuesta en formato JSON
