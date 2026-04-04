--TEST--
scall statement with CONSTANT (all-caps) class and dynamic string method name (issue #22)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	MYCLASS::{"method"}();
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
  array(8) {
    ["type"]=>
    string(5) "scall"
    ["dynamic-class"]=>
    int(0)
    ["class"]=>
    string(7) "MYCLASS"
    ["dynamic"]=>
    int(2)
    ["name"]=>
    string(6) "method"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(21)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(3)
  ["char"]=>
  int(1)
}



