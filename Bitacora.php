<?php

declare(strict_types=1);

namespace Servimotors;

use Database;
use PDO;
use PDOException;

require_once __DIR__ . '/config/Database.php';

final readonly class Bitacora
{
  public int $id;
  public string $titulo;
  public string $descripcion;

  /** @deprecated */
  public string $fecha;

  /** @var 'Éxito'|'Advertencia'|'Información' */
  public string $tipo;

  static function crear(
    string $titulo,
    string $descripcion,
    TipoDeBitacora $tipo
  ): self {
    try {
      $pdo = Database::getConnection();

      $sentencia = $pdo->prepare('
        INSERT INTO bitacora (titulo, descripcion, tipo)
        VALUES (:titulo, :descripcion, :tipo)
      ');

      $parametros = [
        ':titulo' => $titulo,
        ':descripcion' => $descripcion,
        ':tipo' => $tipo->value
      ];

      $sentencia->execute($parametros);
      $id = $pdo->lastInsertId();

      return $pdo
        ->query("SELECT * FROM bitacora WHERE id = $id")
        ->fetchObject(__CLASS__);
    } catch (PDOException $error) {
      throw $error;
    }
  }

  /** @return self[] */
  static function listado(): array
  {
    $pdo = Database::getConnection();

    return $pdo
      ->query('SELECT * FROM bitacora ORDER BY fecha DESC')
      ->fetchAll(PDO::FETCH_CLASS, __CLASS__);
  }
}

if (!enum_exists(TipoDeBitacora::class)) {
  enum TipoDeBitacora: string
  {
    case EXITO = 'Éxito';
    case ADVERTENCIA = 'Advertencia';
    case INFORMACION = 'Información';
  }
}
