<?php

declare(strict_types=1);

namespace Servimotors\Modelos;

final readonly class Calle implements Stringable
{
  /** @deprecated */
  public int $calleId;

  /** @deprecated */
  public string $nombreCalle;

  /** @deprecated */
  public int $avenidaId;

  public int $id;

  function __toString(): string
  {
    return mb_convert_case($this->nombreCalle, MB_CASE_TITLE);
  }
}
