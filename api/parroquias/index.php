<?php

require_once __DIR__ . '/../db.php';

$stmt = db()->prepare('
  SELECT *, SUBSTR(nombre, 0, 2) as inicial
  FROM parroquias WHERE id_municipio = ? ORDER BY inicial
');

$stmt->execute([$_GET['id_municipio']]);
$iniciales = [];

while ($parroquia = $stmt->fetch()) {
  $iniciales[$parroquia['inicial']][] = $parroquia;
}

json($iniciales);
