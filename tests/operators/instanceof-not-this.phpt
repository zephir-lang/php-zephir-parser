--TEST--
instanceof precedence: !this instanceof b groups as !(this instanceof b)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let r = !this instanceof b;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$e  = $ir[0]["statements"][0]["assignments"][0]["expr"];
printf("%s %s %s\n", $e["type"], $e["left"]["type"], $e["left"]["left"]["value"]);
?>
--EXPECT--
not instanceof this
