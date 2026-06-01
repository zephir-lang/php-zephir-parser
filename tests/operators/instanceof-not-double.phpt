--TEST--
instanceof precedence: double logical not (!!a instanceof b == !!(a instanceof b))
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let r = !!a instanceof b;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$e  = $ir[0]["statements"][0]["assignments"][0]["expr"];
printf("%s\n", $e["type"]);
printf("%s\n", $e["left"]["type"]);
printf("%s\n", $e["left"]["left"]["type"]);
printf("%s %s\n", $e["left"]["left"]["left"]["value"], $e["left"]["left"]["right"]["value"]);
?>
--EXPECT--
not
not
instanceof
a b
