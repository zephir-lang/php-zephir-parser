<?php

/*
  +--------------------------------------------------------------------------+
  | Zephir Parser                                                            |
  | Copyright (c) 2013-present Zephir Team (https://zephir-lang.com/)        |
  |                                                                          |
  | This source file is subject the MIT license, that is bundled with this   |
  | package in the file LICENSE, and is available through the world-wide-web |
  | at the following url: http://zephir-lang.com/license.html                |
  +--------------------------------------------------------------------------+
*/

/**
 * Parses a file and returning an intermediate representation.
 *
 * Example:
 * <code>
 * function parse_file(string $file_path): array {
 *     return zephir_parse_file(file_get_contents($file_path), $file_path);
 * }
 * </code>
 *
 * @param string $content
 * @param string $filepath
 * @return array
 */
function zephir_parse_file($content, $filepath)
{
}
