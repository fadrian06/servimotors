<?php

assert(is_string($titulo));
assert(is_string($pagina));

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />

  <title><?= $titulo ?> - SERVIMOTORS</title>

  <base href="<?= str_replace('index.php', '', $_SERVER['SCRIPT_NAME']) ?>" />

  <!-- Favicons -->
  <link rel="icon" href="./assets/img/favicon.png" />

  <!-- Google Fonts -->
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" />

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/vendor/bootstrap-icons/bootstrap-icons.min.css" />

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="./assets/css/style.css" />
</head>

<body class="container min-vh-100 d-flex flex-column align-items-center justify-content-center gap-4 overflow-y-scroll">
  <?= $pagina ?>
  <script src="./assets/js/validate-forms.js"></script>
</body>

</html>
