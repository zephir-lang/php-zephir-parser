--TEST--
Function definition with void
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() -> void { }
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
    array(5) {
      ["type"]=>
      string(11) "return-type"
      ["void"]=>
      int(1)
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(1)
      ["char"]=>
      int(26)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(1)
    ["char"]=>
    int(9)
  }
}
