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

ini_set('date.timezone', 'UTC');
ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');

$vendorPath = dirname(dirname(__FILE__)) . '/vendor';

if (!is_file($vendorPath . '/autoload.php')) {
    throw new \RuntimeException(
        'Unable to locate autoloader. Run `composer install` from the project root directory.'
    );
}

require $vendorPath . '/autoload.php';

define('ZEPHIR_DATA', __DIR__ . DIRECTORY_SEPARATOR . 'Data' . DIRECTORY_SEPARATOR);
define('OUTPUT_DATA', __DIR__ . DIRECTORY_SEPARATOR . 'Output' . DIRECTORY_SEPARATOR);
