--TEST--
assign-bitwise - Tests assignments using bitwise operators
--SKIPIF--
<?php if (!extension_loaded("Zephir Parser")) print "skip The zephir_parser extension is not loaded"; ?>
--FILE--
<?php require(__DIR__ . "/../../zephir_parser_test.inc");

$ir = parse_file("operators/bitwise/assign.zep");

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
5
variable a bitwise-and-assign variable b
variable a bitwise-or-assign variable b
variable a bitwise-xor-assign variable b
variable a bitwise-shiftleft-assign variable b
variable a bitwise-shiftright-assign variable b
