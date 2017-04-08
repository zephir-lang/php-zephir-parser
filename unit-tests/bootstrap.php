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

$vendorPath = dirname(dirname(__FILE__)) . '/vendor';

if (file_exists($vendorPath . '/autoload.php')) {
    require $vendorPath . '/autoload.php';
}

define('TESTS_ROOT', __DIR__);
define('ZEPHIR_DATA', __DIR__ . DIRECTORY_SEPARATOR . 'Data');
define('OUTPUT_DATA', __DIR__ . DIRECTORY_SEPARATOR . 'Output');
