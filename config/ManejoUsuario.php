<?php

declare(strict_types=1);

use Servimotors\Modelos\Rol;
use Servimotors\Modelos\Usuario;

require_once __DIR__ . '/../Modelos/Usuario.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

// Verificar si el usuario está logeado
if (!isset($_SESSION['usuario_logeado'])) {
  // Si no está logueado, redirigir a la página de inicio (index.php)
  exit(header('location: ../../'));
}

// Incluir la clase de conexión a la base de datos
require_once __DIR__ . '/Database.php';

class UsuarioController
{
  private readonly PDO $db;

  function __construct(?PDO $pdo = null)
  {
    $this->db = $pdo ?? Database::getConnection();
  }

  function obtenerUsuario(int $cedula): ?Usuario
  {
    try {
      $query = "
        SELECT u.nacionalidad, u.cedula, u.idRol, u.nombreUsuario, u.contrasena,
        u.nombreUsuario as alias, r.nombreRol, d.primerNombre, d.segundoNombre,
        d.primerApellido, d.segundoApellido, c.telefono, c.correo
        FROM Usuarios u
        JOIN RolUsuario r ON u.idRol = r.idRol
        JOIN DatosUsuario d ON u.cedula = d.cedula
        JOIN ContactosUsuario c ON u.cedula = c.cedula
        WHERE u.cedula = ?
      ";

      $stmt = $this->db->prepare($query);
      $stmt->execute([$cedula]);

      if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetchObject(Usuario::class); // Devolver los datos del usuario

        if ($usuario instanceof Usuario) {
          $usuario->rol = new Rol($usuario->idRol, $usuario->nombreRol);
        }

        return $usuario;
      } else {
        return null; // Si no se encuentra el usuario
      }
    } catch (PDOException) {
      return null;  // En caso de error
    }
  }
}

// Crear una instancia del controlador
$usuarioController = new UsuarioController;

// Obtener los datos del usuario logueado
$usuario = $usuarioController->obtenerUsuario($_SESSION['usuario_logeado']);

// Verificar si se obtuvo los datos correctamente
if ($usuario === null) {
  exit('Error al obtener los datos del usuario.');
}
