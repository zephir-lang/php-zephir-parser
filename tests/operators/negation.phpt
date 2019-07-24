--TEST--
Tests negation operator
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a = -a;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]["assignments"][0]["expr"]);
?>
--EXPECT--
array(5) {
  ["type"]=>
  string(5) "minus"
  ["left"]=>
  array(5) {
    ["type"]=>
    string(8) "variable"
    ["value"]=>
    string(1) "a"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(12)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(2)
  ["char"]=>
  int(12)
}
