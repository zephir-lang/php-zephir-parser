--TEST--
Array yield statement
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	yield 'key', 'value';
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]);
?>
--EXPECT--
array(6) {
  ["type"]=>
  string(5) "yield"
  ["key"]=>
  array(5) {
    ["type"]=>
    string(4) "char"
    ["value"]=>
    string(3) "key"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(12)
  }
  ["value"]=>
  array(5) {
    ["type"]=>
    string(4) "char"
    ["value"]=>
    string(5) "value"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(20)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(3)
  ["char"]=>
  int(1)
}
