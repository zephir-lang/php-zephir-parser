--TEST--
Interface declaration
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
interface MiddlewareInterfaceEx extends MiddlewareInterface
{

}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir);
?>
--EXPECT--
array(1) {
  [0]=>
  array(7) {
    ["type"]=>
    string(9) "interface"
    ["name"]=>
    string(21) "MiddlewareInterfaceEx"
    ["extends"]=>
    array(1) {
      [0]=>
      array(5) {
        ["type"]=>
        string(8) "variable"
        ["value"]=>
        string(19) "MiddlewareInterface"
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(2)
        ["char"]=>
        int(1)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(0)
    ["char"]=>
    int(0)
  }
}
