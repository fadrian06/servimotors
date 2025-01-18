<?php

$pdo = new PDO('sqlite:' . dirname(__DIR__) . '/database/venezuela.db', options: [
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
