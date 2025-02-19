<?php

declare(strict_types=1);

use Servimotors\Bitacora;

require_once __DIR__ . '/../../Bitacora.php';

Bitacora::vaciar();

header('location: bitacora.php');
