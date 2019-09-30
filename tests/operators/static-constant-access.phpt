--TEST--
static-constant-access expression
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	if MyClass::MY_CONSTANT { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]["expr"]);
?>
--EXPECT--
array(6) {
  ["type"]=>
  string(22) "static-constant-access"
  ["left"]=>
  array(5) {
    ["type"]=>
    string(8) "variable"
    ["value"]=>
    string(7) "MyClass"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(26)
  }
  ["right"]=>
  array(5) {
    ["type"]=>
    string(8) "variable"
    ["value"]=>
    string(11) "MY_CONSTANT"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(26)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(2)
  ["char"]=>
  int(26)
}
