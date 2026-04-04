--TEST--
scall statement with dynamic string method name and parameters (issue #22)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	self::{"name"}(1, 2);
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]);
?>
--EXPECT--
array(5) {
  ["type"]=>
  string(5) "scall"
  ["expr"]=>
  array(9) {
    ["type"]=>
    string(5) "scall"
    ["dynamic-class"]=>
    int(0)
    ["class"]=>
    string(4) "self"
    ["dynamic"]=>
    int(2)
    ["name"]=>
    string(4) "name"
    ["parameters"]=>
    array(2) {
      [0]=>
      array(4) {
        ["parameter"]=>
        array(5) {
          ["type"]=>
          string(3) "int"
          ["value"]=>
          string(1) "1"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(2)
          ["char"]=>
          int(16)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(2)
        ["char"]=>
        int(16)
      }
      [1]=>
      array(4) {
        ["parameter"]=>
        array(5) {
          ["type"]=>
          string(3) "int"
          ["value"]=>
          string(1) "2"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(2)
          ["char"]=>
          int(19)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(2)
        ["char"]=>
        int(19)
      }
    }
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
