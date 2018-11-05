--TEST--
Tests string assignments by concatenation with strings similar to integers
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace ExtTest;

class Test
{
    public static function test()
    {
        var a, b;
        let a = "1";
        let b = "2";
        let b .= a;
        return b;
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

$statements = $ir[1]["definition"]["methods"][0]["statements"];

array_pop($statements);
array_shift($statements);

var_dump($statements);
--EXPECTF--
array(3) {
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
          string(6) "string"
          ["value"]=>
          string(1) "1"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(8)
          ["char"]=>
          int(18)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(8)
        ["char"]=>
        int(18)
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
        string(6) "assign"
        ["variable"]=>
        string(1) "b"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(6) "string"
          ["value"]=>
          string(1) "2"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(9)
          ["char"]=>
          int(18)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(9)
        ["char"]=>
        int(18)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(10)
    ["char"]=>
    int(11)
  }
  [2]=>
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
        string(13) "concat-assign"
        ["variable"]=>
        string(1) "b"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(8) "variable"
          ["value"]=>
          string(1) "a"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(10)
          ["char"]=>
          int(18)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(10)
        ["char"]=>
        int(18)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(11)
    ["char"]=>
    int(14)
  }
}
