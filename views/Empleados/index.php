<?php

require_once __DIR__ . '/../../config/Database.php';

$stmt = Database::getConnection()->query('SELECT * FROM empleados');

$tableId = uniqid();

?>

<?php include __DIR__ . '/../Partes/head.php' ?>

<div class="container py-5 d-flex justify-content-center align-items-center">
  <a href="./empleados-registrar.php" class="btn btn-primary">
    Registrar Empleado
  </a>
</div>

<div class="container">
  <h2 class="text-center">Empleados Registrados</h2>
  <div class="table-responsive">
    <table id="<?= $tableId ?>" class="table table-stripe">
      <thead class="table-dark text-nowrap">
        <tr>
          <th>Cedula</th>
          <th>Nombre completo</th>
          <th>Género</th>
          <th>Fecha de nacimiento</th>
          <th>Fecha de ingreso</th>
          <th>Correo</th>
          <th>Teléfonos</th>
          <th>Rol</th>
          <th>Experiencia laboral</th>
          <th>Cerificación</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $stmt?->fetch()): ?>
          <tr>
            <td><?= $row['cedula'] ?></td>
            <td><?= "{$row['primerNombre']} {$row['segundoNombre']} {$row['primerApellido']} {$row['segundoApellido']}" ?></td>
            <td><?= $row['genero'] ?></td>
            <td><?= $row['fechaNacimiento'] ?></td>
            <td><?= $row['fechaIngreso'] ?></td>
            <td><?= $row['correo'] ?></td>
            <td><?= join(', ', [$row['telefonoLocal'], $row['telefonoPersonal'], $row['telefonoAdicional']]) ?></td>
            <td><?= $row['rol'] ?></td>
            <td><?= $row['experienciaLaboral'] ?></td>
            <td><?= $row['certificacion'] ?></td>
            <td><span class="badge badge-primary"><?= $row['estado'] ?></span></td>
            <td>
              <a
                href="./empleados-editar.php?cedula=<?= $row['cedula'] ?>"
                class="btn btn-warning btn-sm">
                Modificar
              </a>
              <button
                onclick="deleteEmpleado(`<?= $row['cedula'] ?>`)"
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

  function deleteEmpleado(cedula) {
    Swal.fire({
      text: '¿Está seguro de que desea eliminar este empleado?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
      if (result.isConfirmed) {
        fetch(`../../api/empleados/?cedula=${cedula}`, {
            method: 'delete'
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              Swal.fire({
                text: 'El empleado ha sido eliminado correctamente.',
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
