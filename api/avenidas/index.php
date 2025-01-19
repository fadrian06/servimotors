<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../../functions.php';

$stmt = db()->prepare('SELECT * FROM avenidas WHERE id_parroquia = ?');
$stmt->execute([$_GET['id_parroquia']]);

json($stmt->fetchAll());
