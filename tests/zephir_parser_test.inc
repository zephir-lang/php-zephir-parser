<?php

// turn on all errors
error_reporting(-1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

setlocale(LC_ALL, 'en_US.utf-8');

set_time_limit(-1);

if (!ini_get('date.timezone')) {
    ini_set('date.timezone', 'UTC');
}

clearstatcache();

if (extension_loaded('xdebug')) {
    ini_set('xdebug.cli_color', 1);
    ini_set('xdebug.collect_params', 0);
    ini_set('xdebug.dump_globals', 'on');
    ini_set('xdebug.show_local_vars', 'on');
    ini_set('xdebug.max_nesting_level', 100);
    ini_set('xdebug.var_display_max_depth', 4);
}

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
