<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../../funciones.php';

$stmt = db()->query('
  SELECT *, SUBSTR(nombre, 0, 2) as inicial
  FROM estados ORDER BY inicial
') ?: null;

$iniciales = [];

/** @var array{inicial: string} $estado */
while ($estado = $stmt?->fetch()) {
  $iniciales[$estado['inicial']][] = $estado;
}

json($iniciales);
