<?php

require_once __DIR__ . '/../db.php';

$stmt = db()->prepare('SELECT * FROM municipios WHERE id = ?');
$stmt->execute([$_GET['id']]);

json($stmt->fetch(PDO::FETCH_ASSOC));
