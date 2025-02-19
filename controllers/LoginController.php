<?php

// Incluir la clase de conexión

use Servimotors\Modelos\Rol;
use Servimotors\Modelos\Usuario;

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../Modelos/Usuario.php';
require_once __DIR__ . '/../Modelos/Rol.php';

// Clase LoginController para gestionar el inicio de sesión
final readonly class LoginController
{
  private PDO $pdo;

  function __construct(?PDO $pdo = null)
  {
    $this->pdo = $pdo ?? Database::getConnection();
  }

  /**
   * @return array{
   *   success: bool,
   *   message: string,
   *   code: int,
   *   user?: Usuario,
   *   debug?: string
   * }
   */
  function __invoke(string $username, string $password)
  {
    try {
      // Consulta para obtener los datos del usuario, incluyendo información personal y de contacto
      $query = '
        SELECT u.cedula, u.nombreUsuario, u.contrasena, r.idRol, r.nombreRol,
        d.primerNombre, d.segundoNombre, d.primerApellido, d.segundoApellido,
        c.telefono, c.correo
        FROM Usuarios u
        JOIN RolUsuario r ON u.idRol = r.idRol
        JOIN DatosUsuario d ON u.cedula = d.cedula
        JOIN ContactosUsuario c ON u.cedula = c.cedula
        WHERE u.nombreUsuario = ?
      ';

      $stmt = $this->pdo->prepare($query);
      $stmt->execute([$username]);

      if ($stmt->rowCount() === 0) {
        // Usuario no encontrado
        return [
          'success' => false,
          'message' => 'El usuario no existe.',
          'code' => 404
        ];
      }

      $usuario = $stmt->fetchObject(Usuario::class);
      assert($usuario instanceof Usuario);
      $usuario->rol = new Rol($usuario->idRol, $usuario->nombreRol);

      if (!password_verify($password, $usuario['contrasena'])) {
        // Contraseña incorrecta
        return [
          'success' => false,
          'message' => 'Contraseña incorrecta.',
          'code' => 401
        ];
      }

      // Inicio de sesión exitoso
      return [
        'success' => true,
        'message' => 'Inicio de sesión exitoso.',
        'user' => [
          'cedula' => $usuario['cedula'],
          'nombreUsuario' => $usuario['nombreUsuario'],
          'rol' => $usuario['nombreRol'],
          'primerNombre' => $usuario['primerNombre'],
          'segundoNombre' => $usuario['segundoNombre'],
          'primerApellido' => $usuario['primerApellido'],
          'segundoApellido' => $usuario['segundoApellido'],
          'telefono' => $usuario['telefono'],
          'correo' => $usuario['correo']
        ],
        'code' => 200
      ];
    } catch (PDOException $exception) {
      // Manejar errores de la base de datos
      return [
        'success' => false,
        'message' => 'Error al intentar iniciar sesión',
        'debug' => $exception->__toString(),
        'code' => 500
      ];
    }
  }
}
