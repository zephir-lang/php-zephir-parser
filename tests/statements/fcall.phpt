--TEST--
fcall statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	f();
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]);
?>
--EXPECT--
array(5) {
  ["type"]=>
  string(5) "fcall"
  ["expr"]=>
  array(6) {
    ["type"]=>
    string(5) "fcall"
    ["name"]=>
    string(1) "f"
    ["call-type"]=>
    int(1)
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(5)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(3)
  ["char"]=>
  int(1)
}

