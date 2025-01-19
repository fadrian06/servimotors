<?php

final readonly class UsuarioController
{
    private UsuarioModel $modelo;

    public function __construct(PDO $conexion)
    {
        $this->modelo = new UsuarioModel($conexion);
    }

    public function registrar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Recoger datos del formulario
                $datos = [
                    'primerNombre' => $_POST['firstName'],
                    'segundoNombre' => $_POST['secondName'],
                    'primerApellido' => $_POST['firstSurname'],
                    'segundoApellido' => $_POST['secondSurname'],
                    'cedula' => $_POST['cedula'],
                    'telefono' => $_POST['phone'],
                    'correo' => $_POST['email'],
                    'nombreUsuario' => $_POST['username'],
                    'contrasena' => $_POST['password'],
                    'idRol' => $_POST['role'] === 'Administrador' ? 1 : 2
                ];

                // Validar datos
                $errores = $this->modelo->validarDatos($datos);

                if (!empty($errores)) {
                    echo json_encode(['success' => false, 'errores' => $errores]);
                    return;
                }

                // Verificar si el usuario ya existe
                if ($this->modelo->usuarioExiste($datos['cedula'], $datos['nombreUsuario'], $datos['correo'])) {
                    echo json_encode(['success' => false, 'mensaje' => 'El usuario ya existe']);
                    return;
                }

                // Registrar usuario
                $this->modelo->registrarUsuario($datos);
                echo json_encode(['success' => true, 'mensaje' => 'Usuario registrado exitosamente']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'mensaje' => $e->getMessage()]);
            }
        } else {
            // Mostrar formulario de registro
            include __DIR__ . '/../views/auth/register.php';
        }
    }
}
