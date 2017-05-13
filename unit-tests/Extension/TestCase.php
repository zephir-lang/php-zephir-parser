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

namespace Zephir\Parser\Tests;

use FilesystemIterator;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use PHPUnit_Framework_TestCase;
use PHPUnit_Framework_Exception;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!file_exists(ZEPHIR_PARSER_OUTPUT)) {
            mkdir(ZEPHIR_PARSER_OUTPUT, 0755, true);
        } else {
            $this->cleanOutputDir();
        }
    }

    protected function parseFile($file)
    {
        $path = data_path($file);
        return zephir_parse_file(file_get_contents($path), $path);
    }

    /**
     * Clean output directory from the generated files.
     */
    protected function cleanOutputDir()
    {
        $directoryIterator = new RecursiveDirectoryIterator(
            ZEPHIR_PARSER_OUTPUT,
            FilesystemIterator::KEY_AS_PATHNAME |
            FilesystemIterator::CURRENT_AS_FILEINFO |
            FilesystemIterator::SKIP_DOTS
        );

        $iterator = iterator_to_array(
            new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::CHILD_FIRST)
        );

        try {
            foreach ($iterator as $file) {
            /* @var \SplFileInfo $file */
            if ($file->isDir()) {
                rmdir($file->getRealPath());
                continue;
            }

            if (strpos($file->getBasename(), '.') !== 0) {
                unlink($file->getRealPath());
            }
        }
        } catch (\UnexpectedValueException $e) {
            // Ignore
        }
    }
}
