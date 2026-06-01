--TEST--
instanceof precedence: binds tighter than equality (a instanceof b == c == (a instanceof b) == c)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let r = a instanceof b == c;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$e  = $ir[0]["statements"][0]["assignments"][0]["expr"];
printf("%s\n", $e["type"]);
printf("%s\n", $e["left"]["type"]);
printf("%s\n", $e["right"]["value"]);
?>
--EXPECT--
equals
instanceof
c
