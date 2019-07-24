--TEST--
instanceof expression
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	if a instanceof b { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]["expr"]);
?>
--EXPECT--
array(6) {
  ["type"]=>
  string(10) "instanceof"
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
    int(16)
  }
  ["right"]=>
  array(5) {
    ["type"]=>
    string(8) "variable"
    ["value"]=>
    string(1) "b"
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
  int(2)
  ["char"]=>
  int(20)
}
