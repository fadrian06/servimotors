<?php

require_once __DIR__ . '/../../config/Database.php';

$stmt = Database::getConnection()->prepare('
  SELECT * FROM vehiculos WHERE placa = ?
') ?: null;

$stmt?->execute([$_GET['placa']]);
$vehicle = $stmt?->fetch() ?: [];

$formId = uniqid();

include __DIR__ . '/../Partes/head.php';

?>

<div class="container">
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
          <div class="card mb-3">
            <div class="card-body">
              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">
                  Editar Vehículo
                </h5>
              </div>

              <form class="row g-3 needs-validation" id="form-<?= $formId ?>" novalidate>
                <!-- Identificación del Cliente -->
                <div class="col-md-12">
                  <label for="clientID" class="form-label">
                    Cédula del cliente
                  </label>
                  <input
                    type="number"
                    name="clientID"
                    class="form-control"
                    id="clientID"
                    min="1"
                    value="<?= $vehicle['cedulaCliente'] ?>" />
                  <div class="invalid-feedback">
                    Ingrese la cédula de un cliente válida.
                  </div>
                </div>

                <!-- Marca -->
                <div class="col-md-6">
                  <label for="brand" class="form-label">Marca</label>

                  <select
                    name="brand"
                    id="brand"
                    class="form-select">
                    <option value=""></option>
                  </select>
                  <div class="invalid-feedback">Ingrese una marca válida.</div>
                </div>

                <!-- Modelo -->
                <div class="col-md-6">
                  <label for="model" class="form-label">Modelo</label>
                  <select
                    name="model"
                    id="model"
                    class="form-select">
                    <option value=""></option>
                  </select>
                  <div class="invalid-feedback">Ingrese un modelo válido.</div>
                </div>

                <!-- Año -->
                <div class="col-md-6">
                  <label for="year" class="form-label">Año</label>
                  <input
                    type="number"
                    name="year"
                    class="form-control"
                    id="year"
                    min="1900"
                    max="<?= date('Y') ?>"
                    value="<?= $vehicle['anio'] ?>" />
                  <div class="invalid-feedback">Ingrese un año válido.</div>
                </div>

                <!-- Placa -->
                <div class="col-md-6">
                  <label for="plate" class="form-label">Placa</label>
                  <input
                    name="plate"
                    class="form-control"
                    id="plate"
                    minlength="6"
                    maxlength="8"
                    pattern="[A-Z0-9]{6,8}"
                    value="<?= $vehicle['placa'] ?>" />
                  <div class="invalid-feedback">Ingrese una placa válida.</div>
                </div>

                <!-- Tipo de Combustible -->
                <div class="col-md-12">
                  <label for="fuelType" class="form-label">
                    Tipo de Combustible
                  </label>
                  <select
                    class="form-select"
                    name="fuelType"
                    id="fuelType">
                    <option value="" selected disabled>
                      Seleccione un tipo de combustible
                    </option>
                  </select>
                  <div class="invalid-feedback">
                    Seleccione un tipo de combustible.
                  </div>
                </div>

                <!-- Clave (Llave) -->
                <div class="col-md-12">
                  <label for="key" class="form-label">Clave (Llave)</label>
                  <input
                    type="password"
                    name="key"
                    class="form-control"
                    id="key"
                    minlength="4"
                    maxlength="20"
                    pattern="[A-Za-z0-9@!#\$%\^\&\*\(\)_\-]{4,20}" />
                  <div class="invalid-feedback">
                    Ingrese una clave válida (4-20 caracteres, letras, números
                    o caracteres especiales).
                  </div>
                </div>

                <!-- Botón de registro -->
                <div class="col-12">
                  <button class="btn btn-primary w-100">
                    Actualizar Vehículo
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script async="false">
  const $form = document.querySelector('#form-<?= $formId ?>');
  const $selectBrand = $form.brand
  const $selectModel = $form.model
  const $selectFuelType = $form.fuelType

  fetch('../../api/marcas/')
    .then(response => response.json())
    .then(brands => {
      for (const initial in brands) {
        $selectBrand.innerHTML += `
          <optgroup label="${initial}">
            ${brands[initial].map(brand => `
              <option value="${brand.marcaId}">${brand.nombreMarca}</option>
            `).join('')}
          </optgroup>
        `
      }
    })

  fetch('../../api/tipos-combustible/')
    .then(response => response.json())
    .then(fuelTypes => {
      $selectFuelType.innerHTML += fuelTypes.map(fuelType => `
        <option value="${fuelType.tipoCombustibleId}">
          ${fuelType.tipoCombustible}
        </option>
      `).join('')
    })

  $selectBrand.addEventListener('change', () => {
    $selectModel.innerHTML = `<option value=""></option>`

    fetch(`../../api/modelos/?id_marca=${$selectBrand.value}`)
      .then(response => response.json())
      .then(models => {
        for (const initial in models) {
          $selectModel.innerHTML += `
            <optgroup label="${initial}">
              ${models[initial].map(model => `
                <option value="${model.modeloId}">${model.nombreModelo}</option>
              `)}
            </optgroup>
          `
        }
      })
  })

  // Validación de campos al introducir datos
  $form.querySelectorAll('input, select').forEach($field => {
    $field.addEventListener('input', () => {
      $field.setCustomValidity('');

      if (!$field.checkValidity()) {
        $field.classList.add('is-invalid');
      } else {
        $field.classList.remove('is-invalid');
      }
    });
  });

  // Validación al enviar el formulario
  $form.addEventListener('submit', async event => {
    event.preventDefault();

    // Validar el formulario completo
    if (!$form.checkValidity()) {
      Swal.fire({
        icon: 'error',
        title: 'Formulario inválido',
        text: 'Por favor complete correctamente los campos.',
      });

      return;
    }

    // Procesamiento del registro con fetch
    try {
      const formData = new FormData($form);

      // Mostrar indicador de carga
      Swal.fire({
        title: 'Procesando',
        text: 'Por favor espere...',
        allowOutsideClick: false,
        didOpen() {
          Swal.showLoading()
        }
      });

      const response = await fetch(`../../api/vehiculos/?placa=${formData.get('plate')}`, {
        method: 'PATCH',
        body: JSON.stringify(Object.fromEntries(formData)),
        headers: {
          'content-type': 'application/json'
        }
      });

      const result = await response.json();

      if (result.success) {
        Swal.fire({
          icon: 'success',
          text: 'El vehículo ha sido actualizado exitosamente.',
        }).then(() => {
          location.href = './'
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: result.message || 'Error al registrar vehículo'
        });

        result.debug && console.error(result.debug)
      }
    } catch (error) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Ocurrió un error al procesar la solicitud'
      });
    }
  });
</script>

<?php include __DIR__ . '/../Partes/footer.php' ?>
