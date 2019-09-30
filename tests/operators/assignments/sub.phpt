--TEST--
Tests assignments using substract operator
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
function sub(int a, int b) {
    let a -= b;
    let a -= 1;
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
2
variable a sub-assign variable b
variable a sub-assign int 1
