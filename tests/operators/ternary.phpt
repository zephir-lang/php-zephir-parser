--TEST--
Tests ternary operator
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let b = a ? true : false;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]["assignments"][0]["expr"]);
?>
--EXPECT--
array(7) {
  ["type"]=>
  string(7) "ternary"
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
  ["right"]=>
  array(5) {
    ["type"]=>
    string(4) "bool"
    ["value"]=>
    string(4) "true"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(19)
  }
  ["extra"]=>
  array(5) {
    ["type"]=>
    string(4) "bool"
    ["value"]=>
    string(5) "false"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(26)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(2)
  ["char"]=>
  int(26)
}
