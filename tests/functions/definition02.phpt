--TEST--
Function definition with mandatory return type
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() -> int! | string { }
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
    ["return-type"]=>
    array(6) {
      ["type"]=>
      string(11) "return-type"
      ["list"]=>
      array(2) {
        [0]=>
        array(6) {
          ["type"]=>
          string(21) "return-type-parameter"
          ["data-type"]=>
          string(3) "int"
          ["mandatory"]=>
          int(1)
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(1)
          ["char"]=>
          int(26)
        }
        [1]=>
        array(6) {
          ["type"]=>
          string(21) "return-type-parameter"
          ["data-type"]=>
          string(6) "string"
          ["mandatory"]=>
          int(0)
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(1)
          ["char"]=>
          int(35)
        }
      }
      ["void"]=>
      int(0)
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(1)
      ["char"]=>
      int(35)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(1)
    ["char"]=>
    int(9)
  }
}
