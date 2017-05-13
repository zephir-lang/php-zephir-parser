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

if (!function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd()
    {
        array_map(function ($x) {
            var_dump($x);
        }, func_get_args());

        die(1);
    }
}

if (!function_exists('expected')) {
    /**
     * Get the expected content.
     *
     * @param  string $path
     * @return string
     */
    function expected($path)
    {
        return require expected_path($path);
    }
}

if (!function_exists('data_path')) {
    /**
     * Get the data path.
     *
     * @param  string $path
     * @return string
     */
    function data_path($path = '')
    {
        if ($path) {
            $normalized = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
            $path = DIRECTORY_SEPARATOR . ltrim($normalized, DIRECTORY_SEPARATOR);
        }

        return ZEPHIR_PARSER_DATA . $path;
    }
}

if (!function_exists('output_path')) {
    /**
     * Get the output path.
     *
     * @param  string $path
     * @return string
     */
    function output_path($path = '')
    {
        if ($path) {
            $normalized = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
            $path = DIRECTORY_SEPARATOR . ltrim($normalized, DIRECTORY_SEPARATOR);
        }

        return ZEPHIR_PARSER_OUTPUT . $path;
    }
}

if (!function_exists('expected_path')) {
    /**
     * Get the expected path.
     *
     * @param  string $path
     * @return string
     */
    function expected_path($path = '')
    {
        if ($path) {
            $normalized = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
            $path = DIRECTORY_SEPARATOR . ltrim($normalized, DIRECTORY_SEPARATOR);
        }

        return ZEPHIR_PARSER_EXPECTED . $path;
    }
}
