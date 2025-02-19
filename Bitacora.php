<?php

declare(strict_types=1);

namespace Servimotors;

use Database;
use PDOException;

require_once __DIR__ . '/config/Database.php';

abstract readonly class Bitacora
{
  final static function guardar(
    string $titulo,
    string $descripcion,
    TipoDeBitacora $tipo
  ): void {
    try {
      $pdo = Database::getConnection();

      $sentencia = $pdo->prepare('
        INSERT INTO bitacora (titulo, descripcion, tipo)
        VALUES (?, ?, ?)
      ');

      $sentencia->execute([$titulo, $descripcion, $tipo->obtenerValor()]);
    } catch (PDOException $error) {
      throw $error;
    }
  }
}

if (!enum_exists(TipoDeBitacora::class)) {
  enum TipoDeBitacora
  {
    case EXITO;
    case ADVERTENCIA;
    case INFORMACION;

    function obtenerValor(): string
    {
      return match ($this) {
        self::EXITO => 'Éxito',
        self::ADVERTENCIA => 'Advertencia',
        self::INFORMACION => 'Información',
      };
    }
  }
}
