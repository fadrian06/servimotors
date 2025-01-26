<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../functions.php';

$pdo = Database::getConnection();

$sql = "
  UPDATE servicios
  SET placaVehiculo = :placaVehiculo,
      motivo = :motivo,
      costo = :costo,
      fechaEntrada = :fechaEntrada,
      fechaSalida = :fechaSalida,
      kilometraje = :kilometraje,
      categoria = :categoria,
      cedulaMecanico = :cedulaMecanico
  WHERE id = :id";

$statement = $pdo->prepare($sql);

$statement->execute([
  ':id' => $_POST['id'],
  ':placaVehiculo' => $_POST['vehicle'],
  ':motivo' => $_POST['faultReason'],
  ':costo' => $_POST['cost'],
  ':fechaEntrada' => $_POST['entryDate'],
  ':fechaSalida' => $_POST['exitDate'],
  ':kilometraje' => $_POST['mileage'],
  ':categoria' => $_POST['category'],
  ':cedulaMecanico' => $_POST['mechanic']
]);

json([
  'success' => true,
  'mensaje' => 'Servicio actualizado con éxito'
]);
