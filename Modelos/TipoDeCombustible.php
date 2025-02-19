<?php

declare(strict_types=1);

namespace Servimotors\Modelos;

use Stringable;

final readonly class TipoDeCombustible implements Stringable
{
  /** @deprecated */
  public int $tipoCombustibleId;

  /** @deprecated */
  public string $tipoCombustible;

  public int $id;

  function __toString(): string
  {
    return mb_convert_case($this->tipoCombustible, MB_CASE_TITLE);
  }
}
