<?php

function json(mixed $value, int $status = 200): never
{
  header('content-type: application/json');
  http_response_code($status);

  exit(json_encode($value));
}
