<?php

require_once __DIR__ . '/../../config/Database.php';

$stmt = Database::getConnection()
  ->query('
    SELECT *
    FROM servicios
    JOIN vehiculos
    JOIN modelos
    JOIN marcas
    JOIN empleados
    ON servicios.placaVehiculo = vehiculos.placa
    AND vehiculos.modeloId = modelos.modeloId
    AND modelos.marcaId = marcas.marcaId
    AND servicios.cedulaMecanico = empleados.cedula
  ');

$tableId = uniqid();

?>

<?php include __DIR__ . '/../Partes/head.php' ?>

<div class="container py-5 d-flex justify-content-center align-items-center">
  <a href="./servicios-agregar.php" class="btn btn-primary">
    Registrar Servicio
  </a>
</div>

<div class="container">
  <h2 class="text-center">Servicios Registrados</h2>
  <div class="table-responsive">
    <table id="<?= $tableId ?>" class="table table-stripe">
      <thead class="table-dark text-nowrap">
        <tr>
          <th>Vehículo</th>
          <th>Motivo</th>
          <th>Costo</th>
          <th>Fecha de entrada</th>
          <th>Fecha de salida</th>
          <th>Kilometraje</th>
          <th>Categoría</th>
          <th>Mecánico</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $stmt?->fetch()): ?>
          <tr>
            <td>
              <?= "{$row['nombreMarca']} ({$row['nombreModelo']}) - {$row['anio']} #{$row['placa']}" ?>
            </td>
            <td><?= $row['motivo'] ?></td>
            <td><?= $row['costo'] ?></td>
            <td><?= $row['fechaEntrada'] ?></td>
            <td><?= $row['fechaSalida'] ?></td>
            <td><?= $row['kilometraje'] ?></td>
            <td><?= $row['categoria'] ?></td>
            <td><?= "{$row['primerNombre']} {$row['primerApellido']}" ?></td>
            <td>
              <a
                href="./servicios-editar.php?id=<?= $row['id'] ?>"
                class="btn btn-warning btn-sm">
                Modificar
              </a>
              <button
                onclick="deleteService(`<?= $row['id'] ?>`)"
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

  function deleteService(id) {
    Swal.fire({
      text: '¿Está seguro de que desea eliminar este servicio?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
      if (result.isConfirmed) {
        fetch(`../../api/servicios/?id=${id}`, {
            method: 'delete'
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              Swal.fire({
                text: 'El servicio ha sido eliminado correctamente.',
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

<?php include __DIR__ . '/../Partes/footer.php' ?>
