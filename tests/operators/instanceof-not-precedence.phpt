--TEST--
instanceof binds tighter than logical not (!a instanceof b == !(a instanceof b))
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let r = !a instanceof b;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$expr = $ir[0]["statements"][0]["assignments"][0]["expr"];
printf("%s\n", $expr["type"]);
printf("%s\n", $expr["left"]["type"]);
printf("%s %s\n", $expr["left"]["left"]["value"], $expr["left"]["right"]["value"]);
?>
--EXPECT--
not
instanceof
a b
