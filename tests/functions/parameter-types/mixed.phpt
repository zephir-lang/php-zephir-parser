--TEST--
Parameter type 'mixed'
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test(mixed value) { }
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
    array(1) {
      [0]=>
      array(9) {
        ["type"]=>
        string(9) "parameter"
        ["name"]=>
        string(5) "value"
        ["const"]=>
        int(0)
        ["data-type"]=>
        string(5) "mixed"
        ["mandatory"]=>
        int(0)
        ["reference"]=>
        int(0)
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(1)
        ["char"]=>
        int(27)
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
