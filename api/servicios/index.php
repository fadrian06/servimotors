<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
  $_POST += json_decode(file_get_contents('php://input'), true);

  $stmt = Database::getConnection()->prepare('
    SELECT * FROM vehiculos WHERE placa = ?
  ') ?: null;

  $stmt?->execute([$_GET['placa']]);
  $vehicle = $stmt?->fetch() ?: [];

  if (!$vehicle) {
    json([
      'success' => false,
      'message' => 'Vehículo no encontrado.'
    ], 404);
  }

  $stmt = Database::getConnection()->prepare('
    UPDATE vehiculos
    SET cedulaCliente = :cedulaCliente,
    modeloId = :modeloId,
    tipoCombustibleId = :tipoCombustibleId,
    anio = :anio,
    clave = :clave
    WHERE placa = :placa
  ') ?: null;

  $stmt?->execute([
    ':cedulaCliente' => empty($_POST['clientID'])
      ? $vehicle['cedulaCliente']
      : $_POST['clientID'],
    ':modeloId' => empty($_POST['model'])
      ? $vehicle['modeloId']
      : $_POST['model'],
    ':tipoCombustibleId' => empty($_POST['fuelType'])
      ? $vehicle['tipoCombustibleId']
      : $_POST['fuelType'],
    ':anio' => empty($_POST['year'])
      ? $vehicle['anio']
      : $_POST['year'],
    ':clave' => empty($_POST['key'])
      ? $vehicle['clave']
      : password_hash($_POST['key'], PASSWORD_DEFAULT),
    ':placa' => $vehicle['placa']
  ]);

  json([
    'success' => true,
    'message' => 'Vehículo actualizado exitosamente.'
  ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $stmt = Database::getConnection()->prepare('DELETE FROM servicios WHERE id = ?') ?: null;
  $stmt?->execute([$_GET['id']]);

  json([
    'success' => true,
    'message' => 'Servicio eliminado exitosamente.'
  ]);
}

if ($_POST) {
  try {
    if (!is_numeric($_POST['clientID'])) {
      json([
        'success' => false,
        'message' => 'La cédula del cliente debe ser un número.'
      ], 400);
    }

    if (!is_numeric($_POST['model'])) {
      json([
        'success' => false,
        'message' => 'El modelo del vehículo debe ser un número.'
      ], 400);
    }

    if (!is_numeric($_POST['fuelType'])) {
      json([
        'success' => false,
        'message' => 'El tipo de combustible del vehículo debe ser un número.'
      ], 400);
    }

    $year = $_POST['year'];
    settype($year, 'int');

    if ($year < 1900 || $year > date('Y')) {
      json([
        'success' => false,
        'message' => 'El año del vehículo debe estar entre 1900 y el año actual.',
        'debug' => var_export($year, true)
      ], 400);
    }

    if (!preg_match('/^[A-Z0-9]{6,8}$/', $_POST['plate'])) {
      json([
        'success' => false,
        'message' => 'La placa del vehículo debe contener entre 6 y 8 caracteres alfanuméricos en mayúsculas.'
      ], 400);
    }

    if (!preg_match('/^[A-Za-z0-9@!\#\$%\^\&\*\(\)_\-]{4,20}$/', $_POST['key'])) {
      json([
        'success' => false,
        'message' => 'La clave del vehículo debe contener entre 4 y 20 caracteres alfanuméricos y los siguientes caracteres especiales: @!#$%^&*()_-'
      ], 400);
    }

    $stmt = Database::getConnection()->prepare('
      INSERT INTO vehiculos (placa, cedulaCliente, modeloId, tipoCombustibleId, anio, clave)
      VALUES (:placa, :cedulaCliente, :modeloId, :tipoCombustibleId, :anio, :clave)
    ') ?: null;

    $stmt?->execute([
      'placa' => $_POST['plate'],
      'cedulaCliente' => $_POST['clientID'],
      'modeloId' => $_POST['model'],
      'tipoCombustibleId' => $_POST['fuelType'],
      'anio' => $_POST['year'],
      'clave' => password_hash($_POST['key'], PASSWORD_DEFAULT),
    ]);

    json([
      'success' => true,
      'message' => 'Vehículo registrado exitosamente.'
    ]);
  } catch (PDOException $exception) {
    json([
      'success' => false,
      'message' => 'Error al registrar el vehículo.',
      'debug' => $exception->getMessage()
    ], 500);
  }
}
