<?php

declare(strict_types=1);

final readonly class Servicio
{
  public int $id;

  /** @deprecated */
  public string $placaVehiculo;

  public string $motivo;
  public float $costo;

  /** @deprecated */
  public string $fechaEntrada;

  /** @deprecated */
  public string $fechaSalida;

  public int $kilometraje;

  /** @var 'Mantenimiento'|'Reparación'|'Revisión' */
  public string $categoria;

  /** @deprecated */
  public string $cedulaMecanico;
}
