<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../funciones.php';

$stmt = Database::getConnection()->query('
  SELECT *, SUBSTR(nombreMarca, 1, 1) as inicial
  FROM marcas ORDER BY inicial
') ?: null;

$iniciales = [];

/** @var array{inicial: string} $marcas */
while ($marcas = $stmt?->fetch()) {
  $iniciales[$marcas['inicial']][] = $marcas;
}

json($iniciales);
