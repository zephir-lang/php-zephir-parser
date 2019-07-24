--TEST--
For control statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	for item in arr { }
	for key, value in arr { }
	for item in reverse arr { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	printf("%s %s %s %s %s %d\n",
		$statement["type"],
		$statement["key"] ?? "-",
		$statement["value"],
		$statement["expr"]["type"],
		$statement["expr"]["value"],
		$statement["reverse"]
	);
}
?>
--EXPECT--
for - item variable arr 0
for key value variable arr 0
for - item variable arr 1
