--TEST--
Tests comparison operators
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	if 1 == 1 { }
	if 1 === 1 { }
	if 1 != 1 { }
	if 1 <> 1 { }
	if 1 !== 1 { }
	if 1 < 1 { }
	if 1 > 1 { }
	if 1 <= 1 { }
	if 1 >= 1 { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	printf("%s\n", $statement["expr"]["type"]);
}
?>
--EXPECT--
equals
identical
not-equals
not-equals
not-identical
less
greater
less-equal
greater-equal
