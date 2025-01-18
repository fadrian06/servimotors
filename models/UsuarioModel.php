<?php

class UsuarioModel
{
    private PDO $conexion;

    // Patrones de validación
    private const PATRON_NOMBRE = '/^[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,30}$/';
    private const PATRON_CEDULA = '/^[V|E]-\d{5,8}$/';
    private const PATRON_TELEFONO = '/^\d{11}$/';
    private const PATRON_EMAIL = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    private const PATRON_USERNAME = '/^[a-zA-Z0-9_]{4,20}$/';
    private const PATRON_PASSWORD = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/';

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

    public function validarDatos($datos)
    {
        $errores = [];

        if (!preg_match(self::PATRON_NOMBRE, $datos['primerNombre'])) {
            $errores[] = "El primer nombre no es válido";
        }
        if ($datos['segundoNombre'] && !preg_match(self::PATRON_NOMBRE, $datos['segundoNombre'])) {
            $errores[] = "El segundo nombre no es válido";
        }
        if (!preg_match(self::PATRON_NOMBRE, $datos['primerApellido'])) {
            $errores[] = "El primer apellido no es válido";
        }
        if ($datos['segundoApellido'] && !preg_match(self::PATRON_NOMBRE, $datos['segundoApellido'])) {
            $errores[] = "El segundo apellido no es válido";
        }
        if (!preg_match(self::PATRON_CEDULA, $datos['cedula'])) {
            $errores[] = "La cédula no es válida";
        }
        if (!preg_match(self::PATRON_TELEFONO, $datos['telefono'])) {
            $errores[] = "El teléfono no es válido";
        }
        if (!preg_match(self::PATRON_EMAIL, $datos['correo'])) {
            $errores[] = "El correo electrónico no es válido";
        }
        if (!preg_match(self::PATRON_USERNAME, $datos['nombreUsuario'])) {
            $errores[] = "El nombre de usuario no es válido";
        }
        if (!preg_match(self::PATRON_PASSWORD, $datos['contrasena'])) {
            $errores[] = "La contraseña no cumple con los requisitos de seguridad";
        }

        return $errores;
    }

    public function registrarUsuario($datos)
    {
        try {
            $this->conexion->beginTransaction();

            // Insertar en tabla Usuarios
            $sqlUsuario = "INSERT INTO Usuarios (cedula, idRol, nombreUsuario, contrasena) 
                          VALUES (:cedula, :idRol, :nombreUsuario, :contrasena)";

            $stmtUsuario = $this->conexion->prepare($sqlUsuario);
            $stmtUsuario->execute([
                ':cedula' => str_replace(['V-', 'E-'], '', $datos['cedula']),
                ':idRol' => $datos['idRol'],
                ':nombreUsuario' => $datos['nombreUsuario'],
                ':contrasena' => password_hash($datos['contrasena'], PASSWORD_DEFAULT)
            ]);

            // Insertar en tabla DatosUsuario
            $sqlDatos = "INSERT INTO DatosUsuario (cedula, primerNombre, segundoNombre, primerApellido, segundoApellido) 
                        VALUES (:cedula, :primerNombre, :segundoNombre, :primerApellido, :segundoApellido)";

            $stmtDatos = $this->conexion->prepare($sqlDatos);
            $stmtDatos->execute([
                ':cedula' => str_replace(['V-', 'E-'], '', $datos['cedula']),
                ':primerNombre' => $datos['primerNombre'],
                ':segundoNombre' => $datos['segundoNombre'],
                ':primerApellido' => $datos['primerApellido'],
                ':segundoApellido' => $datos['segundoApellido']
            ]);

            // Insertar en tabla ContactosUsuario
            $sqlContactos = "INSERT INTO ContactosUsuario (cedula, telefono, correo) 
                           VALUES (:cedula, :telefono, :correo)";

            $stmtContactos = $this->conexion->prepare($sqlContactos);
            $stmtContactos->execute([
                ':cedula' => str_replace(['V-', 'E-'], '', $datos['cedula']),
                ':telefono' => $datos['telefono'],
                ':correo' => $datos['correo']
            ]);

            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            throw new Exception("Error al registrar usuario: " . $e->getMessage());
        }
    }

    public function usuarioExiste($cedula, $nombreUsuario, $correo)
    {
        $sql = "SELECT cedula FROM Usuarios WHERE cedula = :cedula 
                UNION 
                SELECT cedula FROM Usuarios WHERE nombreUsuario = :nombreUsuario
                UNION
                SELECT u.cedula FROM Usuarios u 
                INNER JOIN ContactosUsuario c ON u.cedula = c.cedula 
                WHERE c.correo = :correo";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':cedula' => str_replace(['V-', 'E-'], '', $cedula),
            ':nombreUsuario' => $nombreUsuario,
            ':correo' => $correo
        ]);

        return $stmt->rowCount() > 0;
    }
}
