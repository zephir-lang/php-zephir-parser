--TEST--
Tests assignments using division syntax
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace ExtTest;

class Test
{
    public function div(int num)
    {
        var a;
        let a = 42;
        let a /= num;
        return a;
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

$statements = $ir[1]["definition"]["methods"][0]["statements"];

array_pop($statements);
array_shift($statements);

var_dump($statements);
?>
--EXPECT--
array(2) {
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
        string(6) "assign"
        ["variable"]=>
        string(1) "a"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(3) "int"
          ["value"]=>
          string(2) "42"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(8)
          ["char"]=>
          int(19)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(8)
        ["char"]=>
        int(19)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(9)
    ["char"]=>
    int(11)
  }
  [1]=>
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
        string(10) "div-assign"
        ["variable"]=>
        string(1) "a"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(8) "variable"
          ["value"]=>
          string(3) "num"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(9)
          ["char"]=>
          int(20)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(9)
        ["char"]=>
        int(20)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(10)
    ["char"]=>
    int(14)
  }
}
