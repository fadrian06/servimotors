<?php include __DIR__ . '/../Partes/head.php' ?>

<div class="container">
  <h2 class="text-center">Vehículos Registrados</h2>
  <div class="table-responsive">
    <table class="table table-stripe">
      <thead class="table-dark text-nowrap">
        <tr>
          <th>Cédula</th>
          <th>Primer Nombre</th>
          <th>Segundo Nombre</th>
          <th>Primer Apellido</th>
          <th>Segundo Apellido</th>
          <th>Teléfono Personal</th>
          <th>Teléfono Fijo</th>
          <th>Teléfono Opcional</th>
          <th>Dirección</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $stmt->fetch()): ?>
          <tr>
            <td><?= $row['Cédula'] ?></td>
            <td><?= $row['Primer Nombre'] ?></td>
            <td><?= $row['Segundo Nombre'] ?></td>
            <td><?= $row['Primer Apellido'] ?></td>
            <td><?= $row['Segundo Apellido'] ?></td>
            <td><?= $row['Teléfono Personal'] ?></td>
            <td><?= $row['Teléfono Fijo'] ?></td>
            <td><?= $row['Teléfono Opcional'] ?></td>
            <td><?= $row['Dirección'] ?></td>
            <td>
              <button
                class="btn btn-warning btn-sm"
                onclick="editClient('<?= $row['Cédula'] ?>')">
                Modificar
              </button>
              <button
                class="btn btn-danger btn-sm"
                onclick="deleteClient('<?= $row['Cédula'] ?>')">
                Eliminar
              </button>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
  </div>
</div>
