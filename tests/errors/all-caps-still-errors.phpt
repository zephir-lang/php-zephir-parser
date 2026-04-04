--TEST--
Genuinely invalid syntax must still produce parse errors after the all-caps fix (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// 1. class with no name at all — always a syntax error
var_dump(zephir_parse_file('class {}', '(eval code)'));

// 2. class extends with no parent name
var_dump(zephir_parse_file('class Foo extends {}', '(eval code)'));

// 3. let statement with no variable name
var_dump(zephir_parse_file(
    'class Foo { public function bar() { let = 1; } }',
    '(eval code)'
));

// 4. function declaration with no name
var_dump(zephir_parse_file('function () {}', '(eval code)'));

// 5. bare all-caps word used as a standalone statement (not a valid statement in Zephir)
var_dump(zephir_parse_file(
    'class Foo { public function bar() { RBF; } }',
    '(eval code)'
));

// 9. class declaration with name but no body (unexpected EOF)
var_dump(zephir_parse_file('class RBF', '(eval code)'));
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
  int(8)
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
  int(42)
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
  int(11)
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
  int(41)
}
array(5) {
  ["type"]=>
  string(5) "error"
  ["message"]=>
  string(14) "Unexpected EOF"
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(1)
  ["char"]=>
  int(10)
}

