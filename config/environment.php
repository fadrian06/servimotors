<?php

$_ENV += array_merge(
	require __DIR__ . '/../.env.dist.php',
	file_exists(__DIR__ . '/../.env.php')
		? require __DIR__ . '/../.env.php'
		: []
);