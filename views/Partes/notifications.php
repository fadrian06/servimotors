<?php

use Jenssegers\Date\Date;

require_once __DIR__ . '/../../vendor/autoload.php';

const CLASES_ICONO = [
  'Repuesto bajo en stock' => 'bi bi-exclamation-circle text-warning',
  'Repuesto reabastecido' => 'bi bi-check-circle text-success',
  'Nuevo repuesto disponible' => 'bi bi-info-circle text-primary'
];

const PLANTILLA_MENSAJE_NOTIFICACION = [
  'Repuesto bajo en stock' => 'El repuesto "%s" está bajo de stock, considera reabastecer.',
  'Repuesto reabastecido' => 'El repuesto "%s" ha sido reabastecido.',
  'Nuevo repuesto disponible' => 'Se ha añadido un nuevo repuesto: "%s".'
];

$notificaciones = [
  [
    'tipo' => 'Repuesto bajo en stock',
    'repuesto' => 'Frenos',
    'fecha' => '2024-11-28 23:07:00'
  ],
  [
    'tipo' => 'Repuesto reabastecido',
    'repuesto' => 'Aceite de motor',
    'fecha' => '2024-11-28 22:48:00'
  ],
  [
    'tipo' => 'Nuevo repuesto disponible',
    'repuesto' => 'Filtros de aire',
    'fecha' => '2024-11-28 22:19:00'
  ]
];

date_default_timezone_set('America/Caracas');
Date::setLocale('es');

?>

<li class="dropdown">
  <button
    class="nav-link nav-icon bi bi-bell"
    data-bs-toggle="dropdown">
    <span class="badge text-bg-primary badge-number">
      <?= count($notificaciones) ?>
    </span>
  </button>

  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications overflow-y-scroll" style="max-height: 85vh">
    <li class="dropdown-header d-flex gap-3 align-items-center border-bottom">
      Tienes <?= count($notificaciones ?? []) ?> nuevas notificaciones
      <a href="javascript:" class="btn btn-primary btn-sm rounded-pill">
        Ver todas
      </a>
    </li>

    <?php foreach ($notificaciones as $notificacion): ?>
      <li class="notification-item border-bottom">
        <i class="<?= @CLASES_ICONO[$notificacion['tipo']] ?>"></i>
        <div>
          <h4><?= $notificacion['tipo'] ?></h4>
          <p>
            <?= sprintf(PLANTILLA_MENSAJE_NOTIFICACION[$notificacion['tipo']], $notificacion['repuesto']) ?>
          </p>
          <p><?= ucfirst((new Date($notificacion['fecha']))->ago()) ?></p>
        </div>
      </li>
    <?php endforeach ?>

    <li class="dropdown-footer">
      <a href="javascript:">Mostrar todas las notificaciones</a>
    </li>
  </ul>
</li>
