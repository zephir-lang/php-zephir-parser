--TEST--
Invalid class member syntax must still produce parse errors after the flexible ordering fix (issue #26)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

// 1. const with no value (missing = expr)
var_dump(zephir_parse_file('class Foo { const MYCONST; }', '(eval code)'));

// 2. const with no name
var_dump(zephir_parse_file('class Foo { const = 1; }', '(eval code)'));

// 3. property with no visibility modifier
var_dump(zephir_parse_file('class Foo { myProp; }', '(eval code)'));

// 4. method missing the "function" keyword
var_dump(zephir_parse_file('class Foo { public test() {} }', '(eval code)'));

// 5. stray semicolon as class member
var_dump(zephir_parse_file('class Foo { ; }', '(eval code)'));

?>
--EXPECT--
array(5) {
  ["type"]=>
  string(5) "error"
  ["message"]=>
  string(12) "Syntax error"
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(1)
  ["char"]=>
  int(27)
}
array(5) {
  ["type"]=>
  string(5) "error"
  ["message"]=>
  string(12) "Syntax error"
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(1)
  ["char"]=>
  int(20)
}
array(5) {
  ["type"]=>
  string(5) "error"
  ["message"]=>
  string(12) "Syntax error"
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(1)
  ["char"]=>
  int(19)
}
array(5) {
  ["type"]=>
  string(5) "error"
  ["message"]=>
  string(12) "Syntax error"
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(1)
  ["char"]=>
  int(25)
}
array(5) {
  ["type"]=>
  string(5) "error"
  ["message"]=>
  string(12) "Syntax error"
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(1)
  ["char"]=>
  int(14)
}

