--TEST--
instanceof precedence: !a instanceof b as an if condition groups as !(a instanceof b)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	if !a instanceof b {
		return true;
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$e  = $ir[0]["statements"][0]["expr"];
printf("%s\n", $e["type"]);
printf("%s\n", $e["left"]["type"]);
printf("%s %s\n", $e["left"]["left"]["value"], $e["left"]["right"]["value"]);
?>
--EXPECT--
not
instanceof
a b
