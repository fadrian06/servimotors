<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/environment.php';
require_once __DIR__ . '/../config/Database.php';

try {
  $pdo = Database::getMysqlConnection() ?? Database::getSqliteConnection();
} catch (PDOException $exception) {
  echo $exception->getMessage();

  exit(1);
}

$pdo->exec("DROP DATABASE IF EXISTS `{$_ENV['DB_DATABASE']}`");
$pdo->exec("CREATE DATABASE `{$_ENV['DB_DATABASE']}`");
$pdo->exec("USE `{$_ENV['DB_DATABASE']}`");

$sqlFilePath = __DIR__ . "/../database/servimotors.v1.{$_ENV['DB_CONNECTION']}.sql";

if (!file_exists($sqlFilePath)) {
  echo "File not found: $sqlFilePath";

  exit(1);
}

$sqlContents = file_get_contents($sqlFilePath);
$queries = explode(';', file_get_contents($sqlFilePath));
$pdo->beginTransaction();

foreach ($queries as $query) {
  if (!trim($query)) {
    continue;
  }

  try {
    $pdo->exec($query);
  } catch (PDOException $exception) {
    if ($pdo->inTransaction()) {
      $pdo->rollBack();
    }

    echo "Error executing query: $query ({$exception->getMessage()})";

    exit(1);
  }
}

if ($pdo->inTransaction()) {
  $pdo->commit();
}

echo 'Database reinstalled successfully';
