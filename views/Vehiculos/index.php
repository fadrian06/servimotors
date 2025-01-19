<?php

require_once __DIR__ . '/../../config/Database.php';

$stmt = Database::getConnection()->query('
  SELECT *, marcas.nombreMarca as marca,
  modelos.nombreModelo as modelo
  FROM vehiculos
  -- JOIN clientes
  JOIN modelos
  JOIN marcas
  JOIN tipos_combustible
  ON /*vehiculos.cedulaCliente = clientes.cedula
  AND*/ vehiculos.modeloId = modelos.modeloId
  AND modelos.marcaId = marcas.marcaId
  AND vehiculos.tipoCombustibleId = tipos_combustible.tipoCombustibleId
');

$tableId = uniqid();

?>

<?php include __DIR__ . '/../Partes/head.php' ?>

<div class="container py-5 d-flex justify-content-center align-items-center">
  <a href="./vehiculos-agregar.php" class="btn btn-primary">
    Registrar Vehículo
  </a>
</div>

<div class="container">
  <h2 class="text-center">Vehículos Registrados</h2>
  <div class="table-responsive">
    <table id="<?= $tableId ?>" class="table table-stripe">
      <thead class="table-dark text-nowrap">
        <tr>
          <th>Placa</th>
          <th>Cédula del cliente</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Tipo de combustible</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $stmt?->fetch()): ?>
          <tr>
            <td><?= $row['placa'] ?></td>
            <td><?= $row['cedulaCliente'] ?></td>
            <td><?= $row['marca'] ?></td>
            <td><?= $row['modelo'] ?></td>
            <td><?= $row['tipoCombustible'] ?></td>
            <td>
              <a
                href="./editar-vehiculo.php?placa=<?= $row['placa'] ?>"
                class="btn btn-warning btn-sm">
                Modificar
              </a>
              <button
                onclick="deleteVehicle(`<?= $row['placa'] ?>`)"
                class="btn btn-danger btn-sm">
                Eliminar
              </button>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
  </div>
</div>

<script async="false">
  $('#<?= $tableId ?>').DataTable({
    responsive: true,
    language: {
      url: '../../assets/vendor/simple-datatables/es-ES.json'
    }
  });

  function deleteVehicle(plate) {
    Swal.fire({
      text: '¿Está seguro de que desea eliminar este vehículo?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
      if (result.isConfirmed) {
        fetch(`../../api/vehiculos/?placa=${plate}`, {
            method: 'delete'
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              Swal.fire({
                text: 'El vehículo ha sido eliminado correctamente.',
                icon: 'success'
              }).then(() => location.reload());
            } else {
              Swal.fire({
                text: data.message,
                icon: 'error'
              });
            }
          });
      }
    })
  }
</script>
