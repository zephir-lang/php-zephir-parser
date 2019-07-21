--TEST--
new type statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a = new array(1);
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]["assignments"][0]["expr"]);
?>
--EXPECT--
array(6) {
  ["type"]=>
  string(8) "new-type"
  ["internal-type"]=>
  string(5) "array"
  ["parameters"]=>
  array(1) {
    [0]=>
    array(4) {
      ["parameter"]=>
      array(5) {
        ["type"]=>
        string(3) "int"
        ["value"]=>
        string(1) "1"
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
      int(2)
      ["char"]=>
      int(21)
    }
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(2)
  ["char"]=>
  int(22)
}
