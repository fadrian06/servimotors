<?php

const PROFILE_LINKS = [
  [
    'href' => '../dashboard/users-profile.php',
    'iconClasses' => 'bi bi-person',
    'title' => 'Mi perfil'
  ],
  [
    'href' => 'views/dashboard/users-profile.php',
    'iconClasses' => 'bi bi-gear',
    'title' => 'Configuración de cuenta'
  ],
  [
    'href' => 'pages-faq.html',
    'iconClasses' => 'bi bi-question-circle',
    'title' => '¿Necesitas Ayuda?'
  ],
  [
    'href' => '../auth/logout.php',
    'iconClasses' => 'bi bi-box-arrow-right',
    'title' => 'Cerrar sesión'
  ]
];

?>

<li class="dropdown pe-3">
  <button
    class="nav-link nav-profile d-flex align-items-center gap-3 pe-0 dropdown-toggle"
    data-bs-toggle="dropdown">
    <img
      src="../../assets/img/profile-img.jpg"
      class="rounded-circle ratio-1x1" />
    <?= "{$usuario['primerNombre']} {$usuario['primerApellido']}" ?>
  </button>

  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
    <li class="dropdown-header border-bottom">
      <h6><?= $usuario['nombreUsuario'] ?></h6>
      <span><?= $usuario['nombreRol'] ?></span>
    </li>

    <?php foreach (PROFILE_LINKS as $link): ?>
      <a
        class="dropdown-item d-flex align-items-center"
        href="<?= $link['href'] ?>">
        <i class="<?= $link['iconClasses'] ?>"></i>
        <?= $link['title'] ?>
      </a>
    <?php endforeach ?>
  </ul>
</li>
