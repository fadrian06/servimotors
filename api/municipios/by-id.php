<?php

require_once __DIR__ . '/../db.php';

$stmt = $pdo->prepare('SELECT * FROM municipios WHERE id = ?');
$stmt->execute([$_GET['id']]);

exit(json_encode($stmt->fetch(PDO::FETCH_ASSOC)));
