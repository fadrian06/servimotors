<?php

use Leaf\BareUI;

function json(mixed $valor, int $codigoEstadoHttp = 200): never
{
  header('content-type: application/json');
  http_response_code($codigoEstadoHttp);

  exit(json_encode($valor));
}

/** @param array<string, mixed> $datos */
function renderizar(string $vista, array $datos = []): string
{
  require_once __DIR__ . '/assets/vendor/bareui/BareUI.php';

  BareUI::config('path', __DIR__ . '/vistas');

  return BareUI::render($vista, $datos) ?: '';
}

/** @param array<string, mixed> $datos */
function renderizarPagina(
  string $pagina,
  string $titulo,
  array $datos = [],
  string $estructura = ''
): never {
  $datos['titulo'] ??= $titulo;
  $pagina = renderizar("paginas/$pagina", $datos);

  if ($estructura) {
    exit(renderizar("estructuras/$estructura", compact('pagina') + $datos));
  }

  exit($pagina);
}

/**
 * @param $clave Clave única para evitar renderizar más de una vez.
 * @param array<string, mixed> $datos
 */
function renderizarUnaVez(
  string $clave,
  string $html = '',
  string $vista = '',
  array $datos = []
): void {
  /** @var string[] */
  static $clavesRenderizadas = [];

  if (in_array($clave, $clavesRenderizadas)) {
    return;
  }

  $clavesRenderizadas[] = $clave;

  if ($html) {
    echo $html;
  } elseif ($vista) {
    echo renderizar($vista, $datos);
  }
}
