--TEST--
Tests empty closure with "use"
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

class Closure
{
    public function callback()
    {
        var abc = 42;

        return function () use (abc) { };
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

var_dump($ir);
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
    int(3)
    ["char"]=>
    int(5)
  }
  [1]=>
  array(8) {
    ["type"]=>
    string(5) "class"
    ["name"]=>
    string(7) "Closure"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(0)
    ["definition"]=>
    array(4) {
      ["methods"]=>
      array(1) {
        [0]=>
        array(8) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(8) "callback"
          ["statements"]=>
          array(2) {
            [0]=>
            array(6) {
              ["type"]=>
              string(7) "declare"
              ["data-type"]=>
              string(8) "variable"
              ["variables"]=>
              array(1) {
                [0]=>
                array(5) {
                  ["variable"]=>
                  string(3) "abc"
                  ["expr"]=>
                  array(5) {
                    ["type"]=>
                    string(3) "int"
                    ["value"]=>
                    string(2) "42"
                    ["file"]=>
                    string(11) "(eval code)"
                    ["line"]=>
                    int(7)
                    ["char"]=>
                    int(21)
                  }
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(7)
                  ["char"]=>
                  int(21)
                }
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(9)
              ["char"]=>
              int(14)
            }
            [1]=>
            array(5) {
              ["type"]=>
              string(6) "return"
              ["expr"]=>
              array(5) {
                ["type"]=>
                string(7) "closure"
                ["use"]=>
                array(1) {
                  [0]=>
                  array(9) {
                    ["type"]=>
                    string(9) "parameter"
                    ["name"]=>
                    string(3) "abc"
                    ["const"]=>
                    int(0)
                    ["data-type"]=>
                    string(8) "variable"
                    ["mandatory"]=>
                    int(0)
                    ["reference"]=>
                    int(0)
                    ["file"]=>
                    string(11) "(eval code)"
                    ["line"]=>
                    int(9)
                    ["char"]=>
                    int(36)
                  }
                }
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(9)
                ["char"]=>
                int(41)
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(10)
              ["char"]=>
              int(5)
            }
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(9)
          ["last-line"]=>
          int(11)
          ["char"]=>
          int(23)
        }
      }
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(3)
      ["char"]=>
      int(5)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(3)
    ["char"]=>
    int(5)
  }
}
