--TEST--
Tests bitwise operators
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
function bitwise() {
    let a = 0x01 << 1;
    let a = 0xF0 >> 1;
    let a = 0x01 | 0x02;
    let a = 0x03 & 0x01;
    let a = 0x03 ^ 0x02;
    let a = ~ 0x01;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

echo count($ir[0]["statements"]) . "\n";

foreach ($ir[0]["statements"] as $statement) {
	$expr = $statement["assignments"][0]["expr"];
	$parts = [
		$expr["left"]["type"],
		$expr["left"]["value"],
		$expr["type"]
	];

	if (isset($expr["right"])) {
		$parts[] = $expr["right"]["type"];
		$parts[] = $expr["right"]["value"];
	}

	echo implode(" ", $parts) . "\n";
}
?>
--EXPECT--
6
int 0x01 bitwise_shiftleft int 1
int 0xF0 bitwise_shiftright int 1
int 0x01 bitwise_or int 0x02
int 0x03 bitwise_and int 0x01
int 0x03 bitwise_xor int 0x02
int 0x01 bitwise_not
