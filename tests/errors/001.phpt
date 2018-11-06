--TEST--
Syntax error on statement w/o assignment
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

class Test
{
    public function test()
    {
        5 + 2;
    }
}
ZEP;

var_dump(zephir_parse_file($code, '(eval code)'));
--EXPECT--
array(5) {
  ["type"]=>
  string(5) "error"
  ["message"]=>
  string(12) "Syntax error"
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(7)
  ["char"]=>
  int(14)
}
