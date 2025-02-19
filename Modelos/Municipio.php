<?php

declare(strict_types=1);

final readonly class Municipio implements Stringable
{
  /** @deprecated */
  public int $municipioId;

  /** @deprecated */
  public string $nombreMunicipio;

  /** @deprecated */
  public int $estadoId;

  public int $id;

  function __toString(): string
  {
    return mb_convert_case($this->nombreMunicipio, MB_CASE_TITLE);
  }
}
