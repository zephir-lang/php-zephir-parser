--TEST--
try-catch control statement without catch
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	try { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]);
?>
--EXPECT--
array(4) {
  ["type"]=>
  string(9) "try-catch"
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(3)
  ["char"]=>
  int(1)
}
