--TEST--
Single-letter class name should be accepted (regression test)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
class A {}
ZEP;
$ir = zephir_parse_file($code, '(eval code)');
// Previously this produced a syntax error because 'A' tokenized as CONSTANT
// and grammar allowed only IDENTIFIER after CLASS.
var_dump($ir[0]["name"]);
?>
--EXPECT--
string(1) "A"

