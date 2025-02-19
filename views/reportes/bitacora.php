<?php

declare(strict_types=1);

use Servimotors\Bitacora;

require_once __DIR__ . '/../../Bitacora.php';

$bitacora = Bitacora::listado();
$json = json_encode($bitacora);

include __DIR__ . '/../Partes/head.php';

?>

<div
  class="table-responsive"
  x-data='{
    bitacora: JSON.parse(`<?= $json ?>`),
    bitacoraFiltrada: [],
    fecha: ``,
    tipo: ``,
    titulo: ``,
    descripcion: ``,

    filtrarPorFecha() {
      this.bitacoraFiltrada = this.bitacora.filter((bitacora) => {
        return bitacora.fecha >= this.fecha;
      });
    },

    filtrarPorTipo() {
      this.bitacoraFiltrada = this.bitacora.filter((bitacora) => {
        if (!this.tipo) {
          return true;
        }

        return bitacora.tipo === this.tipo;
      });
    },

    filtrarPorTitulo() {
      this.bitacoraFiltrada = this.bitacora.filter((bitacora) => {
        return bitacora.titulo.includes(this.titulo);
      });
    },

    filtrarPorDescripcion() {
      this.bitacoraFiltrada = this.bitacora.filter((bitacora) => {
        return bitacora.descripcion.includes(this.descripcion);
      });
    }
  }'
  x-init="bitacoraFiltrada = bitacora">
  <div class="container">
    <form class="row">
      <div class="col-lg-6 mb-3">
        <div class="form-floating">
          <input
            type="datetime-local"
            x-model="fecha"
            class="form-control"
            placeholder=""
            @input="filtrarPorFecha" />
          <label>Fecha posterior al</label>
        </div>
      </div>

      <div class="col-lg-6 mb-3">
        <div class="form-floating">
          <select x-model="tipo" class="form-select" @change="filtrarPorTipo">
            <option value="">Todas</option>
            <option>Éxito</option>
            <option>Advertencia</option>
            <option>Información</option>
          </select>
          <label>Filtrar por tipo</label>
        </div>
      </div>
      <div class="col-lg-6 mb-3">
        <div class="form-floating">
          <input
            x-model="titulo"
            class="form-control"
            placeholder=""
            @input="filtrarPorTitulo" />
          <label>Filtrar por título</label>
        </div>
      </div>
      <div class="col-lg-6 mb-3">
        <div class="form-floating">
          <textarea
            x-model="descripcion"
            class="form-control"
            placeholder=""
            @input="filtrarPorDescripcion"></textarea>
          <label>Filtrar por descripción</label>
        </div>
      </div>
    </form>
  </div>

  <table class="table table-hover table-striped table-bordered">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Tipo</th>
        <th>Título</th>
        <th>Descripción</th>
      </tr>
    </thead>
    <tbody>
      <template x-for="bitacora in bitacoraFiltrada" :key="bitacora.id">
        <tr>
          <td x-text="bitacora.fecha"></td>
          <td x-text="bitacora.tipo"></td>
          <td x-text="bitacora.titulo"></td>
          <td x-text="bitacora.descripcion"></td>
        </tr>
      </template>
    </tbody>
  </table>
  <div class="text-end">
    <a href="vaciar-bitacora.php" class="btn btn-outline-danger">
      Vaciar bitácora
    </a>
  </div>
</div>

<?php include __DIR__ . '/../Partes/footer.php';
