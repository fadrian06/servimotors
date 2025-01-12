<?php include __DIR__ . '/../Partes/head.php' ?>


<section class="d-flex flex-column align-items-center gap-4">
  <img src="../../assets/img/Logo.png" class="img-fluid col-6 col-lg-4" />

  <div class="col-12 col-lg-8 card card-body">
    <form
      id="userForm"
      novalidate
      class="row row-cols-lg-2 row-gap-3 needs-validation">
      <h2 class="w-100 card-title text-center fs-4">
        Registrar nuevo usuario
      </h2>
      <div>
        <label class="form-floating w-100">
          <input
            name="firstName"
            class="form-control"
            required
            pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,30}"
            placeholder="" />
          <label>Primer nombre</label>
          <div class="invalid-feedback">
            Por favor ingrese un nombre válido.
          </div>
        </label>
      </div>
      <div>
        <label class="form-floating w-100">
          <input
            name="secondName"
            class="form-control"
            pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,30}"
            placeholder="" />
          <label>Segundo nombre</label>
        </label>
      </div>
      <div>
        <label class="form-floating w-100">
          <input
            name="firstSurname"
            class="form-control"
            required
            pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,30}"
            placeholder="" />
          <label>Primer apellido</label>
          <div class="invalid-feedback">
            Por favor ingrese un apellido válido.
          </div>
        </label>
      </div>
      <div>
        <label class="form-floating w-100">
          <input
            name="secondSurname"
            class="form-control"
            pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,30}"
            placeholder="" />
          <label>Segundo Apellido</label>
        </label>
      </div>
      <div>
        <label class="form-floating w-100">
          <input
            name="cedula"
            class="form-control"
            pattern="[V|E]-\d{5,8}"
            required
            placeholder="" />
          <label>Cédula</label>
          <div class="invalid-feedback">
            Por favor ingrese una cédula válida (V-12345678 o E-12345678).
          </div>
        </label>
      </div>
      <div>
        <label class="form-floating w-100">
          <input
            type="tel"
            name="phone"
            class="form-control"
            required
            pattern="\d{11}"
            placeholder="" />
          <label>Teléfono</label>
          <div class="invalid-feedback">
            Por favor ingrese un número de teléfono válido de 11 dígitos.
          </div>
        </label>
      </div>
      <div class="w-100">
        <label class="form-floating w-100">
          <input
            type="email"
            name="email"
            class="form-control"
            required
            placeholder="" />
          <label>Correo electrónico</label>
          <div class="invalid-feedback">Por favor ingrese un correo electrónico válido.</div>
        </label>
      </div>
      <div class="w-100">
        <label class="form-floating w-100">
          <input
            name="username"
            class="form-control"
            required
            pattern="\w{4,20}"
            placeholder="" />
          <label>Nombre de usuario</label>
          <div class="invalid-feedback">
            Por favor ingrese un nombre de usuario válido.
          </div>
        </label>
      </div>
      <div>
        <label class="form-floating w-100">
          <input
            type="password"
            name="password"
            class="form-control"
            required
            pattern="(?=.*\d)(?=.*[A-ZÑ])(?=.*[a-zñ])(?=.*\W).{8,}"
            placeholder="" />
          <label>Contraseña</label>
          <div class="invalid-feedback">
            La contraseña debe tener al menos una letra mayúscula, una
            minúscula, un número y un carácter especial.
          </div>
        </label>
      </div>
      <div>
        <label class="form-floating w-100">
          <input
            type="password"
            name="confirmPassword"
            class="form-control"
            required
            placeholder="" />
          <label>Confirmar contraseña</label>
          <div class="invalid-feedback">Por favor confirme su contraseña.</div>
        </label>
      </div>
      <div class="w-100">
        <label class="form-floating w-100">
          <select class="form-select" name="role" required>
            <option value="" selected disabled>Seleccione un rol</option>
            <option>Administrador</option>
            <option>Secretaría</option>
          </select>
          <label>Rol</label>
          <div class="invalid-feedback">Por favor seleccione un rol.</div>
        </label>
      </div>
      <button class="btn btn-primary w-100">Registrar</button>
    </form>
  </div>
</section>

<script type="module" src="../../assets/js/register.js"></script>

<?php include __DIR__ . '/../Partes/footer.php' ?>
