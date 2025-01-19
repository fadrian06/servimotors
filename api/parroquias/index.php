<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../functions.php';

$stmt = db()->prepare('
  SELECT *, SUBSTR(nombre, 0, 2) as inicial
  FROM parroquias WHERE id_municipio = ? ORDER BY inicial
');

$stmt->execute([$_GET['id_municipio']]);
$iniciales = [];

/** @var array{inicial: string} $parroquia */
while ($parroquia = $stmt->fetch()) {
  $iniciales[$parroquia['inicial']][] = $parroquia;
}

json($iniciales);
