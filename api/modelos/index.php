<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../funciones.php';

$stmt = Database::getConnection()->prepare('
  SELECT *, SUBSTR(nombreModelo, 1, 1) as inicial
  FROM modelos WHERE marcaId = ? ORDER BY inicial
') ?: null;

$stmt?->execute([$_GET['id_marca']]);
$iniciales = [];

/** @var array{inicial: string} $marcas */
while ($marcas = $stmt?->fetch()) {
  $iniciales[$marcas['inicial']][] = $marcas;
}

json($iniciales);
