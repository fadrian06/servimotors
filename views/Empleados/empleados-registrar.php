<?php

use Servimotors\Bitacora;
use Servimotors\TipoDeBitacora;

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../Bitacora.php';
require_once __DIR__ . '/../../funciones.php';

$pdo = Database::getConnection();

$errors = [];

if (!preg_match('/^[VE]\d{7,8}$/', $_POST['cedula'] ?? '')) {
  $errors[] = 'La cédula es inválida (Ejemplo: V12345678)';
}

if (!filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
  $errors[] = 'El correo es inválido';
}

$phoneRegexp = '/^[0-9]{11}$/';

if (!preg_match($phoneRegexp, $_POST['phoneLocal'] ?? '')) {
  $errors[] = 'El teléfono local es inválido';
}

if (!preg_match($phoneRegexp, $_POST['phonePersonal'] ?? '')) {
  $errors[] = 'El teléfono personal es inválido';
}

if (key_exists('phoneOptional', $_POST) && !preg_match($phoneRegexp, $_POST['phoneOptional'])) {
  $errors[] = 'El teléfono adicional es inválido';
}

$nameRegexp = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/';

if (!preg_match($nameRegexp, $_POST['firstName'] ?? '')) {
  $errors[] = 'El primer nombre es inválido';
}

if (key_exists('secondName', $_POST) && !preg_match($nameRegexp, $_POST['secondName'])) {
  $errors[] = 'El segundo nombre es inválido';
}

if (!preg_match($nameRegexp, $_POST['lastName1'] ?? '')) {
  $errors[] = 'El primer apellido es inválido';
}

if (key_exists('lastName2', $_POST) && !preg_match($nameRegexp, $_POST['lastName2'])) {
  $errors[] = 'El segundo apellido es inválido';
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['birthDate'] ?? '')) {
  $errors[] = 'La fecha de nacimiento es inválida';
}

if (!in_array($_POST['gender'] ?? '', ['M', 'F'])) {
  $errors[] = 'El género es inválido (M o F)';
}

$roles = [
  'Mecánico',
  'Electricista',
  'Transmisión',
  'Aire Acondicionado',
  'Ayudante',
  'Mensajero',
  'Limpieza'
];

if (!in_array($_POST['role'] ?? '', $roles)) {
  $errors[] = 'El rol es inválido (' . implode(', ', $roles) . ')';
}

if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/', $_POST['workExperience'] ?? '')) {
  $errors[] = 'La experiencia laboral es inválida';
}

if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/', $_POST['certification'] ?? '')) {
  $errors[] = 'La certificación es inválida';
}

if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,}$/', $_POST['technicalSkill'] ?? '')) {
  $errors[] = 'La habilidad técnica es inválida';
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['entryDate'] ?? '')) {
  $errors[] = 'La fecha de ingreso es inválida';
}

if (!in_array($_POST['status'] ?? '', ['Activo', 'Inactivo'])) {
  $errors[] = 'El estado es inválido (Activo o Inactivo)';
}

if ($errors) {
  json([
    'error' => $errors,
    'data' => $_POST
  ], 400);
}

$stmt = $pdo->prepare('
  INSERT INTO empleados (
    cedula,
    primerNombre,
    segundoNombre,
    primerApellido,
    segundoApellido,
    genero,
    fechaNacimiento,
    correo,
    telefonoLocal,
    telefonoPersonal,
    telefonoAdicional,
    rol,
    experienciaLaboral,
    certificacion,
    habilidadTecnica,
    fechaIngreso,
    estado,
    nacionalidad
  ) VALUES (
    :cedula,
    :primerNombre,
    :segundoNombre,
    :primerApellido,
    :segundoApellido,
    :genero,
    :fechaNacimiento,
    :correo,
    :telefonoLocal,
    :telefonoPersonal,
    :telefonoAdicional,
    :rol,
    :experienciaLaboral,
    :certificacion,
    :habilidadTecnica,
    :fechaIngreso,
    :estado,
    :nacionalidad
  )
');

try {
  $stmt->execute([
    'cedula' => @$_POST['cedula'],
    'primerNombre' => $_POST['firstName'] ?? '',
    'segundoNombre' => $_POST['secondName'] ?? '',
    'primerApellido' => $_POST['lastName1'] ?? '',
    'segundoApellido' => $_POST['lastName2'] ?? '',
    'genero' => $_POST['gender'] ?? '',
    'fechaNacimiento' => $_POST['birthDate'] ?? '',
    'correo' => $_POST['email'] ?? '',
    'telefonoLocal' => $_POST['phoneLocal'] ?? '',
    'telefonoPersonal' => $_POST['phonePersonal'] ?? '',
    'telefonoAdicional' => $_POST['phoneOptional'] ?? '',
    'rol' => $_POST['role'] ?? '',
    'experienciaLaboral' => $_POST['workExperience'] ?? '',
    'certificacion' => $_POST['certification'] ?? '',
    'habilidadTecnica' => $_POST['technicalSkill'] ?? '',
    'fechaIngreso' => $_POST['entryDate'] ?? '',
    'estado' => $_POST['status'] ?? '',
    ':nacionalidad' => substr($_POST['cedula'] ?? '', 0, 1)
  ]);

  Bitacora::crear(
    'Nuevo empleado',
    "Se ha registrado un nuevo empleado con la cédula {$_POST['cedula']}",
    TipoDeBitacora::EXITO
  );

  json([
    'message' => 'Empleado registrado con éxito'
  ]);
} catch (PDOException $error) {
  $error = match (true) {
    str_contains(strtolower($error->getMessage()), 'cedula'),
    str_contains(strtolower($error->getMessage()), 'primary') => 'La cédula ya está registrada',
    str_contains(strtolower($error->getMessage()), 'correo') => 'El correo ya está registrado',
    str_contains(strtolower($error->getMessage()), 'telefonoLocal') => 'El teléfono local ya está registrado',
    str_contains(strtolower($error->getMessage()), 'telefonoPersonal') => 'El teléfono personal ya está registrado',
    default => $error->getMessage()
  };

  json([
    'error' => $error,
    'data' => $_POST
  ], 409);
}
