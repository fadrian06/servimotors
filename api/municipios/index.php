<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../functions.php';

$stmt = db()->prepare('
  SELECT *, SUBSTR(nombre, 0, 2) as inicial
  FROM municipios WHERE id_estado = ? ORDER BY inicial
');

$stmt->execute([$_GET['id_estado']]);
$iniciales = [];

/** @var array{inicial: string} $municipio */
while ($municipio = $stmt->fetch()) {
  $iniciales[$municipio['inicial']][] = $municipio;
}

json($iniciales);
