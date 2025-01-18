<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../functions.php';

$stmt = db()->prepare('SELECT * FROM estados WHERE id = ?');
$stmt->execute([$_GET['id']]);

json($stmt->fetch(PDO::FETCH_ASSOC));
