<?php

require_once __DIR__ . '/../db.php';

$stmt = $pdo->prepare('
  SELECT *, SUBSTR(nombre, 0, 2) as inicial
  FROM parroquias WHERE id_municipio = ? ORDER BY inicial
');

$stmt->execute([$_GET['id_municipio']]);
$iniciales = [];

while ($parroquia = $stmt->fetch()) {
  $iniciales[$parroquia['inicial']][] = $parroquia;
}

exit(json_encode($iniciales));
