<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../../funciones.php';

$stmt = db()->prepare('SELECT * FROM parroquias WHERE id = ?');
$stmt->execute([$_GET['id']]);

json($stmt->fetch(PDO::FETCH_ASSOC));
