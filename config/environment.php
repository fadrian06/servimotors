<?php

$_ENV += require __DIR__ . '/../.env.dist.php';
$_ENV += @include __DIR__ . '/../.env.php';
