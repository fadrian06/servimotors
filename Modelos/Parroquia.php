<?php

declare(strict_types=1);

final readonly class Parroquia implements Stringable
{
  /** @deprecated */
  public int $parroquiaId;

  /** @deprecated */
  public string $nombreParroquia;

  /** @deprecated */
  public int $municipioId;

  public int $id;

  function __toString(): string
  {
    return mb_convert_case($this->nombreParroquia, MB_CASE_TITLE);
  }
}
