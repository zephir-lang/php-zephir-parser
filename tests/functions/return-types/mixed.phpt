--TEST--
Function definition with `mixed` return type
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() -> mixed { }
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
      array(1) {
        [0]=>
        array(6) {
          ["type"]=>
          string(21) "return-type-parameter"
          ["data-type"]=>
          string(5) "mixed"
          ["mandatory"]=>
          int(0)
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(1)
          ["char"]=>
          int(27)
        }
      }
      ["void"]=>
      int(0)
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(1)
      ["char"]=>
      int(27)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(1)
    ["char"]=>
    int(9)
  }
}
