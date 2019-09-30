--TEST--
Tests short syntax closure definition
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function map(array! data) {
	return number => number * number;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]["expr"]);
?>
--EXPECT--
array(6) {
  ["type"]=>
  string(13) "closure-arrow"
  ["left"]=>
  array(5) {
    ["type"]=>
    string(8) "variable"
    ["value"]=>
    string(6) "number"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(34)
  }
  ["right"]=>
  array(6) {
    ["type"]=>
    string(3) "mul"
    ["left"]=>
    array(5) {
      ["type"]=>
      string(8) "variable"
      ["value"]=>
      string(6) "number"
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(2)
      ["char"]=>
      int(26)
    }
    ["right"]=>
    array(5) {
      ["type"]=>
      string(8) "variable"
      ["value"]=>
      string(6) "number"
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(2)
      ["char"]=>
      int(34)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(34)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(2)
  ["char"]=>
  int(34)
}
