<?php

declare(strict_types=1);

use Servimotors\Bitacora;

exit(header('location: bitacora.php'));

require_once __DIR__ . '/../../Bitacora.php';

Bitacora::vaciar();

header('location: bitacora.php');
