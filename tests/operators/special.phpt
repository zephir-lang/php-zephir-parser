--TEST--
Tests special operators
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	if empty arr { }
	if isset arr["item"] { }
	if typeof obj { }
	if clone obj { }
	if fetch dest, arr["item"] { }
	if unlikely false { }
	if likely true { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	var_dump($statement["expr"]);
}
?>
--EXPECT--
array(5) {
  ["type"]=>
  string(5) "empty"
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
    int(15)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(2)
  ["char"]=>
  int(15)
}
array(5) {
  ["type"]=>
  string(5) "isset"
  ["left"]=>
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
      int(3)
      ["char"]=>
      int(14)
    }
    ["right"]=>
    array(5) {
      ["type"]=>
      string(6) "string"
      ["value"]=>
      string(4) "item"
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(3)
      ["char"]=>
      int(19)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(3)
    ["char"]=>
    int(21)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(3)
  ["char"]=>
  int(21)
}
array(5) {
  ["type"]=>
  string(6) "typeof"
  ["left"]=>
  array(5) {
    ["type"]=>
    string(8) "variable"
    ["value"]=>
    string(3) "obj"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(4)
    ["char"]=>
    int(16)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(4)
  ["char"]=>
  int(16)
}
array(5) {
  ["type"]=>
  string(5) "clone"
  ["left"]=>
  array(5) {
    ["type"]=>
    string(8) "variable"
    ["value"]=>
    string(3) "obj"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(5)
    ["char"]=>
    int(15)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(5)
  ["char"]=>
  int(15)
}
array(6) {
  ["type"]=>
  string(5) "fetch"
  ["left"]=>
  array(5) {
    ["type"]=>
    string(8) "variable"
    ["value"]=>
    string(4) "dest"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(6)
    ["char"]=>
    int(27)
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
      int(6)
      ["char"]=>
      int(20)
    }
    ["right"]=>
    array(5) {
      ["type"]=>
      string(6) "string"
      ["value"]=>
      string(4) "item"
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(6)
      ["char"]=>
      int(25)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(6)
    ["char"]=>
    int(27)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(6)
  ["char"]=>
  int(27)
}
array(5) {
  ["type"]=>
  string(8) "unlikely"
  ["left"]=>
  array(5) {
    ["type"]=>
    string(4) "bool"
    ["value"]=>
    string(5) "false"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(7)
    ["char"]=>
    int(20)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(7)
  ["char"]=>
  int(20)
}
array(5) {
  ["type"]=>
  string(6) "likely"
  ["left"]=>
  array(5) {
    ["type"]=>
    string(4) "bool"
    ["value"]=>
    string(4) "true"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(8)
    ["char"]=>
    int(17)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(8)
  ["char"]=>
  int(17)
}
