--TEST--
Tests assignments using division by module
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Imagic;

class Test
{
    public function mod(int degrees)
    {
        let degrees %= 360;
        return degrees;
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

$statements = $ir[1]["definition"]["methods"][0]["statements"];

array_pop($statements);
var_dump($statements);
--EXPECT--
array(1) {
  [0]=>
  array(5) {
    ["type"]=>
    string(3) "let"
    ["assignments"]=>
    array(1) {
      [0]=>
      array(7) {
        ["assign-type"]=>
        string(8) "variable"
        ["operator"]=>
        string(10) "mod-assign"
        ["variable"]=>
        string(7) "degrees"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(3) "int"
          ["value"]=>
          string(3) "360"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(7)
          ["char"]=>
          int(26)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(7)
        ["char"]=>
        int(26)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(8)
    ["char"]=>
    int(14)
  }
}
