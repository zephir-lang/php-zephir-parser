--TEST--
Variadic parameter '...rest'
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test(int first, ...rest) { }
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir);
?>
--EXPECT--
array(1) {
  [0]=>
  array(6) {
    ["type"]=>
    string(8) "function"
    ["name"]=>
    string(4) "test"
    ["parameters"]=>
    array(2) {
      [0]=>
      array(9) {
        ["type"]=>
        string(9) "parameter"
        ["name"]=>
        string(5) "first"
        ["const"]=>
        int(0)
        ["data-type"]=>
        string(3) "int"
        ["mandatory"]=>
        int(0)
        ["reference"]=>
        int(0)
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(1)
        ["char"]=>
        int(25)
      }
      [1]=>
      array(10) {
        ["type"]=>
        string(9) "parameter"
        ["name"]=>
        string(4) "rest"
        ["const"]=>
        int(0)
        ["data-type"]=>
        string(8) "variable"
        ["mandatory"]=>
        int(0)
        ["reference"]=>
        int(0)
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(1)
        ["char"]=>
        int(34)
        ["variadic"]=>
        int(1)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(1)
    ["char"]=>
    int(9)
  }
}
