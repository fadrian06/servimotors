<?php define('QUERY_INPUT_ID', uniqid()) ?>

<li class="dropdown">
  <button class="nav-link nav-icon bi bi-search" data-bs-toggle="dropdown"></button>

  <form
    class="dropdown-menu dropdown-menu-end p-0"
    method="post"
    action="javascript:"
    style="min-width: max-content">
    <div class="input-group">
      <div class="form-floating">
        <input
          id="<?= QUERY_INPUT_ID ?>"
          type="search"
          name="query"
          title="Ingrese palabra clave para buscar"
          required
          class="form-control pe-5"
          placeholder="" />
        <label for="<?= QUERY_INPUT_ID ?>">
          Buscar vehículo o repuesto
        </label>
      </div>
      <button class="btn btn-primary">Buscar</button>
    </div>
  </form>
</li>
