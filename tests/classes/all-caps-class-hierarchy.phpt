--TEST--
All-caps class name extending and implementing all-caps names (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// class RBF extends BASE — both names are all-caps CONSTANT tokens
$code =<<<ZEP
class RBF extends BASE {}
ZEP;
$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]['type']);
var_dump($ir[0]['name']);
var_dump($ir[0]['extends']);

// class RBF implements IFACE — all-caps implements list
$code2 =<<<ZEP
class RBF implements IFACE {}
ZEP;
$ir2 = zephir_parse_file($code2, '(eval code)');
var_dump($ir2[0]['name']);
var_dump($ir2[0]['implements'][0]['value']);
?>
--EXPECT--
string(5) "class"
string(3) "RBF"
string(4) "BASE"
string(3) "RBF"
string(5) "IFACE"

