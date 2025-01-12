<?php

const SIDEBAR_LINKS = [
  [
    'href' => '../dashboard/dashboard.php',
    'iconClasses' => 'bi bi-grid',
    'title' => 'Dashboard'
  ],
  [
    'title' => 'Gestión automotriz',
  ],
  [
    'href' => '../Clientes/clientes-agregar.php',
    'iconClasses' => 'bi bi-grid',
    'title' => 'Clientes'
  ],
  [
    'iconClasses' => 'bi bi-car',
    'title' => 'Vehículos',
    'sublinks' => [
      [
        'href' => 'vehiculos-lista.html',
        'title' => 'Lista de vehículos'
      ],
      [
        'href' => '../Vehiculos/vehiculos-agregar.php',
        'title' => 'Agregar vehículo'
      ]
    ]
  ],
  [
    'iconClasses' => 'bi bi-tools',
    'title' => 'Servicios',
    'sublinks' => [
      [
        'href' => 'servicios-lista.html',
        'title' => 'Lista de servicios'
      ],
      [
        'href' => '../Servicios/servicios-agregar.php',
        'title' => 'Agregar servicio'
      ]
    ]
  ],
  [
    'title' => 'Gestión empresa'
  ],
  [
    'iconClasses' => 'bi bi-box-seam',
    'title' => 'Inventario de repuestos',
    'sublinks' => [
      [
        'href' => 'inventario-creacion.html',
        'title' => 'Creación de productos'
      ],
      [
        'href' => 'inventario-ingresos.html',
        'title' => 'Ingresos de productos'
      ],
      [
        'href' => 'inventario-venta.html',
        'title' => 'Venta de repuestos'
      ]
    ]
  ],
  [
    'title' => 'Gestión de empleados'
  ],
  [
    'iconClasses' => 'bi bi-people',
    'title' => 'Empleados',
    'sublinks' => [
      [
        'href' => 'empleados-lista.html',
        'title' => 'Lista de empleados'
      ],
      [
        'href' => '../Empleados/empleados-agregar.php',
        'title' => 'Agregar empleado'
      ]
    ]
  ],
  [
    'title' => 'Gestión de reportes'
  ],
  [
    'iconClasses' => 'bi bi-file-earmark-text',
    'title' => 'Reportes',
    'sublinks' => [
      [
        'href' => 'reportes-clientes.html',
        'title' => 'Listado de clientes'
      ],
      [
        'href' => 'reportes-vehiculos.html',
        'title' => 'Listado de vehículos'
      ],
      [
        'href' => 'reportes-servicios.html',
        'title' => 'Servicios individuales'
      ],
      [
        'href' => 'reportes-semanales-empleados.html',
        'title' => 'Reportes semanales por empleado'
      ]
    ]
  ],
  [
    'href' => '../auth/register.php',
    'iconClasses' => 'bi bi-card-list',
    'title' => 'Registrar'
  ],
  [
    'href' => 'pages-login.html',
    'iconClasses' => 'bi bi-box-arrow-in-right',
    'title' => 'Iniciar sesión'
  ]
];

define('SIDEBAR_ID', uniqid());

?>

<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="<?= SIDEBAR_ID ?>">
    <?php foreach (SIDEBAR_LINKS as $link): ?>
      <?php if (key_exists('href', $link)): ?>
        <a class="nav-link" href="<?= $link['href'] ?>">
          <i class="<?= $link['iconClasses'] ?>"></i>
          <?= $link['title'] ?>
        </a>
      <?php elseif (key_exists('sublinks', $link)): ?>
        <?php $submenuId = uniqid() ?>
        <li class="nav-item">
          <button
            class="nav-link w-100 collapsed"
            data-bs-toggle="collapse"
            data-bs-target="#<?= $submenuId ?>">
            <i class="<?= $link['iconClasses'] ?>"></i>
            <?= $link['title'] ?>
            <i class="bi bi-chevron-down ms-auto"></i>
          </button>
          <ul
            id="<?= $submenuId ?>"
            class="nav-content collapse"
            data-bs-parent="#<?= SIDEBAR_ID ?>">
            <?php foreach ($link['sublinks'] as $sublink): ?>
              <li>
                <a href="<?= $sublink['href'] ?>">
                  <i class="bi bi-circle"></i>
                  <?= $sublink['title'] ?>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
        </li>
      <?php else: ?>
        <li class="nav-heading"><?= $link['title'] ?></li>
      <?php endif ?>
    <?php endforeach ?>
  </ul>
</aside>
