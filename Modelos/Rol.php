<?php

declare(strict_types=1);

namespace Servimotors\Modelos;

use Stringable;

final readonly class Rol implements Stringable
{
  function __construct(private int $id, private string $nombre) {}

  public function __toString(): string
  {
    return mb_convert_case($this->nombre, MB_CASE_TITLE);
  }
}
