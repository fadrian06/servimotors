<?php

declare(strict_types=1);

final readonly class Avenida implements Stringable
{
  /** @deprecated */
  public int $avenidaId;

  /** @deprecated */
  public string $nombreAvenida;

  /** @deprecated */
  public int $parroquiaId;

  public int $id;

  function __toString(): string
  {
    return mb_convert_case($this->nombreAvenida, MB_CASE_TITLE);
  }
}
