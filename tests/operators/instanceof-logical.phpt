--TEST--
instanceof precedence: binds tighter than && and || (each operand groups on its own)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let x = a instanceof b && c instanceof d;
	let y = a instanceof b || c instanceof d;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$st = $ir[0]["statements"];
$x  = $st[0]["assignments"][0]["expr"];
$y  = $st[1]["assignments"][0]["expr"];
printf("%s %s %s\n", $x["type"], $x["left"]["type"], $x["right"]["type"]);
printf("%s %s %s\n", $y["type"], $y["left"]["type"], $y["right"]["type"]);
?>
--EXPECT--
and instanceof instanceof
or instanceof instanceof
