<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../functions.php';

// Crear una instancia de la clase Database
$conn = Database::getConnection();

// Consulta para obtener los datos de los clientes
$sql = "
  SELECT
    c.cedula AS 'Cédula',
    c.primerNombre AS 'Primer Nombre',
    c.segundoNombre AS 'Segundo Nombre',
    c.primerApellido AS 'Primer Apellido',
    c.segundoApellido AS 'Segundo Apellido',
    t.telefonoPersonal AS 'Teléfono Personal',
    t.telefonoFijo AS 'Teléfono Fijo',
    t.telefonoOpcional AS 'Teléfono Opcional',
    CONCAT(ca.detalleCasaApartamento, ', ', cl.nombreCalle, ', ', av.nombreAvenida, ', ', p.nombreParroquia, ', ', m.nombreMunicipio, ', ', e.nombreEstado) AS 'Dirección'
  FROM Clientes c
  JOIN Telefonos t ON c.cedula = t.cedulaCliente
  JOIN Direcciones d ON c.cedula = d.cedulaCliente
  JOIN CasasApartamentos ca ON d.casaApartamentoId = ca.casaApartamentoId
  JOIN Calles cl ON ca.calleId = cl.calleId
  JOIN Avenidas av ON cl.avenidaId = av.avenidaId
  JOIN Parroquias p ON av.parroquiaId = p.parroquiaId
  JOIN Municipios m ON p.municipioId = m.municipioId
  JOIN Estados e ON m.estadoId = e.estadoId
";

// Ejecutar la consulta y mostrar los datos en la tabla
$stmt = $conn->query($sql) ?: null;

json([
  'data' => $stmt?->fetchAll(
    PDO::FETCH_FUNC,
    static fn(int|string|null ...$client): array => [
      (int) $client[0],
      $client[1],
      $client[2],
      $client[3],
      $client[4],
      $client[5],
      $client[6],
      $client[7],
      $client[8],
      <<<html
      <button
        class="btn btn-warning btn-sm"
        onclick="editClient('{$client[0]}')">
        Modificar
      </button>
      <button
        class="btn btn-danger btn-sm"
        onclick="deleteClient('{$client[0]}')">
        Eliminar
      </button>
      html
    ]
  ) ?? []
]);
