--TEST--
Tests assignments using bitwise operators
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
function bitwise() {
    let a &= b;
    let a |= b;
    let a ^= b;
    let a <<= b;
    let a >>= b;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

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
?>
--EXPECT--
5
variable a bitwise-and-assign variable b
variable a bitwise-or-assign variable b
variable a bitwise-xor-assign variable b
variable a bitwise-shiftleft-assign variable b
variable a bitwise-shiftright-assign variable b
