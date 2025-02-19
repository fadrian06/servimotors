<?php

declare(strict_types=1);

final readonly class Marca implements Stringable
{
  /** @deprecated */
  public int $marcaId;

  /** @deprecated */
  public string $nombreMarca;

  public int $id;

  function __toString(): string
  {
    return mb_convert_case($this->nombreMarca, MB_CASE_TITLE);
  }
}
