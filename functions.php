<?php

use Leaf\BareUI;

function json(mixed $value, int $status = 200): never
{
  header('content-type: application/json');
  http_response_code($status);

  exit(json_encode($value));
}

/** @param array<string, mixed> $data */
function render(string $view, array $data = []): string
{
  require_once __DIR__ . '/assets/vendor/bareui/BareUI.php';

  BareUI::config('path', __DIR__ . '/views');

  $html = BareUI::render($view, $data) ?: '';

  if (is_string($html)) {
    return $html;
  }

  return '';
}

/** @param array<string, mixed> $data */
function renderPage(string $page, string $title, array $data = [], string $layout = ''): never
{
  $data['title'] ??= $title;
  $page = render("pages/$page", $data);

  if ($layout) {
    exit(render("layouts/$layout", compact('page') + $data));
  }

  exit($page);
}

/** @param array<string, mixed> $data */
function renderOnce(
  string $key,
  string $html = '',
  string $view = '',
  array $data = []
): void {
  /** @var string[] */
  static $renderedKeys = [];

  if (in_array($key, $renderedKeys)) {
    return;
  }

  $renderedKeys[] = $key;

  if ($html) {
    echo $html;
  } elseif ($view) {
    echo render($view, $data);
  }
}
