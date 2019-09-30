--TEST--
Tests decrement operators
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a--;
	let b->a--;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	$assignment = $statement["assignments"][0];
	printf("%s %s %s\n",
		$assignment["assign-type"],
		$assignment["variable"],
		$assignment["property"] ?? "-"
	);
}
?>
--EXPECT--
decr a -
object-property-decr b a
