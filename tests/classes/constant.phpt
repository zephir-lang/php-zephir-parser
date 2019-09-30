--TEST--
Class constant definition
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
class MyClass
{
	const MYCONSTANT1 = false;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["definition"]["constants"][0]);
?>

--EXPECT--
array(6) {
  ["type"]=>
  string(5) "const"
  ["name"]=>
  string(11) "MYCONSTANT1"
  ["default"]=>
  array(5) {
    ["type"]=>
    string(4) "bool"
    ["value"]=>
    string(5) "false"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(3)
    ["char"]=>
    int(27)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(4)
  ["char"]=>
  int(1)
}
