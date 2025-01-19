<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../functions.php';

$stmt = Database::getConnection()->query('
  SELECT *
  FROM tipos_combustible
') ?: null;

json($stmt->fetchAll());
