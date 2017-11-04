<?php

define('ZEPHIR_PARSER_TESTS_ROOT', __DIR__);
define('ZEPHIR_PARSER_DATA', __DIR__ . DIRECTORY_SEPARATOR . 'data');

function data_path($path = '') {
  if ($path) {
    $normalized = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    $path = DIRECTORY_SEPARATOR . ltrim($normalized, DIRECTORY_SEPARATOR);
  }

  return ZEPHIR_PARSER_DATA . $path;
}

function parse_file($file_path) {
  $path = data_path($file_path);

  return zephir_parse_file(file_get_contents($path), $path);
}
