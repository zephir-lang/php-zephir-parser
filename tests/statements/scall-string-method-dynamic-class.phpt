--TEST--
scall statement with dynamic class and dynamic string method name (issue #22)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	{obj}::{"method"}();
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
    int(1)
    ["class"]=>
    string(3) "obj"
    ["dynamic"]=>
    int(2)
    ["name"]=>
    string(6) "method"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(19)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(3)
  ["char"]=>
  int(1)
}



