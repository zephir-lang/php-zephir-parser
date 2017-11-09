--TEST--
classlike - Tests class like names in the method annotation
--SKIPIF--
<?php if (!extension_loaded("Zephir Parser")) print "skip The zephir_parser extension is not loaded"; ?>
--FILE--
<?php require(__DIR__ . "/../zephir_parser_test.inc");

$ir = parse_file("dockblock/bug13.zep");
echo $ir[1]["definition"]["properties"][0]["docblock"];
--EXPECT--
**
	 * @var \stdClass
	 *
