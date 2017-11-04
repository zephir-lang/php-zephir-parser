--TEST--
dockblock simple - Tests simple PHP dockblock
--SKIPIF--
<?php if (!extension_loaded("Zephir Parser")) print "skip The zephir_parser extension is not loaded"; ?>
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
