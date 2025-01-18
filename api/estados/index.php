<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../functions.php';

$stmt = db()->query('
  SELECT *, SUBSTR(nombre, 0, 2) as inicial
  FROM estados ORDER BY inicial
');

$iniciales = [];

while ($estado = $stmt->fetch()) {
  $iniciales[$estado['inicial']][] = $estado;
}

json($iniciales);
