--TEST--
new dynamic class statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a = new {someClass};
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
  string(9) "someClass"
  ["dynamic"]=>
  int(1)
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(2)
  ["char"]=>
  int(25)
}
