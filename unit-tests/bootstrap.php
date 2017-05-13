<?php

/*
 +--------------------------------------------------------------------------+
 | Zephir Parser.                                                           |
 +--------------------------------------------------------------------------+
 | Copyright (c) 2013-2017 Zephir Team and contributors                     |
 +--------------------------------------------------------------------------+
 | This source file is subject the MIT license, that is bundled with        |
 | this package in the file LICENSE, and is available through the           |
 | world-wide-web at the following url:                                     |
 | http://zephir-lang.com/license.html                                      |
 |                                                                          |
 | If you did not receive a copy of the MIT license and are unable          |
 | to obtain it through the world-wide-web, please send a note to           |
 | license@zephir-lang.com so we can mail you a copy immediately.           |
 +--------------------------------------------------------------------------+
*/

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

$vendorPath = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor';

if (file_exists($vendorPath . DIRECTORY_SEPARATOR . 'autoload.php')) {
    require $vendorPath . DIRECTORY_SEPARATOR. 'autoload.php';
} else {
    fwrite(STDOUT, 'File ' . $vendorPath . DIRECTORY_SEPARATOR. 'autoload.php does not exists. Skip' . PHP_EOL);
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'functions.php';

define('ZEPHIR_PARSER_TESTS_ROOT', __DIR__);
define('ZEPHIR_PARSER_DATA', __DIR__ . DIRECTORY_SEPARATOR . 'Data');
define('ZEPHIR_PARSER_OUTPUT', __DIR__ . DIRECTORY_SEPARATOR . 'Output');
define('ZEPHIR_PARSER_EXPECTED', __DIR__ . DIRECTORY_SEPARATOR . 'Expected');
