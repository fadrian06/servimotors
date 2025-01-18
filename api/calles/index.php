<?php

require_once __DIR__ . '/../db.php';

$stmt = $pdo->prepare('
  SELECT * FROM calles
  WHERE id_avenida = :id_avenida OR id_parroquia = :id_parroquia
');

$stmt->execute([
  ':id_avenida' => $_GET['id_avenida'] ?? null,
  ':id_parroquia' => $_GET['id_parroquia']
]);

exit(json_encode($stmt->fetchAll()));
