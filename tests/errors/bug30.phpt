--TEST--
Syntax error when use unicode
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
<?php include(__DIR__ . '/../skipifwin32.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

class Test
{
    public®static function test()
    {
    }
}
ZEP;

var_dump(zephir_parse_file($code, '(eval code)'));
?>
--EXPECTF--
array(5) {
  ["type"]=>
  string(5) "error"
  ["message"]=>
  string(55) "Scanner error: -2 %sstatic function test()
    {
    }
}"
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(5)
  ["char"]=>
  int(10)
}
