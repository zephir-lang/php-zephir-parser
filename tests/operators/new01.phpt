--TEST--
new static statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a = new static;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]["assignments"][0]["expr"]);
?>
--EXPECT--
array(6) {
  ["type"]=>
  string(3) "new"
  ["class"]=>
  string(6) "static"
  ["dynamic"]=>
  int(0)
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(2)
  ["char"]=>
  int(20)
}
