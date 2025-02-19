<?php

use Servimotors\Bitacora;
use Servimotors\TipoDeBitacora;

require_once __DIR__ . '/../../../config/Database.php';
require_once __DIR__ . '/../../../Bitacora.php';
require_once __DIR__ . '/../../../funciones.php';
require_once __DIR__ . '/../../../CRUD/Clientes/ClientValidator.php';

final readonly class ClientRegistration
{
  private PDO $pdo;
  private ClientValidator $validator;

  function __construct(
    ?PDO $pdo = null,
    ?ClientValidator $clientValidator = null
  ) {
    $this->pdo = $pdo ?? Database::getConnection();
    $this->validator = $clientValidator ?? new ClientValidator;
  }

  function register(array $data)
  {
    if (!$this->validator->validateForm($data)) {
      return [
        'success' => false,
        'mensaje' => implode(", ", $this->validator->getErrors())
      ];
    }

    try {
      $this->pdo->beginTransaction();

      // Procesar la dirección (insertando o recuperando IDs en orden)
      $estadoId = $this->getOrCreateId(
        'Estados',
        'estadoId',
        'nombreEstado',
        $data['state']
      );

      $municipioId = $this->getOrCreateId(
        'Municipios',
        'municipioId',
        'nombreMunicipio',
        $data['municipality'],
        'estadoId',
        $estadoId
      );

      $parroquiaId = $this->getOrCreateId(
        'Parroquias',
        'parroquiaId',
        'nombreParroquia',
        $data['parish'] ?? '',
        'municipioId',
        $municipioId
      );

      $avenidaId = $this->getOrCreateId(
        'Avenidas',
        'avenidaId',
        'nombreAvenida',
        $data['avenue'],
        'parroquiaId',
        $parroquiaId
      );

      $calleId = $this->getOrCreateId(
        'Calles',
        'calleId',
        'nombreCalle',
        $data['street'],
        'avenidaId',
        $avenidaId
      );

      // TODO: add housingType in `CasasApartamentos` table
      $casaApartamentoId = $this->getOrCreateId(
        'CasasApartamentos',
        'casaApartamentoId',
        'detalleCasaApartamento',
        $data['housingNumber'],
        'calleId',
        $calleId
      );

      // Limpiar la cédula
      $nacionalidad = substr($data['cedula'], 0, 1);
      $cedula = str_replace(['V-', 'E-'], '', $data['cedula']);

      // Insertar cliente
      $stmt = $this->pdo->prepare('
        INSERT INTO Clientes (
          cedula,
          primerNombre,
          segundoNombre,
          primerApellido,
          segundoApellido,
          nacionalidad
        ) VALUES (?, ?, ?, ?, ?, ?)
      ');

      $stmt->execute([
        $cedula,
        $data['firstName'],
        $data['secondName'] ?? '',
        $data['firstSurname'],
        $data['secondSurname'] ?? '',
        $nacionalidad
      ]);

      // Insertar teléfonos
      $stmt = $this->pdo->prepare('
        INSERT INTO Telefonos (
          cedulaCliente,
          telefonoPersonal,
          telefonoFijo,
          telefonoOpcional
        ) VALUES (?, ?, ?, ?)
      ');

      $stmt->execute([
        $cedula,
        $data['personalPhone'],
        $data['landlinePhone'] ?? '',
        $data['optionalPhone'] ?? ''
      ]);

      // Insertar dirección
      $stmt = $this->pdo->prepare('
        INSERT INTO Direcciones (cedulaCliente, casaApartamentoId)
        VALUES (?, ?)
      ');

      $stmt->execute([$cedula, $casaApartamentoId]);

      $this->pdo->commit();

      return [
        'success' => true,
        'mensaje' => 'Cliente registrado exitosamente'
      ];
    } catch (PDOException $error) {
      $this->pdo->rollBack();

      $error = match (true) {
        str_contains(strtolower($error->getMessage()), 'primary') => 'Ya existe un cliente con esa cédula',
        default => $error->getMessage()
      };

      return [
        'success' => false,
        'mensaje' => "Error al registrar cliente: $error"
      ];
    }
  }

  private function getOrCreateId(
    string $table,
    string $idColumn,
    string $nameColumn,
    int|float|string|bool|null $value,
    int|float|string|null $parentIdColumn = null,
    int|float|string|null $parentId = null
  ) {
    try {
      // Preparar la consulta según si tiene o no padre
      if ($parentIdColumn) {
        $stmt = $this->pdo->prepare(
          "
          SELECT $idColumn FROM $table
          WHERE $nameColumn = ? AND $parentIdColumn = ?"
        );

        $stmt->execute([$value, $parentId]);
      } else {
        $stmt = $this->pdo->prepare(
          "
          SELECT $idColumn FROM $table
          WHERE $nameColumn = ?"
        );

        $stmt->execute([$value]);
      }

      $id = $stmt->fetchColumn();

      // Si no existe, insertar
      if (!$id) {
        if ($parentIdColumn) {
          $stmt = $this->pdo->prepare("
            INSERT INTO $table ($nameColumn, $parentIdColumn)
            VALUES (?, ?)
          ");

          $stmt->execute([$value, $parentId]);
        } else {
          $stmt = $this->pdo->prepare("
            INSERT INTO $table ($nameColumn)
            VALUES (?)
          ");

          $stmt->execute([$value]);
        }

        $id = $this->pdo->lastInsertId();
      }

      return $id;
    } catch (PDOException $error) {
      exit("Error procesando $table: {$error->getMessage()}");
    }
  }
}

// Manejar la solicitud
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $registration = new ClientRegistration;
  $result = $registration->register($_POST);

  Bitacora::crear(
    'Nuevo cliente registrado',
    "El cliente {$_POST['cedula']} {$_POST['firstName']} {$_POST['firstSurname']} ha sido registrado exitosamente el " . date('Y-m-d H:i:s'),
    TipoDeBitacora::EXITO
  );

  json($result);
}
