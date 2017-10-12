--TEST--
zephir_parse_file() - Tests simple PHP dockblock
--SKIPIF--
<?php require(__DIR__ . "/../zephir_parser_skip.inc"); ?>
--FILE--
<?php require(__DIR__ . "/../zephir_parser_test.inc");

$ir = parse_file("dockblock/simple.zep");
echo "/".$ir[1]["value"]."/";
--EXPECT--
/**
 * DocBlockFail
 *
 * @author Paul Scarrone <paul@phalconphp.com>
 */
