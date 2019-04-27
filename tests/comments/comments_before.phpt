--TEST--
Comments before namespace
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code1 =<<<ZEP
/* some comment */

namespace Example;

class Test
{
}
ZEP;

$code2 =<<<ZEP
// some comment

namespace Example;

class Test
{
}
ZEP;

$code3 =<<<ZEP
/**
 * some comment
 */

namespace Example;

class Test
{
}
ZEP;

var_dump(zephir_parse_file($code1, '(eval code)'));
var_dump(zephir_parse_file($code2, '(eval code)'));
var_dump(zephir_parse_file($code3, '(eval code)'));
?>
--EXPECT--
array(2) {
  [0]=>
  array(5) {
    ["type"]=>
    string(9) "namespace"
    ["name"]=>
    string(7) "Example"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(5)
    ["char"]=>
    int(5)
  }
  [1]=>
  array(8) {
    ["type"]=>
    string(5) "class"
    ["name"]=>
    string(4) "Test"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(0)
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(5)
    ["char"]=>
    int(5)
  }
}
array(2) {
  [0]=>
  array(5) {
    ["type"]=>
    string(9) "namespace"
    ["name"]=>
    string(7) "Example"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(5)
    ["char"]=>
    int(5)
  }
  [1]=>
  array(8) {
    ["type"]=>
    string(5) "class"
    ["name"]=>
    string(4) "Test"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(0)
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(5)
    ["char"]=>
    int(5)
  }
}
array(3) {
  [0]=>
  array(5) {
    ["type"]=>
    string(7) "comment"
    ["value"]=>
    string(21) "**
 * some comment
 *"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(5)
    ["char"]=>
    int(9)
  }
  [1]=>
  array(5) {
    ["type"]=>
    string(9) "namespace"
    ["name"]=>
    string(7) "Example"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(7)
    ["char"]=>
    int(5)
  }
  [2]=>
  array(8) {
    ["type"]=>
    string(5) "class"
    ["name"]=>
    string(4) "Test"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(0)
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(7)
    ["char"]=>
    int(5)
  }
}
