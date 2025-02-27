<img src="assets/img/Logo.png" class="img-fluid col-lg-4" />

<div class="col-12 col-lg-4">
  <form
    id="loginForm"
    class="card card-body row-gap-3 needs-validation"
    novalidate>
    <h1 class="card-title text-center fs-4">Datos de su cuenta</h1>
    <label class="form-floating">
      <input
        name="username"
        class="form-control"
        value="Ander"
        required
        placeholder="" />
      <label>Nombre de usuario</label>
      <div class="invalid-feedback">
        Por favor, ingrese su nombre de usuario.
      </div>
    </label>
    <label class="form-floating">
      <input
        type="password"
        name="password"
        class="form-control"
        required
        placeholder=""
        value="12345678" />
      <label>Contraseña</label>
      <div class="invalid-feedback">
        Por favor, ingrese su contraseña.
      </div>
    </label>
    <button class="btn btn-primary">Iniciar sesión</button>
  </form>
</div>

<script type="module" src="assets/js/login.js"></script>
