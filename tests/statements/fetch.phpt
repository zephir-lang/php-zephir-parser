--TEST--
fetch statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	fetch item, arr["key"];
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]);
?>
--EXPECT--
array(5) {
  ["type"]=>
  string(5) "fetch"
  ["expr"]=>
  array(6) {
    ["type"]=>
    string(5) "fetch"
    ["left"]=>
    array(5) {
      ["type"]=>
      string(8) "variable"
      ["value"]=>
      string(4) "item"
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(2)
      ["char"]=>
      int(22)
    }
    ["right"]=>
    array(6) {
      ["type"]=>
      string(12) "array-access"
      ["left"]=>
      array(5) {
        ["type"]=>
        string(8) "variable"
        ["value"]=>
        string(3) "arr"
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(2)
        ["char"]=>
        int(17)
      }
      ["right"]=>
      array(5) {
        ["type"]=>
        string(6) "string"
        ["value"]=>
        string(3) "key"
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
      int(22)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(22)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(3)
  ["char"]=>
  int(1)
}

