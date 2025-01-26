<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../functions.php';

$pdo = Database::getConnection();

$sql = "
  INSERT INTO servicios (placaVehiculo, motivo, costo, fechaEntrada, fechaSalida, kilometraje, categoria, cedulaMecanico)
  VALUES (:placaVehiculo, :motivo, :costo, :fechaEntrada, :fechaSalida, :kilometraje, :categoria, :cedulaMecanico)
";

$statement = $pdo->prepare($sql);

$statement->execute([
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
  'mensaje' => 'Servicio registrado con éxito'
]);
