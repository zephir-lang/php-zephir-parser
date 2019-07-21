--TEST--
mcall statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	a->b();
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]);
?>
--EXPECT--
array(5) {
  ["type"]=>
  string(5) "mcall"
  ["expr"]=>
  array(7) {
    ["type"]=>
    string(5) "mcall"
    ["variable"]=>
    array(5) {
      ["type"]=>
      string(8) "variable"
      ["value"]=>
      string(1) "a"
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(2)
      ["char"]=>
      int(4)
    }
    ["name"]=>
    string(1) "b"
    ["call-type"]=>
    int(1)
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

