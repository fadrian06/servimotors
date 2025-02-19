<?php

declare(strict_types=1);

final readonly class Usuario
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

  /** @deprecated */
  public int $idRol;

  /** @deprecated */
  public string $nombreUsuario;

  /** @deprecated */
  public string $contrasena;

  public string $alias;
  public string $telefono;
  public string $correo;
}
