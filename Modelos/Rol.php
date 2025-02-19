<?php

declare(strict_types=1);

final readonly class Rol implements Stringable
{
  /** @deprecated */
  public int $idRol;

  /** @deprecated */
  public string $nombreRol;

  public int $id;

  public function __toString(): string
  {
    return mb_convert_case($this->nombreRol, MB_CASE_TITLE);
  }
}
