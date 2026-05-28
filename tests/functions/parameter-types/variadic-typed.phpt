--TEST--
Typed variadic parameter 'string ...params'
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test(string ...params) { }
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
      array(10) {
        ["type"]=>
        string(9) "parameter"
        ["name"]=>
        string(6) "params"
        ["const"]=>
        int(0)
        ["data-type"]=>
        string(6) "string"
        ["mandatory"]=>
        int(0)
        ["reference"]=>
        int(0)
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(1)
        ["char"]=>
        int(32)
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
