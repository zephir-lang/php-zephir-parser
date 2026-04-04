--TEST--
All-caps namespace and use-alias names (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// namespace RBF;
$ir = zephir_parse_file('namespace RBF;', '(eval code)');
var_dump($ir[0]['type']);
var_dump($ir[0]['name']);

// use RBF;
$ir = zephir_parse_file('use RBF;', '(eval code)');
var_dump($ir[0]['type']);
var_dump($ir[0]['aliases'][0]['name']);
?>
--EXPECT--
string(9) "namespace"
string(3) "RBF"
string(3) "use"
string(3) "RBF"

