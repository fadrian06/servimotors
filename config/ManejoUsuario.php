<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Verificar si el usuario está logeado
if (!isset($_SESSION['usuario_logeado'])) {
    // Si no está logeado, redirigir a la página de inicio (index.php)
    exit(header('Location: ../../'));
}

// Incluir la clase de conexión a la base de datos
require_once 'Database.php';

class UsuarioController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function obtenerUsuario($cedula)
    {
        try {
            $query = "
                SELECT u.cedula, u.nombreUsuario, u.contrasena, r.nombreRol,
                d.primerNombre, d.segundoNombre, d.primerApellido,
                d.segundoApellido, c.telefono, c.correo FROM Usuarios u
                JOIN RolUsuario r ON u.idRol = r.idRol
                JOIN DatosUsuario d ON u.cedula = d.cedula
                JOIN ContactosUsuario c ON u.cedula = c.cedula
                WHERE u.cedula = ?
            ";

            $stmt = $this->db->prepare($query);
            $stmt->execute([$cedula]);

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC); // Devolver los datos del usuario
            } else {
                return null; // Si no se encuentra el usuario
            }
        } catch (PDOException $e) {
            return null;  // En caso de error
        }
    }
}

// Crear una instancia del controlador
$usuarioController = new UsuarioController();

// Obtener los datos del usuario logueado
$usuario = $usuarioController->obtenerUsuario($_SESSION['usuario_logeado']);

// Verificar si se obtuvo los datos correctamente
if ($usuario === null) {
    exit('Error al obtener los datos del usuario.');
}
