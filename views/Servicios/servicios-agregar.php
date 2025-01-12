<?php include __DIR__ . '/../Partes/head.php' ?>

<div class="container">
  <section
    class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
          <div class="card mb-3">
            <div class="card-body">
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Registrar Nuevo Servicio</h5>
              </div>

              <form class="row g-3 needs-validation" id="serviceForm" novalidate>

                <!-- Vehículo Asociado -->
                <div class="col-md-12">
                  <label for="vehicle" class="form-label">Vehículo Asociado</label>
                  <select class="form-select" name="vehicle" id="vehicle" required>
                    <option value="" selected disabled>Seleccione el vehículo</option>
                    <!-- Aquí irían las opciones de vehículos, generadas dinámicamente -->
                  </select>
                  <div class="invalid-feedback">Seleccione el vehículo asociado.</div>
                </div>

                <!-- Motivo de la Falla -->
                <div class="col-md-12">
                  <label for="faultReason" class="form-label">Motivo de la Falla</label>
                  <textarea name="faultReason" class="form-control" id="faultReason" required
                    pattern="^.{10,300}$"></textarea>
                  <div class="invalid-feedback">El motivo debe tener entre 10 y 300
                    caracteres.</div>
                </div>

                <!-- Costo -->
                <div class="col-md-6">
                  <label for="cost" class="form-label">Costo</label>
                  <input type="text" name="cost" class="form-control" id="cost" required
                    pattern="^\d{1,6}(\.\d{1,2})?$">
                  <div class="invalid-feedback">Ingrese un costo válido (ej. 1000 o 1000.00).
                  </div>
                </div>

                <!-- Fecha de Entrada -->
                <div class="col-md-6">
                  <label for="entryDate" class="form-label">Fecha de Entrada</label>
                  <input type="date" name="entryDate" class="form-control" id="entryDate"
                    required>
                  <div class="invalid-feedback">Seleccione una fecha válida.</div>
                </div>

                <!-- Fecha de Salida -->
                <div class="col-md-6">
                  <label for="exitDate" class="form-label">Fecha de Salida</label>
                  <input type="date" name="exitDate" class="form-control" id="exitDate">
                  <div class="invalid-feedback">Seleccione una fecha válida.</div>
                </div>

                <!-- Kilometraje -->
                <div class="col-md-6">
                  <label for="mileage" class="form-label">Kilometraje</label>
                  <input type="text" name="mileage" class="form-control" id="mileage" required
                    pattern="^\d{1,7}$">
                  <div class="invalid-feedback">Ingrese un kilometraje válido (solo números).
                  </div>
                </div>

                <!-- Categoría -->
                <div class="col-md-12">
                  <label for="category" class="form-label">Categoría</label>
                  <select class="form-select" name="category" id="category" required>
                    <option value="" selected disabled>Seleccione la categoría</option>
                    <option value="Mantenimiento">Mantenimiento</option>
                    <option value="Reparación">Reparación</option>
                    <option value="Revisión">Revisión</option>
                  </select>
                  <div class="invalid-feedback">Seleccione una categoría de servicio.</div>
                </div>

                <!-- Mecánico Responsable -->
                <div class="col-md-12">
                  <label for="mechanic" class="form-label">Mecánico Responsable</label>
                  <input type="text" name="mechanic" class="form-control" id="mechanic"
                    required pattern="^[A-Za-z\s]{2,40}$">
                  <div class="invalid-feedback">Ingrese el nombre del mecánico (solo letras,
                    hasta 40 caracteres).</div>
                </div>

                <!-- Botón de registro -->
                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit">Registrar
                    Servicio</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('serviceForm');

    // Validación de campos al introducir datos
    form.querySelectorAll('input, select, textarea').forEach(field => {
      field.addEventListener('input', () => {
        field.setCustomValidity('');
        if (!field.checkValidity()) {
          field.classList.add('is-invalid');
        } else {
          field.classList.remove('is-invalid');
        }
      });
    });

    // Validación al enviar el formulario
    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      // Validar el formulario completo
      if (!form.checkValidity()) {
        Swal.fire({
          icon: 'error',
          title: 'Formulario incompleto',
          text: 'Por favor complete correctamente todos los campos.',
        });
        return;
      }

      // Procesamiento del registro con fetch
      try {
        const formData = new FormData(form);

        // Mostrar indicador de carga
        Swal.fire({
          title: 'Procesando',
          text: 'Por favor espere...',
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });

        const response = await fetch('registro_servicio.php', {
          method: 'POST',
          body: formData
        });

        const result = await response.json();

        if (result.success) {
          Swal.fire({
            icon: 'success',
            title: 'Servicio registrado',
            text: 'El servicio ha sido registrado exitosamente.',
          }).then(() => {
            form.reset(); // Limpiar el formulario después del registro exitoso
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: result.mensaje || 'Error al registrar servicio'
          });
        }
      } catch (error) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Ocurrió un error al procesar la solicitud'
        });
      }
    });
  });
</script>

<?php include __DIR__ . '/../Partes/footer.php' ?>
