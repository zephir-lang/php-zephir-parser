--TEST--
scall statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	a::b();
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
    string(1) "a"
    ["dynamic"]=>
    int(0)
    ["name"]=>
    string(1) "b"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(8)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(3)
  ["char"]=>
  int(1)
}

