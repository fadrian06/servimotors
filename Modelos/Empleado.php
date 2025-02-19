<?php

declare(strict_types=1);

final readonly class Empleado
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

  /** @var 'M'|'F' */
  public string $genero;

  /** @deprecated */
  public string $fechaNacimiento;

  /** @deprecated */
  public string $fechaIngreso;

  public string $correo;

  /** @deprecated */
  public int $casaApartamentoId;

  /**
   * @var 'Mecánico'
   *   |'Electricista'
   *   |'Transmisión'
   *   |'Aire Acondicionado'
   *   |'Ayudante'
   *   |'Mensajero'
   *   |'Limpieza'
   */
  public string $rol;

  /** @deprecated */
  public string $experienciaLaboral;

  /** @deprecated */
  public string $certificacion;

  /** @deprecated */
  public string $habilidadTecnica;

  /**
   * @var 'Activo'|'Inactivo'
   * @deprecated
   */
  public string $estado;

  // TODO: telefonos

  function estaActivo(): bool
  {
    return $this->estado === 'Activo';
  }
}
