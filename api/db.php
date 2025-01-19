<?php

function db(): PDO
{
  static $pdo = null;

  if (!$pdo) {
    $pdo = new PDO(
      dsn: 'sqlite:' . dirname(__DIR__) . '/database/venezuela.db',
      options: [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
  }

  assert($pdo instanceof PDO);

  return $pdo;
}
