<?php

declare(strict_types=1);

final readonly class Vehiculo
{
  public string $placa;

  /** @deprecated */
  public string $cedulaCliente;

  /** @deprecated */
  public int $modeloId;

  /** @deprecated */
  public int $tipoCombustibleId;

  /** @deprecated */
  public int $anio;

  public string $clave;
  public int $año;
}
