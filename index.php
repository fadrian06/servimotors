<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />

  <title>Inicio de sesión</title>

  <!-- Favicons -->
  <link rel="icon" href="assets/img/favicon.png" />
  <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png" />

  <!-- Google Fonts -->
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" />

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/vendor/bootstrap-icons/bootstrap-icons.min.css" />

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body class="container min-vh-100 d-flex flex-column align-items-center justify-content-center gap-4 overflow-y-scroll">
  <img src="assets/img/Logo.png" class="img-fluid col-lg-4" />

  <div class="col-12 col-lg-4">
    <form
      id="loginForm"
      class="card card-body row-gap-3 needs-validation"
      novalidate>
      <h1 class="card-title text-center fs-4">Datos de su cuenta</h1>
      <label class="form-floating">
        <input name="username" class="form-control" required placeholder="" />
        <label>Nombre de usuario</label>
        <div class="invalid-feedback">Por favor, ingrese su nombre de usuario.</div>
      </label>
      <label class="form-floating">
        <input
          type="password"
          name="password"
          class="form-control"
          required
          placeholder="" />
        <label>Contraseña</label>
        <div class="invalid-feedback">Por favor, ingrese su contraseña.</div>
      </label>
      <button class="btn btn-primary">Iniciar sesión</button>
    </form>
  </div>

  <!-- Script para manejar el envío del formulario -->
  <script src="assets/js/validate-forms.js"></script>
  <script type="module" src="assets/js/login.js"></script>

</body>

</html>
