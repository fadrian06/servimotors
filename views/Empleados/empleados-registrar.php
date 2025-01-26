<?php

require_once __DIR__ . '/../../config/Database.php';

$pdo = Database::getConnection();

/*
C:\xampp\htdocs\servimotors\views\Empleados\empleados-registrar.php:7:
array (size=17)
  'firstName' => string 'Franyer' (length=7)
  'secondName' => string 'Adrian' (length=6)
  'lastName1' => string 'Sanchez' (length=7)
  'lastName2' => string 'Guillen' (length=7)
  'cedula' => string 'V28072391' (length=9)
  'gender' => string 'Masculino' (length=9)
  'birthDate' => string '2001-10-06' (length=10)
  'email' => string 'franyeradriansanchez@gmail.com' (length=30)
  'phoneLocal' => string '04165335826' (length=11)
  'phonePersonal' => string '04165335826' (length=11)
  'phoneOptional' => string '04165335826' (length=11)
  'role' => string 'Mecánico' (length=9)
  'workExperience' => string 'Ninguna, no tengo nada' (length=22)
  'certification' => string 'Ninguna' (length=7)
  'technicalSkill' => string 'Ninguna' (length=7)
  'entryDate' => string '2001-10-06' (length=10)
  'status' => string 'activo' (length=6)
 */
// var_dump($_POST);
// exit;

$stmt = $pdo->prepare('
  INSERT INTO empleados (cedula, primerNombre, segundoNombre, primerApellido, segundoApellido, genero, fechaNacimiento, correo, telefonoLocal, telefonoPersonal, telefonoAdicional, rol, experienciaLaboral, certificacion, habilidadTecnica, fechaIngreso, estado)
  VALUES (:cedula, :primerNombre, :segundoNombre, :primerApellido, :segundoApellido, :genero, :fechaNacimiento, :correo, :telefonoLocal, :telefonoPersonal, :telefonoAdicional, :rol, :experienciaLaboral, :certificacion, :habilidadTecnica, :fechaIngreso, :estado)
');

$stmt->execute([
  'cedula' => $_POST['cedula'],
  'primerNombre' => $_POST['firstName'],
  'segundoNombre' => $_POST['secondName'],
  'primerApellido' => $_POST['lastName1'],
  'segundoApellido' => $_POST['lastName2'],
  'genero' => $_POST['gender'],
  'fechaNacimiento' => $_POST['birthDate'],
  'correo' => $_POST['email'],
  'telefonoLocal' => $_POST['phoneLocal'],
  'telefonoPersonal' => $_POST['phonePersonal'],
  'telefonoAdicional' => $_POST['phoneOptional'],
  'rol' => $_POST['role'],
  'experienciaLaboral' => $_POST['workExperience'],
  'certificacion' => $_POST['certification'],
  'habilidadTecnica' => $_POST['technicalSkill'],
  'fechaIngreso' => $_POST['entryDate'],
  'estado' => $_POST['status'],
]);

header('Location: ./');
