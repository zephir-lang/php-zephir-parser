--TEST--
All-caps token in expression context must still be parsed as a constant, not a variable (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// When RBF appears on the RIGHT side of a let assignment (i.e. in an
// expression), it must remain type="constant" — NOT type="variable".
// The fix only reinterprets CONSTANT tokens as names in DECLARATION
// positions (let LHS, class name, method name, etc.).

$code =<<<ZEP
class Foo
{
	public function bar()
	{
		var x;
		let x = RBF;
	}
}
ZEP;
$ir = zephir_parse_file($code, '(eval code)');
$let = $ir[0]['definition']['methods'][0]['statements'][1]['assignments'][0];
// LHS: x is a plain variable assignment
var_dump($let['assign-type']);
var_dump($let['variable']);
// RHS: RBF is a PHP constant reference, not a variable
var_dump($let['expr']['type']);
var_dump($let['expr']['value']);

// All-caps token in a binary expression must also remain type="constant"
$code2 =<<<ZEP
class Bar
{
	public function test()
	{
		var x;
		let x = RBF + 1;
	}
}
ZEP;
$ir2 = zephir_parse_file($code2, '(eval code)');
$expr = $ir2[0]['definition']['methods'][0]['statements'][1]['assignments'][0]['expr'];
var_dump($expr['type']);
var_dump($expr['left']['type']);
var_dump($expr['left']['value']);

// const MYCONSTANT = value — the name after const keyword is still stored correctly
$code3 =<<<ZEP
class Baz
{
	const MYCONSTANT = 1;
}
ZEP;
$ir3 = zephir_parse_file($code3, '(eval code)');
$c = $ir3[0]['definition']['constants'][0];
var_dump($c['type']);
var_dump($c['name']);
?>
--EXPECT--
string(8) "variable"
string(1) "x"
string(8) "constant"
string(3) "RBF"
string(3) "add"
string(8) "constant"
string(3) "RBF"
string(5) "const"
string(10) "MYCONSTANT"

