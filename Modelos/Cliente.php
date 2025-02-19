<?php

declare(strict_types=1);

final readonly class Cliente
{
  public int $cedula;

  /** @deprecated */
  public string $primerNombre;

  /** @deprecated */
  public string $segundoNombre;

  /** @deprecated */
  public string $primerApellido;

  /** @deprecated */
  public string $segundoApellido;

  // TODO: direcciones
  // TODO: telefonos
}
