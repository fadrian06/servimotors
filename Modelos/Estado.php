<?php

declare(strict_types=1);

namespace Servimotors\Modelos;

use Stringable;

final readonly class Estado implements Stringable
{
  /** @deprecated */
  public int $estadoId;

  /** @deprecated */
  public string $nombreEstado;

  public int $id;

  function __toString(): string
  {
    return mb_convert_case($this->nombreEstado, MB_CASE_TITLE);
  }
}
