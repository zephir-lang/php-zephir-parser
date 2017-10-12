--TEST--
zephir_parse_file() - Tests classes in the method annotation
--SKIPIF--
<?php require(__DIR__ . "/../zephir_parser_skip.inc"); ?>
--FILE--
<?php require(__DIR__ . "/../zephir_parser_test.inc");

$ir = parse_file("dockblock/bug13.zep");
echo "/".$ir[1]["definition"]["properties"][0]["docblock"]."/";
--EXPECT--
/**
	 * @var \stdClass
	 */
