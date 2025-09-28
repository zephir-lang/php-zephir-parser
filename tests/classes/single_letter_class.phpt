--TEST--
Single-letter class name should be parsed
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
class A
{
}
ZEP;
$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]['type']);
var_dump($ir[0]['name']);
?>
--EXPECT--
string(5) "class"
string(1) "A"

