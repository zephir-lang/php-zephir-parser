--TEST--
zephir_parse_file() - Tests support syntax assign-bitwise operators
--SKIPIF--
<?php require(__DIR__ . "/../zephir_parser_skip.inc"); ?>
--FILE--
<?php require(__DIR__ . "/../zephir_parser_test.inc");

$ir = parse_file("bitwise/assign.zep");

echo count($ir[0]["statements"]) . "\n";

foreach ($ir[0]["statements"] as $statement) {
	printf(
		"%s %s %s %s %s\n",
		$statement["assignments"][0]["assign-type"],
		$statement["assignments"][0]["variable"],
		$statement["assignments"][0]["operator"],
		$statement["assignments"][0]["expr"]["type"],
		$statement["assignments"][0]["expr"]["value"]
	);
}
--EXPECT--
3
variable a bitwise-or-assign variable b
variable a bitwise-xor-assign variable b
variable a bitwise-shiftleft-assign variable b
