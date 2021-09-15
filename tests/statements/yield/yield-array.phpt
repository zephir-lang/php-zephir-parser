--TEST--
Array yield statement
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	yield ['key': 'value', 'another', 'val'];
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]);
?>
--EXPECT--
array(5) {
  ["type"]=>
  string(5) "yield"
  ["expr"]=>
  array(5) {
    ["type"]=>
    string(5) "array"
    ["left"]=>
    array(3) {
      [0]=>
      array(5) {
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
          int(13)
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
          int(21)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(2)
        ["char"]=>
        int(21)
      }
      [1]=>
      array(4) {
        ["value"]=>
        array(5) {
          ["type"]=>
          string(4) "char"
          ["value"]=>
          string(7) "another"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(2)
          ["char"]=>
          int(31)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(2)
        ["char"]=>
        int(31)
      }
      [2]=>
      array(4) {
        ["value"]=>
        array(5) {
          ["type"]=>
          string(4) "char"
          ["value"]=>
          string(3) "val"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(2)
          ["char"]=>
          int(37)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(2)
        ["char"]=>
        int(37)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(38)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(3)
  ["char"]=>
  int(1)
}
