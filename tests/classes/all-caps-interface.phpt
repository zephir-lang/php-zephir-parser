--TEST--
All-caps interface name and all-caps interface method names (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// interface with all-caps name
$code =<<<ZEP
interface RBF {}
ZEP;
$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]['type']);
var_dump($ir[0]['name']);

// interface with all-caps methods (no return type and with return type)
$code2 =<<<ZEP
interface IFACE {
	public function COMPUTE();
	public function GET() -> int;
}
ZEP;
$ir2 = zephir_parse_file($code2, '(eval code)');
var_dump($ir2[0]['definition']['methods'][0]['name']);
var_dump($ir2[0]['definition']['methods'][1]['name']);
?>
--EXPECT--
string(9) "interface"
string(3) "RBF"
string(7) "COMPUTE"
string(3) "GET"

