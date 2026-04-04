--TEST--
All-caps class property names (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
class Foo
{
	public LU;
	public RBF = 1;
}
ZEP;
$ir = zephir_parse_file($code, '(eval code)');
$props = $ir[0]['definition']['properties'];
var_dump($props[0]['name']);
var_dump($props[1]['name']);
?>
--EXPECT--
string(2) "LU"
string(3) "RBF"

