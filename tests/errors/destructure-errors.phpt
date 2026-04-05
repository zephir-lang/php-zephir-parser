--TEST--
Destructuring assignment error cases (issue #18)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// Compound operator is not valid for destructuring: let [a, b] += arr;
$code1 = 'class Foo { public function bar() { let [a, b] += arr; } }';
$ir1 = zephir_parse_file($code1, '(eval code)');
var_dump($ir1['type']);
var_dump($ir1['message']);

// Nested brackets are not valid: let [[a, b]] = arr;
$code2 = 'class Foo { public function bar() { let [[a, b]] = arr; } }';
$ir2 = zephir_parse_file($code2, '(eval code)');
var_dump($ir2['type']);
var_dump($ir2['message']);
?>
--EXPECT--
string(5) "error"
string(12) "Syntax error"
string(5) "error"
string(12) "Syntax error"

