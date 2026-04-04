--TEST--
All-caps variable names (declare and let) should be accepted (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
class Foo
{
	public function bar(int LU) -> void
	{
		int LU;
		let LU = 42;
	}
}
ZEP;
$ir = zephir_parse_file($code, '(eval code)');
$method = $ir[0]['definition']['methods'][0];
// parameter
var_dump($method['parameters'][0]['name']);
// declare statement
var_dump($method['statements'][0]['type']);
var_dump($method['statements'][0]['variables'][0]['variable']);
// let statement
var_dump($method['statements'][1]['type']);
var_dump($method['statements'][1]['assignments'][0]['variable']);
?>
--EXPECT--
string(2) "LU"
string(7) "declare"
string(2) "LU"
string(3) "let"
string(2) "LU"

