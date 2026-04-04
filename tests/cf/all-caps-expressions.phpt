--TEST--
All-caps names in expression contexts: new, fcall, scall, mcall, property-access (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// new RBF()
$code =<<<ZEP
class Foo
{
	public function bar()
	{
		var x;
		let x = new RBF();
	}
}
ZEP;
$ir = zephir_parse_file($code, '(eval code)');
$e = $ir[0]['definition']['methods'][0]['statements'][1]['assignments'][0]['expr'];
var_dump($e['type']);
var_dump($e['class']);

// new RBF(1) — with arguments
$code2 =<<<ZEP
class Foo
{
	public function bar()
	{
		var x;
		let x = new RBF(1);
	}
}
ZEP;
$ir2 = zephir_parse_file($code2, '(eval code)');
$e2 = $ir2[0]['definition']['methods'][0]['statements'][1]['assignments'][0]['expr'];
var_dump($e2['type']);
var_dump($e2['class']);

// RBF::compute() — static call with all-caps class name
$code3 =<<<ZEP
class Foo
{
	public function bar()
	{
		RBF::compute();
	}
}
ZEP;
$ir3 = zephir_parse_file($code3, '(eval code)');
$stmt3 = $ir3[0]['definition']['methods'][0]['statements'][0];
var_dump($stmt3['type']);
var_dump($stmt3['expr']['class']);
var_dump($stmt3['expr']['name']);

// this->RBF() — method call with all-caps method name
$code4 =<<<ZEP
class Foo
{
	public function bar()
	{
		this->RBF();
	}
}
ZEP;
$ir4 = zephir_parse_file($code4, '(eval code)');
$stmt4 = $ir4[0]['definition']['methods'][0]['statements'][0];
var_dump($stmt4['type']);
var_dump($stmt4['expr']['name']);

// RBF() — global function call with all-caps name
$code5 =<<<ZEP
class Foo
{
	public function bar()
	{
		RBF();
	}
}
ZEP;
$ir5 = zephir_parse_file($code5, '(eval code)');
$stmt5 = $ir5[0]['definition']['methods'][0]['statements'][0];
var_dump($stmt5['type']);
var_dump($stmt5['expr']['name']);

// this->RBF — property-access with all-caps property name
$code6 =<<<ZEP
class Foo
{
	public function bar()
	{
		var x;
		let x = this->RBF;
	}
}
ZEP;
$ir6 = zephir_parse_file($code6, '(eval code)');
$e6 = $ir6[0]['definition']['methods'][0]['statements'][1]['assignments'][0]['expr'];
var_dump($e6['type']);
var_dump($e6['right']['value']);

// RBF::MY_CONST — static constant access with all-caps class
$code7 =<<<ZEP
class Foo
{
	public function bar()
	{
		var x;
		let x = RBF::MY_CONST;
	}
}
ZEP;
$ir7 = zephir_parse_file($code7, '(eval code)');
$e7 = $ir7[0]['definition']['methods'][0]['statements'][1]['assignments'][0]['expr'];
var_dump($e7['type']);
var_dump($e7['left']['value']);
var_dump($e7['right']['value']);
?>
--EXPECT--
string(3) "new"
string(3) "RBF"
string(3) "new"
string(3) "RBF"
string(5) "scall"
string(3) "RBF"
string(7) "compute"
string(5) "mcall"
string(3) "RBF"
string(5) "fcall"
string(3) "RBF"
string(15) "property-access"
string(3) "RBF"
string(22) "static-constant-access"
string(3) "RBF"
string(8) "MY_CONST"

