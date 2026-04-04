--TEST--
Multi-letter all-caps class name should be accepted (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
class RBF
{
}
ZEP;
$ir = zephir_parse_file($code, '(eval code)');
// Previously failed with a syntax error because 'RBF' tokenised as CONSTANT
// and the grammar only accepted IDENTIFIER after CLASS.
var_dump($ir[0]['type']);
var_dump($ir[0]['name']);
?>
--EXPECT--
string(5) "class"
string(3) "RBF"

