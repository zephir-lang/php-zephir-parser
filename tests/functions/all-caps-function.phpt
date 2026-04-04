--TEST--
All-caps global function name and all-caps parameter names (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function TRANSFORM(int A, int B) -> int
{
}
ZEP;
$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]['type']);
var_dump($ir[0]['name']);
var_dump($ir[0]['parameters'][0]['name']);
var_dump($ir[0]['parameters'][1]['name']);
?>
--EXPECT--
string(8) "function"
string(9) "TRANSFORM"
string(1) "A"
string(1) "B"

