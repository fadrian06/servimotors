<?php

declare(strict_types=1);

namespace Servimotors\Modelos;

use ArrayAccess;

require_once __DIR__ . '/Rol.php';

final class Usuario implements ArrayAccess
{
  public readonly int $cedula;
  public readonly string $nacionalidad;

  /** @deprecated */
  public readonly string $primerNombre;

  /** @deprecated */
  public readonly string $segundoNombre;

  /** @deprecated */
  public readonly string $primerApellido;

  /** @deprecated */
  public readonly string $segundoApellido;

  /** @deprecated */
  public readonly int $idRol;

  /** @deprecated */
  public readonly string $nombreRol;

  /** @deprecated */
  public readonly string $nombreUsuario;

  /** @deprecated */
  public readonly string $contrasena;

  /** @readonly */
  public string $alias;

  public readonly string $telefono;
  public readonly string $correo;

  /** @readonly */
  public Rol $rol;

  function offsetExists(mixed $offset): bool
  {
    return isset($this->$offset);
  }

  function offsetGet(mixed $offset): mixed
  {
    return $this->$offset;
  }

  function offsetSet(mixed $offset, mixed $value): void
  {
    $this->$offset = $value;
  }

  function offsetUnset(mixed $offset): void
  {
    unset($this->$offset);
  }
}
