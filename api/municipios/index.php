<?php

require_once __DIR__ . '/../db.php';

$stmt = db()->prepare('
  SELECT *, SUBSTR(nombre, 0, 2) as inicial
  FROM municipios WHERE id_estado = ? ORDER BY inicial
');

$stmt->execute([$_GET['id_estado']]);
$iniciales = [];

while ($municipio = $stmt->fetch()) {
  $iniciales[$municipio['inicial']][] = $municipio;
}

json($iniciales);
