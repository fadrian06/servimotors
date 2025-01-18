<?php

require_once __DIR__ . '/../db.php';

$stmt = $pdo->prepare('SELECT * FROM avenidas WHERE id_parroquia = ?');
$stmt->execute([$_GET['id_parroquia']]);

exit(json_encode($stmt->fetchAll()));
