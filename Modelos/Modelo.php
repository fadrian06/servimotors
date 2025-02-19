<?php

declare(strict_types=1);

namespace Servimotors\Modelos;

use Stringable;

final readonly class Modelo implements Stringable
{
  /** @deprecated */
  public int $modeloId;

  /** @deprecated */
  public int $marcaId;

  /** @deprecated */
  public string $nombreModelo;

  public int $id;

  function __toString(): string
  {
    return mb_convert_case($this->nombreModelo, MB_CASE_TITLE);
  }
}
