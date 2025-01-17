<?php

// Incluir la clase de conexión
require_once __DIR__ . '/../../config/Database.php';

// Clase LoginController para gestionar el inicio de sesión
final readonly class LoginController
{
    private ?PDO $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getConnection();
    }

    public function iniciarSesion(string $nombreUsuario, string $contrasena)
    {
        try {
            // Consulta para obtener los datos del usuario, incluyendo información personal y de contacto
            $query = "
                SELECT u.cedula, u.nombreUsuario, u.contrasena, r.nombreRol,
                d.primerNombre, d.segundoNombre, d.primerApellido, d.segundoApellido,
                c.telefono, c.correo
                FROM Usuarios u
                JOIN RolUsuario r ON u.idRol = r.idRol
                JOIN DatosUsuario d ON u.cedula = d.cedula
                JOIN ContactosUsuario c ON u.cedula = c.cedula
                WHERE u.nombreUsuario = ?
            ";

            $stmt = $this->db->prepare($query);
            $stmt->execute([$nombreUsuario]);

            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verificar la contraseña usando password_verify
                if (password_verify($contrasena, $usuario['contrasena'])) {
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
                        ]
                    ];
                } else {
                    // Contraseña incorrecta
                    return [
                        'success' => false,
                        'message' => 'Contraseña incorrecta.'
                    ];
                }
            } else {
                // Usuario no encontrado
                return [
                    'success' => false,
                    'message' => 'El usuario no existe.'
                ];
            }
        } catch (PDOException $e) {
            // Manejar errores de la base de datos
            return [
                'success' => false,
                'message' => "Error al intentar iniciar sesión: {$e->getMessage()}"
            ];
        }
    }
}
