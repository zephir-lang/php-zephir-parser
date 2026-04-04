--TEST--
Cast to uchar type (issue #82)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	return (uchar) foo;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]["expr"]);
?>
--EXPECT--
array(6) {
  ["type"]=>
  string(4) "cast"
  ["left"]=>
  string(5) "uchar"
  ["right"]=>
  array(5) {
    ["type"]=>
    string(8) "variable"
    ["value"]=>
    string(3) "foo"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(20)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(2)
  ["char"]=>
  int(20)
}

