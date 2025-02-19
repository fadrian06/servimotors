<?php

declare(strict_types=1);

namespace Servimotors\Modelos;

use Stringable;

final readonly class TipoDeCombustible implements Stringable
{
  function __construct(public int $id, public string $tipo) {}

  function __toString(): string
  {
    return mb_convert_case($this->tipo, MB_CASE_TITLE);
  }
}
